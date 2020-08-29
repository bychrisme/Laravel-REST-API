<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = "users";

    protected $fillable = [
        'fullName',
        'email',
        'password'
    ];

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'users_countries', 'user_id', 'country_id');
    }
}
