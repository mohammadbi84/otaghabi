<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $fillable = ['content', 'latitude', 'longitude'];

    public function galleries()
    {
        return $this->hasMany(AboutGallery::class);
    }
}
