<?php

namespace App\Http\Controllers;

use App\Models\PsychologicalTest;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PsychologicalTestController extends Controller
{
    public function index()
    {
        $tests = PsychologicalTest::with('category')->latest()->paginate(10);
        return view('dashboard.psychological_tests.index', compact('tests'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.psychological_tests.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'short_description' => 'required',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'test_link' => 'required|url',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'عنوان تست را وارد کنید.',
            'description.required' => 'توضیحات تست را وارد کنید.',
            'short_description.required' => 'توضیح کوتاه را وارد کنید.',
            'price.required' => 'قیمت را وارد کنید.',
            'category_id.required' => 'دسته‌بندی را انتخاب کنید.',
            'test_link.required' => 'لینک آزمون را وارد کنید.',
            'test_link.url' => 'لینک وارد شده معتبر نمی‌باشد.',
            'cover.image' => 'فایل باید تصویر باشد.',
        ]);

        $filename = null;
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = 'psychological_tests/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/psychological_tests'), $filename);
        }

        $finalPrice = $request->price - $request->discount;

        PsychologicalTest::create([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'final_price' => $finalPrice,
            'category_id' => $request->category_id,
            'test_link' => $request->test_link,
            'cover' => 'uploads/psychological_tests/' . $filename
        ]);

        return redirect()->route('psychological-tests.index')->with('success', 'تست جدید با موفقیت اضافه شد.');
    }

    public function edit($id)
    {
        $test = PsychologicalTest::findOrFail($id);
        $categories = Category::all();
        return view('dashboard.psychological_tests.create', compact('test', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $test = PsychologicalTest::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'short_description' => 'required',
            'price' => 'required|integer|min:0',
            'discount' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'test_link' => 'required|url',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png',
        ], [
            'title.required' => 'عنوان تست را وارد کنید.',
            'description.required' => 'توضیحات تست را وارد کنید.',
            'short_description.required' => 'توضیح کوتاه را وارد کنید.',
            'price.required' => 'قیمت را وارد کنید.',
            'category_id.required' => 'دسته‌بندی را انتخاب کنید.',
            'test_link.required' => 'لینک آزمون را وارد کنید.',
            'test_link.url' => 'لینک وارد شده معتبر نمی‌باشد.',
            'cover.image' => 'فایل باید تصویر باشد.',
        ]);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = 'psychological_tests/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/psychological_tests'), $filename);
            $test->cover = 'uploads/psychological_tests/' . $filename;
        }

        $test->update([
            'title' => $request->title,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'final_price' => $request->price - $request->discount,
            'category_id' => $request->category_id,
            'test_link' => $request->test_link,
        ]);

        return redirect()->route('psychological-tests.index')->with('success', 'تست با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        $test = PsychologicalTest::findOrFail($id);
        $test->delete();
        return redirect()->route('psychological-tests.index')->with('success', 'تست با موفقیت حذف شد.');
    }

    // site
    public function tests(Request $request)
    {
        $query = PsychologicalTest::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('order')) {
            switch ($request->order) {
                case 1: // محبوب‌ترین
                    $query->orderByDesc('views');
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

        $tests = $query->get(); // صفحه‌بندی
        return view('site.tests.index', compact('tests'));
    }
    public function test(PsychologicalTest $test)
    {

        // visits
        $existingVisit = $test->visits()
            ->where('ip', request()->ip())
            ->where('created_at', '>=', now()->subDay())
            ->first();
        if (!$existingVisit) {
            $test->visits()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => auth()->id(),
            ]);
            $test->view_count += 1;
            $test->save();
        }



        $alreadyInCart = false;
        if (Auth()->user()) {
            $user = User::find(auth()->id());
            $cart = $user->carts()->where('status', 0)->firstOrCreate(
                ['status' => 0],
                ['status' => 0, 'user_id' => auth()->id()]
            );
            $alreadyInCart = $cart
                ? $cart->items()->where('item_id', $test->id)->where('item_type', PsychologicalTest::class)->exists()
                : false;
        }
        $similars = PsychologicalTest::where('category_id', $test->category_id)->get();
        return view('site.tests.show', compact('test', 'similars','alreadyInCart'));
    }
}
