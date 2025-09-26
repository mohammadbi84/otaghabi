<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PsychologicalTest;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function index()
    {
        $carts = Cart::orderByDesc('updated_at')->whereNot('status', 0)->paginate(20);
        // return $carts;
        return view('dashboard.orders.index', compact('carts'));
    }

    public function show($id)
    {
        $cart = Cart::findOrFail($id);
        // return $cart->items;
        // return $cart;
        return view('dashboard.orders.show', compact('cart'));
    }
    public function status($id, Request $request)
    {
        $cart = Cart::findOrFail($id);
        $cart->status = $request->status;
        $cart->save();
        if ($request->status == 3) {
            foreach ($cart->items as $cartItem) {
                $item = $cartItem->item; // همون ورکشاپ یا تست

                if ($item instanceof Workshop) {
                    // اضافه کردن ورکشاپ به کاربر
                    $cart->user->workshops_buy()->syncWithoutDetaching([$item->id]);
                } elseif ($item instanceof PsychologicalTest) {
                    // اضافه کردن تست روانشناسی به کاربر
                    $cart->user->psychological_tests()->syncWithoutDetaching([$item->id]);
                }
            }
            return redirect()->back()->with('success', 'شفارش با موفقیت تکمیل شد.');
        } else {
            return redirect()->back()->with('success', 'شفارش با موفقیت رد شد.');
        }
    }
}
