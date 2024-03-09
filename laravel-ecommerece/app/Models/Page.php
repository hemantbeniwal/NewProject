<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class Page extends Model implements HasMedia

{
    use HasFactory, InteractsWithMedia;
    
    protected $fillable = [
        'title',
        'heading',
        'ordering',
        'status',
        'url_key',
        'description',
        'parent_id'
    ];
}
