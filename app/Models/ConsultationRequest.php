<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'mobile',
        'category_id',
        'consultant_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }
}
