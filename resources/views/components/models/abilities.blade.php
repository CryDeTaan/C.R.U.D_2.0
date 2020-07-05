&lt;?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ability extends Model
{

    /**
    * An ability may have many roles.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

}
