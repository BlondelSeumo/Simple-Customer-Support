<?php

namespace App\Http\Livewire\User\Ticket;

use App\Enums\ProductProvider;
use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Events\TicketCreated;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ticket;
use App\Services\Envato\Client;
use App\Settings\EnvatoSettings;
use App\Settings\TicketSettings;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketCreator extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public $selectedProduct;
    public $selectedCategory;
    public $licenseRequired = false;
    public Collection $envatoPurchases;

    public $attachments = [];

    protected $rules = [
        'ticket.product_id' => 'required|exists:products,id',
        'ticket.category_id' => 'required|exists:categories,id',
        'ticket.license_code' => 'required_if:licenseRequired,true',
        'ticket.subject' => 'required|string',
        'ticket.content' => 'required|string',
        'ticket.status' => 'required',
        'ticket.priority' => 'required',
        'attachments.*' => 'file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,zip|max:5120',
    ];

    protected $messages = [
        'ticket.product_id.required' => 'Please select a product.',
        'ticket.category_id.required' => 'Please select a category.',
        'ticket.license_code.required_if' => 'The selected category requires a valid license.',
        'ticket.category_id.exists' => 'Please select a valid category.',
        'ticket.subject.required' => 'Please enter a subject.',
        'ticket.content.required' => 'The content field can not leave blank.',
    ];

    public function mount()
    {
        $this->ticket = new Ticket([
            'category_id' => null,
            'status' => TicketStatus::OPEN->value,
            'priority' => TicketPriority::MEDIUM->value,
        ]);
        $this->envatoPurchases = collect([]);
    }

    public function updatedTicketProductId($value)
    {
        $this->selectedProduct = $this->products->find($value);
    }

    public function updatedTicketCategoryId($value)
    {
        $this->selectedCategory = $this->categories->find($value);
        $this->licenseRequired = $this->selectedCategory->is_license_required;
    }

    public function updatedAttachments()
    {
        $this->validate([
            'attachments.*' => 'file|mimes:jpg,jpeg,png,bmp,gif,svg,webp,pdf,zip|max:5120',
        ], [
            'attachments.*.mimes' => trans('Attachment #:position must be a file of type: :values.'),
        ]);
    }

    public function removeAttachment($index)
    {
        array_splice($this->attachments, $index, 1);
    }

    public function loadEnvatoPurchase(Client $client, $attempt = 1)
    {
        if (! $this->user->envato_access_token) {
            $this->redirect(route('social-login.handler', ['provider' => 'envato']));
        } else {
            try {
                $this->envatoPurchases = collect($client->getPurchasesFromAppCreator($this->user->envato_access_token)['purchases']);
                if (! $this->envatoPurchases->where('item.id', $this->selectedProduct->code)->count()) {
                    return $this->addError('verify-envato-purchase', trans('There are no purchases that match your selected product.'));
                }
            } catch (\Exception $e1) {
                if ($e1->getCode() === 403 && $attempt < 2) {
                    try {
                        $renewAccessTokenResponse = $client->renewAccessToken(
                            $this->user->envato_refresh_token,
                            $this->envatoSettings->oauth_client_id,
                            $this->envatoSettings->oauth_client_secret
                        );
                        $this->user->update([
                            'envato_access_token' => $renewAccessTokenResponse['access_token'],
                        ]);
                        return $this->loadEnvatoPurchase($client, $attempt + 1);
                    } catch (\Exception $e2) {
                        logger()->error($e2->getMessage());
                        $this->addError('verify-envato-purchase', trans('There was an error processing your request, please try again later!'));
                        return false;
                    }
                } else {
                    logger()->error($e1->getMessage());
                    $this->addError('verify-envato-purchase', trans('There was an error processing your request, please try again later!'));
                    return false;
                }
            }
        }
    }

    public function verifyEnvatoPurchaseCode()
    {
        $client = app(Client::class);

        try {
            $response = $client->getAuthorSale($this->envatoSettings->account_token, $this->ticket->license_code);
            if ($response['item']['id'] != $this->selectedProduct->code) {
                $this->addError('ticket.license_code', trans('The given purchase code does not match the selected product.'));
                return false;
            }
            return $response;
        } catch (\Exception $e) {
            $this->addError('ticket.license_code', trans('Invalid license code.'));
            return false;
        }
    }

    public function submit()
    {
        $this->validate();

        if (
            $this->selectedProduct->provider->name === ProductProvider::ENVATO->name
            && $this->selectedCategory->is_license_required
            && $this->envatoSettings->token_enabled
        ) {
            $verificationResponse = $this->verifyEnvatoPurchaseCode();
            if (! $verificationResponse) return;
            $this->ticket->license_name = $verificationResponse['license'];
            $this->ticket->license_buyer = $verificationResponse['buyer'];
            $this->ticket->license_purchased_at = Carbon::parse($verificationResponse['sold_at']);
            $this->ticket->license_support_ends_at = Carbon::parse($verificationResponse['supported_until']);
            $this->ticket->license_verified_at = now();
        }

        $this->ticket->user()->associate($this->user);

        $this->ticket->save();

        foreach ($this->attachments as $attachment) {
            $this->ticket
                ->addMedia($attachment->getRealPath())
                ->usingName($attachment->getClientOriginalName())
                ->usingFileName($attachment->getClientOriginalName())
                ->toMediaCollection('attachments');
        }

        if ($this->ticketSettings->auto_assignment_enabled && $this->selectedProduct->assignees->count() > 0) {
            if ($this->ticketSettings->auto_assignment_use_random_agent)
                $this->ticket->assignees()->attach($this->selectedProduct->assignees->random()->id);
            else {
                $this->ticket->assignees()->attach($this->selectedProduct->assignees->pluck('id'));
            }
        }

        TicketCreated::dispatch($this->ticket);

        $this->redirect(route('user.tickets.details', $this->ticket));
    }

    public function getUserProperty()
    {
        return \Auth::user();
    }

    public function getProductsProperty()
    {
        return Product::with('agents', 'media')->whereNull('disabled_at')->get();
    }

    public function getCategoriesProperty()
    {
        return Category::all();
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
        return view('livewire.user.ticket.ticket-creator')->layout('layouts.guest');
    }
}
