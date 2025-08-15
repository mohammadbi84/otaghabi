<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\PsychologicalTest;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add($type, $id)
    {
        $user = User::find(auth()->id());
        $cart = $user->carts()->firstOrCreate(['status' => 0]);

        $model = $type === 'test' ? PsychologicalTest::class : Workshop::class;
        $item = $model::findOrFail($id);

        // بررسی وجود
        $alreadyInCart = $cart->items()->where('item_id', $item->id)->where('item_type', $model)->exists();
        if (!$alreadyInCart) {
            $cart->items()->create([
                'item_id' => $item->id,
                'item_type' => $model,
                'price' => $item->final_price,
            ]);
        }

        return redirect()->back()->with('success', 'به سبد خرید افزوده شد.');
    }
    public function cart()
    {
        $user = User::find(auth()->id());
        $cart = $user->carts()->firstOrCreate(['status' => 0]);

        return view('site.bying.cart', compact('cart'));
    }
    public function removeItem($id)
    {
        $item = CartItem::findOrFail($id);
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }

        $item->delete();
        return redirect()->back()->with('success', 'آیتم با موفقیت حذف شد.');
    }
}
