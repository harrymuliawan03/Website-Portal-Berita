<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SearchTraffic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];
    protected $with = ['category', 'author'];
    public function scopeSearch(Builder $query, $search )
    {
        $query->when($search ?? false, 
            fn ($query, $search) => 
            $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('body', 'like', '%' . $search . '%')
                );
    }
    public function scopeCategory(Builder $query, $category )
    {
        $query->when($category ?? false, 
            fn ($query, $category) => 
            $query->whereHas(
                'category',
                fn ($query) => $query->where('category_name', $category))
            );
    }
    public function scopeAuthor(Builder $query, $author )
    {
        $query->when($author ?? false, 
            fn ($query, $author) => 
            $query->whereHas(
                'author',
                fn ($query) => $query->where('username', $author))
            );
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category_details()
    {
        return $this->belongsToMany(CategoryDetail::class, 'post_details', 'post_id', 'category_detail_id');
    }


    public function post_details()
    {
        return $this->hasMany(PostDetail::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}