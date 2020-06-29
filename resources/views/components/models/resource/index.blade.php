&lt;?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
    * A Resource will belong to a Resource Owner(User).
    *
    * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
