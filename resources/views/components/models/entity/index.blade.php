&lt;?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    /**
    * A Entity will have many User.
    *
    * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
