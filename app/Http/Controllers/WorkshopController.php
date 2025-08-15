<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use App\Models\Category;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    public function index()
    {
        $workshops = Workshop::latest()->paginate(10);
        return view('dashboard.workshops.index', compact('workshops'));
    }
    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        $teachers = User::where('role', 'psychologist')->get(); // فقط روانشناسان
        return view('dashboard.workshops.create', compact('categories', 'cities', 'teachers'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'type' => 'required|in:online,offline,in_person',
            'category' => 'required|exists:categories,id',
        ], [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'short_description.required' => 'وارد کردن توضیح کوتاه الزامی است.',
            'description.required' => 'وارد کردن توضیح کامل الزامی است.',
            'teacher_id.required' => 'انتخاب استاد الزامی است.',
            'price.required' => 'وارد کردن قیمت الزامی است.',
            'type.required' => 'انتخاب نوع برگزاری الزامی است.',
            'category.required' => 'انتخاب حداقل یک حوزه الزامی است.',
        ]);

        $final_price = $request->price - ($request->discount ?? 0);

        $workshop = Workshop::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'teacher_id' => $request->teacher_id,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'final_price' => $final_price,
            'type' => $request->type,
            'link' => $request->link,
            'capacity' => $request->capacity,
            'age_group' => $request->age_group,
            'city_id' => $request->city_id,
            'category_id' => $request->category,
        ]);

        // آپلود کاور
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $workshop->cover = 'uploads/covers/' . $filename;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/videos'), $filename);
            $workshop->video = 'uploads/videos/' . $filename;
        }
        $workshop->save();
        return redirect()->route('workshops.index')->with('success', 'کارگاه با موفقیت ایجاد شد.');
    }
    public function edit(Workshop $workshop)
    {
        $categories = Category::all();
        $cities = City::all();
        $teachers = User::where('role', 'psychologist')->get();
        $workshopCategories = $workshop->category()->pluck('categories.id')->toArray();

        return view('dashboard.workshops.create', compact('workshop', 'categories', 'cities', 'teachers', 'workshopCategories'));
    }
    public function update(Request $request, Workshop $workshop)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'teacher_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'type' => 'required|in:online,offline,in_person',
            'category' => 'required|exists:categories,id',
        ], [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'short_description.required' => 'وارد کردن توضیح کوتاه الزامی است.',
            'description.required' => 'وارد کردن توضیح کامل الزامی است.',
            'teacher_id.required' => 'انتخاب استاد الزامی است.',
            'price.required' => 'وارد کردن قیمت الزامی است.',
            'type.required' => 'انتخاب نوع برگزاری الزامی است.',
            'category.required' => 'انتخاب حداقل یک حوزه الزامی است.',
        ]);

        $final_price = $request->price - ($request->discount ?? 0);

        $workshop->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'teacher_id' => $request->teacher_id,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'final_price' => $final_price,
            'type' => $request->type,
            'link' => $request->link,
            'capacity' => $request->capacity,
            'age_group' => $request->age_group,
            'city_id' => $request->city_id,
            'category_id' => $request->category,
        ]);

        // آپلود کاور
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/covers'), $filename);
            $workshop->cover = 'uploads/covers/' . $filename;
        }
        if ($request->hasFile('video')) {
            $file = $request->file('video');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/videos'), $filename);
            $workshop->video = 'uploads/videos/' . $filename;
        }
        $workshop->save();
        return redirect()->route('workshops.index')->with('success', 'کارگاه با موفقیت ویرایش شد.');
    }
    public function destroy(Workshop $workshop)
    {
        $workshop->delete();
        return redirect()->route('workshops.index')->with('success', 'کارگاه با موفقیت حذف شد.');
    }

    // site
    public function workshops(Request $request)
    {
        $query = Workshop::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

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

        $workshops = $query->get();
        return view('site.workshops.index', compact('workshops'));
    }
    public function workshop(Workshop $workshop)
    {

        // visits
        $existingVisit = $workshop->visits()
            ->where('ip', request()->ip())
            ->where('created_at', '>=', now()->subDay())
            ->first();
        if (!$existingVisit) {
            $workshop->visits()->create([
                'ip' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'user_id' => auth()->id(),
            ]);
            $workshop->views += 1;
            $workshop->save();
        }


        $alreadyInCart = false;
        if (Auth()->user()) {
            $user = User::find(auth()->id());
            $cart = $user->carts()->where('status', 0)->firstOrCreate(
                ['status' => 0],
                ['status' => 0, 'user_id' => auth()->id()]
            );
            $alreadyInCart = $cart
                ? $cart->items()->where('item_id', $workshop->id)->where('item_type', Workshop::class)->exists()
                : false;
        }
        $similars = Workshop::where('category_id', $workshop->category_id)->get();
        return view('site.workshops.show', compact('workshop', 'similars', 'alreadyInCart'));
    }
}
