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
    public function {{ $method }}(User $user{{ $className ? ", $className $" . Str::of($className)->lower() : '' }})
    {
        return $user->abilities()->contains('{{ $action }}_user');
    }

}
