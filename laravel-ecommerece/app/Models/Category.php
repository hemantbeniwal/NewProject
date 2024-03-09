<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'category_parent_id',
        'name',
        'status',
        'show_in_menu',
        'short_description',
        'description',
        'url_key',
        'meta_tag',
        'meta_title',
        'meta_description'
    ];
    function products(){
        return $this->belongsToMany(Product::class,'product_categories');
    }
}
