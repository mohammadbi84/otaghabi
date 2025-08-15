<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'cover',
        'title',
        'category_id',
        'summary',
        'body',
        'view_count',
        'author_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function visits()
    {
        return $this->morphMany(\App\Models\Visit::class, 'visitable');
    }
    public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}

}
