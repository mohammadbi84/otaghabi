<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->filled('website')) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'text' => 'required|string|max:2000',
        ], [
            'name.required' => 'لطفا نام و نام خانوادگی خود را وارد کنید',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'text.required' => 'لطفا متن پیام خود را وارد کنید',
        ]);
        $message = Message::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'text' => $request->text,
        ]);

        return redirect()->back()->with('success', 'پیام شما با موفقیت ارسال شد.');
    }

    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.messages.index', compact('messages'));
    }
}
