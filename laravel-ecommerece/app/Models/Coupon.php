<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status',
        'coupon_code',
        'valid_from',
        'valid_to',
        'discount_amount',
    ];
}
