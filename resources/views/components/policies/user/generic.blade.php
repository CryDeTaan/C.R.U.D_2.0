&lt;?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can {{ $action }} models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function {{ $action }}(User $user)
    {
        return $user->abilities()->contains('{{ $action }}_user');
    }

}
