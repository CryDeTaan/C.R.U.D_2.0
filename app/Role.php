<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name'
    ];
    public function abilities()
    {
        return $this->belongsToMany(Ability::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
