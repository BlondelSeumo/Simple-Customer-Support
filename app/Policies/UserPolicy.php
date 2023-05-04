<?php

namespace App\Policies;

use App\Models\Agent;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
        return $agent->is_admin;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Agent $agent, User $user)
    {
        return $agent->is_admin;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Agent $agent)
    {
        return $agent->is_admin;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Agent $agent, User $user)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Agent $agent, User $user)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Agent $agent, User $user)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Agent  $agent
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Agent $agent, User $user)
    {
        //
    }
}
