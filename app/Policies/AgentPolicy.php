<?php

namespace App\Policies;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Agent  $authAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Agent $authAgent)
    {
        return $authAgent->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Agent  $authAgent
     * @param  \App\Models\Agent  $routeAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Agent $authAgent, Agent $routeAgent)
    {
        return $authAgent->is_admin;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Agent  $authAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Agent $authAgent)
    {
        return $authAgent->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Agent  $authAgent
     * @param  \App\Models\Agent  $routeAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Agent $authAgent, Agent $routeAgent)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Agent  $authAgent
     * @param  \App\Models\Agent  $routeAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Agent $authAgent, Agent $routeAgent)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Agent  $authAgent
     * @param  \App\Models\Agent  $routeAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Agent $authAgent, Agent $routeAgent)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Agent  $authAgent
     * @param  \App\Models\Agent  $routeAgent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Agent $authAgent, Agent $routeAgent)
    {
        //
    }

    /**
     * @param  Agent  $authAgent
     * @param  Agent  $routeAgent
     * @return bool
     */
    public function toggleAdminRole(Agent $authAgent, Agent $routeAgent)
    {
        return $authAgent->is_admin && $authAgent->id !== $routeAgent->id;
    }
}
