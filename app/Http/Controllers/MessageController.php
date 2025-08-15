<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $message = Message::create([
            'name'=>$request->name,
            'mobile'=>$request->mobile,
            'text'=>$request->text,
        ]);
        return redirect()->back()->with('success','پیام شما با موفقیت ارسال شد.');
    }
    public function index()
    {
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.messages.index', compact('messages'));
    }
}
