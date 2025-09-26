<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationQuestion extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'is_active'];

    public function answers()
    {
        return $this->hasMany(ConsultationAnswer::class);
    }
}
