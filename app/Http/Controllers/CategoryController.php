<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // نمایش لیست دسته‌بندی‌ها
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(1);
        return view('dashboard.categories.index', compact('categories'));
    }

    // ذخیره دسته‌بندی جدید
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'title.required' => 'وارد کردن عنوان دسته‌بندی الزامی است.',
            'title.max' => 'عنوان دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'short_description.max' => 'توضیح کوتاه نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
            'image.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg یا png یا jpg باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت ایجاد شد.');
    }

    // نمایش فرم ویرایش
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    // آپدیت دسته‌بندی
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'title.required' => 'وارد کردن عنوان دسته‌بندی الزامی است.',
            'title.max' => 'عنوان دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'short_description.max' => 'توضیح کوتاه نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
            'image.image' => 'فایل انتخاب شده باید یک تصویر باشد.',
            'image.mimes' => 'فرمت تصویر باید jpeg یا png یا jpg باشد.',
            'image.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }

            $imagePath = $request->file('image')->store('categories', 'public');
            $category->image = $imagePath;
        }

        $category->update([
            'title' => $request->title,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'image' => $category->image,
        ]);

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت ویرایش شد.');
    }

    // حذف دسته‌بندی
    public function destroy(Category $category)
    {
        // حذف عکس
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        // حذف دسته‌بندی
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'دسته‌بندی با موفقیت حذف شد.');
    }
}
