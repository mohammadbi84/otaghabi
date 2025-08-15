<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->where('role','user')->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('dashboard.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'کاربر با موفقیت حذف شد.');
    }
}
