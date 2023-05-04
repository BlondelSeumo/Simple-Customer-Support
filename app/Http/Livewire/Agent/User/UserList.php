<?php

namespace App\Http\Livewire\Agent\User;

use App\Http\Livewire\Traits\WithBulkActions;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{
    use AuthorizesRequests;
    use WithBulkActions;
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function mount()
    {
        $this->authorize('viewAny', User::class);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportCSV()
    {
        $fileName = 'users.csv';

        $selectedUsers = User::query()->select('name', 'email')->whereIn('id', $this->selected)->get();

        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=' . $fileName,
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $callback = function () use ($selectedUsers) {
            $columns = ['Name', 'Email'];

            $file = fopen('php://output', 'W');

            fputcsv($file, $columns);

            foreach ($selectedUsers as $user) {
                fputcsv($file, [$user->name, $user->email]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function getRowsQueryProperty()
    {
        return User::query()
            ->with('media')
            ->withCount('tickets')
            ->when($this->search, function ($query) {
                $query
                    ->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            });
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->latest()->paginate(10);
    }

    public function render()
    {
        return view('livewire.agent.user.user-list', [
            'users' => $this->rows,
        ]);
    }
}
