<?php

namespace App\Policies;

use App\Resource;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->abilities()->contains('read_resource');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function view(User $user, Resource $resource)
    {
        return
            $user->abilities()->contains('read_resource') &&
            $resource->users()->get()->contains('id',$user->id);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->abilities()->contains('create_resource');
    }

    /**
     * Determine whether the Resource Contributor can be assigned to model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $resource_contributor
     * @return mixed
     */
    public function assignResourceContributor(User $user, User $resource_contributor)
    {
        return
            $resource_contributor->abilities()->contains('read_resource') &&
            $user->entity_id === $resource_contributor->entity_id;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function update(User $user, Resource $resource)
    {
        return
            $user->abilities()->contains('update_resource') &&
            $resource->users()->get()->contains('id',$user->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function delete(User $user, Resource $resource)
    {
        return
            $user->abilities()->contains('delete_resource') &&
            $resource->users()->get()->contains('id',$user->id);
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function restore(User $user, Resource $resource)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Resource  $resource
     * @return mixed
     */
    public function forceDelete(User $user, Resource $resource)
    {
        //
    }
}
