<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('role', 'user')->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        // نمی‌خوایم نقش کاربر اصلی سایت تغییر کنه (id = 1 مثلا)
        if ($user->id == 4) {
            return redirect()->back()->with('fail', 'این کاربر قابل حذف نیست.');
        }
        $user->delete();
        return back()->with('success', 'کاربر با موفقیت حذف شد.');
    }

    public function orders()
    {
        $user = User::find(auth()->id());
        $carts = $user->carts()->whereNot('status', 0)->get();
        // return $carts;
        return view('site.user.orders', compact('carts'));
    }

    public function order($id)
    {
        $cart = Cart::findOrFail($id);
        // return $cart->items;
        // return $cart;
        return view('site.user.order', compact('cart'));
    }
    public function toggleRole(User $user)
    {
        // نمی‌خوایم نقش کاربر اصلی سایت تغییر کنه (id = 1 مثلا)
        if ($user->id == 4) {
            return redirect()->back()->with('fail', 'نقش این کاربر قابل تغییر نیست.');
        }

        if ($user->hasRole('admin')) {
            // اگه ادمینه، نقش ادمین رو حذف کنیم و نقش user بدیم
            $user->removeRole('admin');
            $user->addRole('user');
            $message = 'نقش کاربر به کاربر عادی تغییر کرد.';
        } else {
            // اگه کاربر عادیه، نقش user رو حذف کنیم و ادمین بدیم
            $user->removeRole('user');
            $user->addRole('admin');
            $message = 'نقش کاربر به ادمین تغییر کرد.';
        }

        return redirect()->back()->with('success', $message);
    }
}
