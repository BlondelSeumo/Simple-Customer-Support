<?php

namespace App\Policies;

use App\Models\Agent;
use App\Models\Ticket;
use Illuminate\Auth\Access\HandlesAuthorization;

class TicketPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Agent $agent)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Agent $agent, Ticket $ticket)
    {
        return $agent->is_admin
            || in_array($agent->id, $ticket->assignees()->pluck('agent_id')->toArray())
            || in_array($agent->id, $ticket->product->managers->pluck('id')->toArray());
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Agent $agent)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Agent $agent, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Agent $agent, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Agent $agent, Ticket $ticket)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Agent $agent, Ticket $ticket)
    {
        //
    }
}
