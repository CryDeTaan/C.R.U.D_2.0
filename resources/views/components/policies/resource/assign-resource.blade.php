&lt;?php

namespace App\Policies;

use App\Resource;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResourcePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the Resource Contributor can be assigned to model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $resource_contributor
     * @return mixed
     */
    public function assignResourceContributor(User $user, User $resource_contributor)
    {
        return $user->entity_id === $resource_contributor->entity_id;
    }

}
