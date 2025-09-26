<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\PsychologicalTest;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $user = User::find(auth()->id());
        $cart = $user->carts()->firstOrCreate(['status' => 0]);

        return view('site.bying.cart', compact('cart'));
    }
    public function add($type, $id)
    {
        $user = User::find(auth()->id());
        $model = $type === 'test' ? PsychologicalTest::class : Workshop::class;
        $item = $model::findOrFail($id);

        $cart = $user->carts()->firstOrCreate(['status' => 0]);
        $cart->total_price += $item->price;
        $cart->final_price += $item->final_price;
        $cart->save();


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
    public function removeItem($id)
    {
        $item = CartItem::findOrFail($id);
        if ($item->cart->user_id !== auth()->id()) {
            abort(403);
        }


        $cart = $item->cart;
        $cart->total_price -= $item->item->price;
        $cart->final_price -= $item->item->final_price;
        $cart->save();



        $item->delete();
        return redirect()->back()->with('success', 'آیتم با موفقیت حذف شد.');
    }
    public function checkout(Cart $cart)
    {
        return view('site.bying.checkout',compact('cart'));
    }
    public function store(Cart $cart,Request $request)
    {
        // return $request;
        $request->validate(['image'=>'required|image|max:5000'],[
            'image.required'=>'ارسال رسید الزامی است.',
            'image.image'=>'رسید باید به فرمت عکس باشد.',
            'image.max'=>'حد اکثر حجم قابل ارسال 5 مگابایت می‌باشد.',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = 'uploads/receipts';
            $file->move($destination_path, $file_name);
            $path = $destination_path . '/' . $file_name;
        }
        $cart->status = 2;
        $cart->receipt = $path;
        $cart->save();
        return redirect(route('user.requests'))->with('success','رسید با موفقیت دریافت شد. لطفا منتظر بررسی ادمین باشید.');
    }
}
