<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Article;
use App\Models\Category;
use App\Models\PsychologicalTest;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\StaticPageVisit;
use App\Models\User;
use App\Models\Workshop;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {

        $page = StaticPageVisit::firstOrCreate(['slug' => 'home']);

        $existingVisit = $page->visits()
            ->where('ip', request()->ip())
            ->where('created_at', '>=', now()->subDay())
            ->first();

        if (!$existingVisit) {
            $page->visits()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => auth()->id(),
            ]);
        }


        $sliders = Slider::where('status', true)->get();
        $top_cats = Category::orderByDesc('created_at')->take(4)->get();
        $top_cats_id = Category::orderByDesc('created_at')->take(4)->pluck('id');
        $categories = Category::latest()->whereNotIn('id', $top_cats_id)->get();
        $workshops = Workshop::orderByDesc('views')->take(8)->get();
        $articles = Article::latest()->take(8)->get();
        $psychologists = User::where('role', 'psychologist')->take(6)->get();
        return view('site.index', compact(
            'sliders',
            'top_cats',
            'categories',
            'workshops',
            'articles',
            'psychologists',
        ));
    }
    public function about()
    {
        $about = About::first();
        return view('site.about', compact('about'));
    }
    public function contact()
    {
        return view('site.contact');
    }
    public function profile()
    {
        return view('site.user.profile');
    }
    public function edit()
    {
        return view('site.user.edit');
    }
    public function update(Request $request)
    {
        return view('site.user.tests');
    }
    public function orders()
    {
        return view('site.user.orders');
    }
    public function workshops()
    {
        return view('site.user.workshops');
    }
    public function tests()
    {
        return view('site.user.tests');
    }
    public function appointment()
    {
        $psychologists = User::where('role', 'psychologist')->get();
        return view('site.appointment', compact('psychologists'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $results = [];

        if (strlen($query) >= 2) {
            // جستجو در مقالات
            $articles = Article::where('title', 'like', "%{$query}%")
                ->orWhere('body', 'like', "%{$query}%")
                ->orWhere('summary', 'like', "%{$query}%")
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'article',
                        'title' => $item->title,
                        'image' => asset($item->cover), // یا هر فیلد مربوط به عکس
                        'description' => strip_tags($item->content)
                    ];
                });

            // جستجو در دسته‌بندی‌ها
            $categories = Category::where('title', 'like', "%{$query}%")
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'category',
                        'name' => $item->name,
                        'image' => asset($item->image), // یا هر فیلد مربوط به عکس
                        'description' => strip_tags($item->content)
                    ];
                });

            // جستجو در تست‌های روانشناسی
            $tests = PsychologicalTest::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'psychologicaltest',
                        'title' => $item->title,
                        'image' => asset($item->cover), // یا هر فیلد مربوط به عکس
                        'description' => strip_tags($item->content)
                    ];
                });

            // جستجو در روانشناسان
            $psychologists = User::where('role', 'psychologist')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%{$query}%")
                        ->orWhere('bio', 'like', "%{$query}%");
                })
                ->take(3)
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'type' => 'user',
                        'role' => 'psychologist',
                        'name' => $item->name,
                        'image' => asset($item->image), // یا هر فیلد مربوط به عکس
                        'description' => strip_tags($item->bio)
                    ];
                });

            $results = $articles->concat($categories)->concat($tests)->concat($psychologists)->take(10);
        }

        return response()->json($results);
    }
}
