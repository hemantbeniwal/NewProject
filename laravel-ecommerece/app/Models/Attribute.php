<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'name_key',
        'status',
        'is_variant',
    ];
    function attribute_value(){
        return $this->hasMany(Attribute_value::class);
    }
}
