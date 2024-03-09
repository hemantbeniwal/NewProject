<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "status"
    ];

    public function states() {
        return $this->hasMany(State::class, 'country_id');
    }

    // public function getNameAttribute($value) {
    //     return $this->attributes['name'] = "Cnt: ".$value;
    // }

}
