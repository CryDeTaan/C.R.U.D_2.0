&lt;?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];


    /**
    * The relationships that should always be loaded.
    *
    * @var array
    */
    protected $with = ['entity', 'roles'];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }


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
     * A user may be assigned to an Entity.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function entity()
    {
        return $this->belongsTo(Entity::class);
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
     * Assign an Entity to a User.
     *
     * @param  mixed  $entity
     */
    public function assignEntity($entity)
    {
        $entity = Entity::whereName($entity)->firstorFail();
        $this->entity()->associate($entity);
        $this->save();
    }

}
