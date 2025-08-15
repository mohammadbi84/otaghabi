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

    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    /**
     * Get the status text attribute.
     *
     * @return string
     */
    public function getStatusTextAttribute()
    {
        $statuses = [
            self::STATUS_PENDING => 'در انتظار بررسی',
            self::STATUS_APPROVED => 'تایید شده',
            self::STATUS_REJECTED => 'رد شده'
        ];

        return $statuses[$this->status] ?? 'وضعیت نامعلوم';
    }

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
