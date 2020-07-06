<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var  array
     */
    protected $fillable = [
        'name', 'field', 'user_id', 'entity_id'
    ];

    /**
     * A Resource will belong to a Resource Owner(User).
     *
     * @return  \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(user::class);
    }

    /**
     * A resource may be assigned to many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    /**
     * Assign a given User to the Resource.
     *
     * @param  mixed  $user
     */
    public function assignUser($user)
    {
        $this->users()->sync($user, false);
    }
}
