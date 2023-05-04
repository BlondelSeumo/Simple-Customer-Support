<?php

namespace App\Http\Livewire\Agent\Ticket;

use App\Enums\TicketPriority;
use App\Enums\TicketStatus;
use App\Models\Category;
use App\Models\Product;
use App\Models\Ticket;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class TicketEdit extends Component
{
    public Ticket $ticket;

    protected function rules()
    {
        return [
            'ticket.category_id' => 'required|exists:categories,id',
            'ticket.product_id' => 'required|exists:products,id',
            'ticket.subject' => 'required|string|max:255',
            'ticket.content' => 'required|string',
            'ticket.status' => ['required', new Enum(TicketStatus::class)],
            'ticket.priority' => ['required', new Enum(TicketPriority::class)],
        ];
    }

    public function save()
    {
        $this->validate();

        $this->ticket->save();

        $this->notify(__('Ticket updated successfully.'));
    }

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function getProductsProperty()
    {
        return Product::all();
    }

    public function render()
    {
        return view('livewire.agent.ticket.ticket-edit');
    }
}
