<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    use HasFactory;
    protected $guarded  = ['id'];
    protected $with     = ['posts', 'category', 'category_detail'];

    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function category_detail()
    {
        return $this->belongsTo(CategoryDetail::class);
    }
}