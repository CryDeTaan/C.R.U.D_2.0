&lt;?php

namespace App\Policies;

use App\{{ $className }};
use Illuminate\Auth\Access\HandlesAuthorization;

class {{ $className }}Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can {{ $message }}.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function {{ $method }}(User $user{{ isset($modelIncluded) ? ", $className $$modelIncluded" : '' }})
    {
        return {{ isset($secondCheck) ? "\t" : '' }}$user->abilities()->contains('{{ $ability }}') {{ isset($secondCheck) ? " && \n\t\t" .
               '$resource->users()->get()->contains(\'id\',$user->id)' : '' }};
    }

}
