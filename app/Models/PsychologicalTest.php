<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PsychologicalTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'cover',
        'title',
        'description',
        'short_description',
        'price',
        'discount',
        'final_price',
        // 'instructor_id',
        'category_id',
        'view_count',
        'participants_count',
        'capacity',
        'age_group',
        'test_link'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function userTests()
    {
        return $this->hasMany(UserTest::class);
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
    public function users()
    {
        return $this->belongsToMany(User::class,'user_psychological_tests');
    }
}
