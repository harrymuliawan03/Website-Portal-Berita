<?php

namespace App\Models;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded  = ['id'];
    protected $with = ['category_details'];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function category_details()
    {
        return $this->hasMany(CategoryDetail::class);
    }
    
    public function post_details()
    {
        return $this->hasMany(PostDetail::class);
    }
}