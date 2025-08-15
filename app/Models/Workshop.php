<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workshop extends Model
{
    use HasFactory;
    protected $fillable = [
        'cover',
        'title',
        'short_description',
        'description',
        'teacher_id',
        'price',
        'discount',
        'final_price',
        'type',
        'link',
        'video',
        'capacity',
        'age_group',
        'comments_count',
        'rate',
        'participants_count',
        'views',
        'city_id',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function cartItems()
    {
        return $this->morphMany(CartItem::class, 'item');
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
