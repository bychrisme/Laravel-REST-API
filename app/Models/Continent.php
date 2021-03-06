<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    protected $table = "continents";
    
    protected $fillable = [
        'name',
    ];

    public function countries(){
        return $this->hasMany(Country::class);
    }
}
