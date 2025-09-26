<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationAnswer extends Model
{
    use HasFactory;
    protected $fillable = ['consultation_request_id', 'consultation_question_id', 'answer'];

    public function request()
    {
        return $this->belongsTo(ConsultationRequest::class, 'consultation_request_id');
    }

    public function question()
    {
        return $this->belongsTo(ConsultationQuestion::class, 'consultation_question_id');
    }
}
