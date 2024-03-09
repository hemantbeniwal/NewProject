<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'state_id',
        'city_name',
        'city_status'
    ];
    public function country(){
        return $this->belongsTo(Country::class);
    }
    public function statess(){
        return $this->belongsTo(State::class ,'state_id');
    }
}
