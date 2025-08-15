<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'body' => 'required|string',
            'commentable_type' => 'required|string',
            'commentable_id' => 'required|integer',
        ]);

        $modelClass = $request->commentable_type;

        if (!class_exists($modelClass)) {
            abort(404);
        }

        $model = $modelClass::findOrFail($request->commentable_id);

        $model->comments()->create([
            'name' => $request->name,
            'body' => $request->body,
        ]);

        return back()->with('success', 'نظر شما با موفقیت ثبت شد و پس از تایید نمایش داده خواهد شد.');
    }

    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return back()->with('success', 'نظر با موفقیت تایید شد.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'نظر با موفقیت حذف شد.');
    }
}
