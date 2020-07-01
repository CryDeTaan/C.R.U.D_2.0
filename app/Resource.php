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
        'name', 'field', 'user_id'
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

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }
}
