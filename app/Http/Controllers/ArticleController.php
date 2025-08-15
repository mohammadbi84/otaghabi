<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('dashboard.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.articles.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string',
            'body' => 'required|string',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'لطفا عنوان مقاله را وارد کنید.',
            'category_id.required' => 'لطفا دسته‌بندی را انتخاب کنید.',
            'summary.required' => 'لطفا خلاصه توضیحات را وارد کنید.',
            'body.required' => 'لطفا متن کامل مقاله را وارد کنید.',
            'cover.required' => 'لطفا تصویر مقاله را انتخاب کنید.',
            'cover.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
        ]);

        $file = $request->file('cover');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('uploads/articles'), $filename);

        Article::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'summary' => $request->summary,
            'body' => $request->body,
            'cover' => 'uploads/articles/' . $filename,
            'author_id' => Auth::id(),
        ]);

        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت ایجاد شد.');
    }

    public function edit(Article $article)
    {
        $categories = Category::all();
        return view('dashboard.articles.edit', compact('article', 'categories'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string',
            'body' => 'required|string',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'title.required' => 'لطفا عنوان مقاله را وارد کنید.',
            'category_id.required' => 'لطفا دسته‌بندی را انتخاب کنید.',
            'summary.required' => 'لطفا خلاصه توضیحات را وارد کنید.',
            'body.required' => 'لطفا متن کامل مقاله را وارد کنید.',
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/articles'), $filename);
            $article->cover = 'uploads/articles/' . $filename;
        }

        $article->update([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'summary' => $request->summary,
            'body' => $request->body,
        ]);

        $article->save();

        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت ویرایش شد.');
    }

    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت حذف شد.');
    }

    // site
    public function blogs(Request $request)
    {
        $query = Article::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('order')) {
            switch ($request->order) {
                case 1: // محبوب‌ترین
                    $query->orderByDesc('view_count');
                    break;
                case 2: // ارزان‌ترین
                    $query->orderBy('price');
                    break;
                case 3: // گران‌ترین
                    $query->orderByDesc('price');
                    break;
            }
        } else {
            $query->latest(); // پیش‌فرض
        }

        $articles = $query->get(); // صفحه‌بندی
        return view('site.blogs.index', compact('articles'));
    }
    public function blog(Article $article)
    {
        // visits
        $existingVisit = $article->visits()
            ->where('ip', request()->ip())
            ->where('created_at', '>=', now()->subDay())
            ->first();
        if (!$existingVisit) {
            $article->visits()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => auth()->id(),
            ]);
            $article->view_count += 1;
            $article->save();
        }

        return view('site.blogs.show', compact('article'));
    }
}
