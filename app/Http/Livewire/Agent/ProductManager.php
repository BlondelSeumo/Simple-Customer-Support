<?php

namespace App\Http\Livewire\Agent;

use App\Enums\ProductProvider;
use App\Models\Agent;
use App\Models\Product;
use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use App\Settings\TicketSettings;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithPagination;

class ProductManager extends Component
{
    use WithPagination;

    public $search;
    public $product;
    public Collection $productManagers;
    public Collection $ticketAssignees;
    public $showProductForm = false;
    public $envatoProducts = [];
    public $showEnvatoModal = false;

    public $filters = [
        'managerName' => '',
        'assigneeName' => '',
    ];

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected function rules()
    {
        return [
            'product.provider' => ['required', new Enum(ProductProvider::class)],
            'product.name' => 'required|string|max:255',
            'product.code' => 'nullable|string|unique:products,code',
            'productManagers' => 'required|array',
            'productManagers.*' => 'required|exists:agents,id',
            'ticketAssignees' => 'required|array',
            'ticketAssignees.*' => 'required|exists:agents,id',
        ];
    }

    public function mount()
    {
        $this->productManagers = collect();
        $this->ticketAssignees = collect();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function createProduct()
    {
        $this->resetErrorBag();
        $this->reset('filters');
        $this->product = new Product([
            'provider' => ProductProvider::SELF_HOSTED->name,
        ]);
        $this->productManagers = collect();
        $this->ticketAssignees = collect();
        $this->showProductForm = true;
    }

    public function editProduct(Product $product)
    {
        $this->resetErrorBag();
        $this->reset('filters');
        $this->product = $product;
        $this->productManagers = $product->agents->where('pivot.is_manager', true);
        $this->ticketAssignees = $product->agents->where('pivot.is_manager', false);
        $this->showProductForm = true;
    }

    public function toggleProductManager(Agent $agent)
    {
        if ($this->productManagers->contains('id', $agent->id)) {
            $this->productManagers = $this->productManagers->reject(function ($manager) use ($agent) {
                return $manager['id'] === $agent->id;
            });
        } else {
            $this->productManagers->push($agent);
        }
    }

    public function deleteProductManager(Agent $agent)
    {
        $this->productManagers = $this->productManagers->reject(function ($manager) use ($agent) {
            return $manager['id'] === $agent->id;
        });
    }

    public function toggleTicketAssignee(Agent $agent)
    {
        if ($this->ticketAssignees->contains('id', $agent->id)) {
            $this->ticketAssignees = $this->ticketAssignees->reject(function ($manager) use ($agent) {
                return $manager['id'] === $agent->id;
            });
        } else {
            $this->ticketAssignees->push($agent);
        }
    }

    public function deleteTicketAssignee(Agent $agent)
    {
        $this->ticketAssignees = $this->ticketAssignees->reject(function ($manager) use ($agent) {
            return $manager['id'] === $agent->id;
        });
    }

    public function saveProduct()
    {
        $this->validate([
            'product.name' => 'required|string|max:255',
            'product.code' => 'required|string|unique:products,code,' . $this->product->id,
        ]);
        $this->product->save();
        $this->product->agents()->syncWithPivotValues($this->productManagers->pluck('id'), ['is_manager' => true]);
        $this->product->agents()->syncWithoutDetaching($this->ticketAssignees->pluck('id'));
        $this->productManagers = collect();
        $this->ticketAssignees = collect();
        $this->dispatchBrowserEvent('notify', $this->product->wasRecentlyCreated ? trans('Product has been created.') : trans('Product has been updated.'));
        $this->reset('product', 'showProductForm');
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
        $this->reset('product', 'showProductForm');
        $this->notify(trans('Product has been removed.'));
    }

    public function toggleSupport(Product $product)
    {
        $product->disabled_at = $product->is_disabled ? null : now()->toDateTimeString();
        $product->save();
    }

    public function loadEnvatoProducts(Client $client)
    {
        $this->reset('envatoProducts');

        $envatoSites = ['themeforest', 'codecanyon', 'videohive', 'audiojungle', 'graphicriver', 'photodune', '3docean', 'activeden'];

        try {
            foreach ($envatoSites as $site) {
                $response = $client->getNewItems($this->envatoSettings->account_token, $this->envatoSettings->account_username, $site);
                $this->envatoProducts = array_merge($this->envatoProducts, $response['new-files-from-user']);
            }
        } catch (\Exception $e) {
            $this->addError('envato', $e->getMessage());
        }
    }

    public function addProduct($index)
    {
        $product = new Product([
            'provider' => ProductProvider::ENVATO->name,
            'name' => $this->envatoProducts[$index]['item'],
            'code' => $this->envatoProducts[$index]['id'],
        ]);

        $product->save();

        $product->addMediaFromUrl($this->envatoProducts[$index]['thumbnail'])->toMediaCollection('logo');

        $this->notify(trans('New product has been added.'));
    }

    public function getProductsProperty(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Product::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->with('media', 'agents.media')
            ->withCount('tickets')
            ->latest()
            ->paginate(10);
    }

    public function getAgentsQueryProperty(): \Illuminate\Database\Eloquent\Builder
    {
        return Agent::query()->select('id', 'name')->with('media');
    }

    public function getManagersProperty()
    {
        return $this->agentsQuery
            ->when($this->filters['managerName'], function ($query) {
                $query->where('name', 'like', '%' . $this->filters['managerName'] . '%');
            })
            ->get();
    }

    public function getAssigneesProperty()
    {
        return $this->agentsQuery
            ->when($this->filters['assigneeName'], function ($query) {
                $query->where('name', 'like', '%' . $this->filters['assigneeName'] . '%');
            })
            ->when(! $this->ticketSettings->allow_assignment_to_admins, function ($query) {
                $query->where('is_admin', false);
            })
            ->get();
    }

    public function getEnvatoSettingsProperty()
    {
        return app(EnvatoSettings::class);
    }

    public function getTicketSettingsProperty()
    {
        return app(TicketSettings::class);
    }

    public function render()
    {
        return view('livewire.agent.product-manager');
    }
}
