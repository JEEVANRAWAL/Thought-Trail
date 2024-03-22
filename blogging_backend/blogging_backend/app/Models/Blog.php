<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'post',
        'slug',
        'featuredImage',
        'metaDescription',
        'post_excerpt'
    ];

    public function setTitleAttribute($title){
        $this->attributes['title']= $title;
        $this->attributes['slug']= $this->uniqueSlug($title);
    }

    private function uniqueSlug($title){
        $slug= Str::slug($title,'-');
        $count= Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount= $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    public function User(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
