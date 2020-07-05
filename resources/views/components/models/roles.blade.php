&lt;?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
    * A role may have many Abilities.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function abilities()
    {
        return $this->belongsToMany(Ability::class)->withTimestamps();
    }

    /**
    * Grant the given ability to the role.
    *
    * @param  mixed  $ability
    */
    public function allowTo($ability)
    {
        if (is_string($ability)) {
            $ability = Ability::whereName($ability)->firstOrFail();
        }

        $this->abilities()->sync($ability, false);
    }

    /**
    * A role may have many Users.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
