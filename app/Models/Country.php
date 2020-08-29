<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = "countries";
    
    protected $fillable = [
        'name',
        'code',
    ];

    public function continent(){
        return $this->belongsTo(Continent::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_countries', 'user_id', 'country_id');
    }
}
