&lt;?php
namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
    * A user may be assigned many roles.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
    * Assign a new role to the user.
    *
    * @param  mixed  $role
    */
    public function assignRole($role)
    {
        if (is_string($role)) {
            $role = Role::whereName($role)->firstOrFail();
        }

        $this->roles()->sync($role, false);
    }

    /**
    * Fetch the user's abilities.
    *
    * @return array
    */
    public function abilities()
    {
        return $this->roles
        ->map->abilities
        ->flatten()->pluck('name')->unique();
    }
}
