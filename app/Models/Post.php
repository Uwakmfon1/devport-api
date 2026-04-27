<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'slug',
        'category_id',
        'excerpt',
        'featured_image',
        'status',
        'views',
    ];

    public function category() 
    {
        return $this->belongsTo(Category::class);
    }
}
