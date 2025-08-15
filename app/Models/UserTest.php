<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'psychological_test_id', 'status', 'result_file'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function psychologicalTest()
    {
        return $this->belongsTo(PsychologicalTest::class);
    }
}
