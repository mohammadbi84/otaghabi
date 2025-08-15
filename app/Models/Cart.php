<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'discount_code', 'total_price', 'final_price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function addItem(Model $item, $price = 0)
    {
        $this->items()->create([
            'item_id' => $item->id,
            'item_type' => get_class($item),
            'price' => $price,
        ]);
    }
}
