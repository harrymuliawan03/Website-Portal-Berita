<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class CategoryDetail extends Model
{
    use HasFactory, Sluggable;
    protected $guarded  = ['id'];
    // protected $with     = ['category'];


    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_details', 'post_id', 'category_detail_id');
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'category_detail_name'
            ]
        ];
    }
}