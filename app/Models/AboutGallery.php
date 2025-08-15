<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutGallery extends Model
{
    use HasFactory;
    protected $fillable = ['about_id', 'image'];

    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
