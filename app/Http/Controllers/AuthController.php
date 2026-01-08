<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::user()) {
            return redirect('/');
        } else {
            return view('auth.login');
        }
    }

    public function signin(Request $request)
    {
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                Auth::login($user);
                if ($user->hasRole('admin')) {
                    return redirect(route('dashboard'))->with('success', $user->name.' عزیز! با موفقیت وارد شدید. ');
                }

                return redirect('/');
            } else {
                return redirect()->back()->with('fail', 'رمز عبود اشتباه است لطفا دوباره تلاش کنید');
            }
        } else {
            return redirect()->back()->with('fail', 'کاربر پیدا نشد');
        }
    }

    public function signup()
    {
        if (Auth::user()) {
            return redirect('/');
        } else {
            return view('auth.register');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11|unique:users,mobile',
            'password' => 'required|min_digits:6',
        ], [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.digits' => 'شماره موبایل باید 11 رقمی باشد',
            'mobile.unique' => 'این شماره موبایل قبلاً ثبت شده است',
            'password.required' => 'لطفا یک رمز عبور برای خود انتخاب کنید',
            'password.min_digits' => 'رمز عبور باید حداقل 6 رقم داشته باشد',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->password = $request->password;
        $user->save();
        $user->syncRoles(['user']);

        return redirect()->route('login')->with('success', 'ثبت نام با موفقیت تکمیل شد');
    }

    public function logout()
    {
        if (Auth::user()) {
            Auth::logout();

            return redirect('/login')->with('success', 'شما با موفقیت خارج شدید');
        } else {
            return redirect('/login');
        }
    }
}
