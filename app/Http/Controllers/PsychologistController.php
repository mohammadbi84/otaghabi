<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\City;
use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function index()
    {
        $psychologists = User::where('role', 'psychologist')->paginate(10);
        return view('dashboard.psychologists.index', compact('psychologists'));
    }

    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        return view('dashboard.psychologists.create', compact('categories', 'cities'));
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11',
            'bio' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'degree' => 'required|string',
            'is_online' => 'required|boolean',
            'categories' => 'required|array',
        ], [
            'name.required' => 'وارد کردن نام الزامی است.',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.digits' => 'شماره موبایل باید 11 رقمی باشد',
            'bio.required' => 'وارد کردن توضیحات الزامی است.',
            'city_id.required' => 'انتخاب شهر الزامی است.',
            'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',
            'degree.required' => 'وارد کردن مدرک الزامی است.',
            'is_online.required' => 'وارد کردن وضعیت مشاوره آنلاین الزامی است.',
            'categories.required' => 'انتخاب حداقل یک حوزه مشاوره الزامی است.',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = 'uploads/users';
            $file->move($destination_path, $file_name);
            $path = $destination_path . '/' . $file_name;
        }

        $psychologist = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'bio' => $request->bio,
            'city_id' => $request->city_id,
            'degree' => $request->degree,
            'online_consultation' => $request->is_online,
            'role' => 'psychologist',
            'password' => 12345,
            'image' => $path ?? null,
        ]);

        $psychologist->categories()->attach($request->categories);

        return redirect()->route('psychologists.index')->with('success', 'روانشناس با موفقیت ایجاد شد.');
    }

    public function edit(User $psychologist)
    {
        $categories = Category::all();
        $cities = City::all();
        $psychologistCategories = $psychologist->categories()->pluck('categories.id')->toArray();
        return view('dashboard.psychologists.edit', compact('psychologist', 'categories', 'cities', 'psychologistCategories'));
    }

    public function update(Request $request, User $psychologist)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|numeric|digits:11',
            'bio' => 'required|string',
            'city_id' => 'required|exists:cities,id',
            'degree' => 'required|string',
            'is_online' => 'required|boolean',
            'categories' => 'required|array',
        ], [
            'name.required' => 'وارد کردن نام الزامی است.',
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.digits' => 'شماره موبایل باید 11 رقمی باشد',
            'bio.required' => 'وارد کردن توضیحات الزامی است.',
            'city_id.required' => 'انتخاب شهر الزامی است.',
            'city_id.exists' => 'شهر انتخاب شده معتبر نیست.',
            'degree.required' => 'وارد کردن مدرک الزامی است.',
            'is_online.required' => 'وارد کردن وضعیت مشاوره آنلاین الزامی است.',
            'categories.required' => 'انتخاب حداقل یک حوزه مشاوره الزامی است.',
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = 'uploads/users';
            $file->move($destination_path, $file_name);
            $path = $destination_path . '/' . $file_name;
        }

        $psychologist->update([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'bio' => $request->bio,
            'city_id' => $request->city_id,
            'degree' => $request->degree,
            'online_consultation' => $request->is_online,
            'image' => $path ?? null,
        ]);

        $psychologist->categories()->sync($request->categories);

        return redirect()->route('psychologists.index')->with('success', 'اطلاعات روانشناس با موفقیت بروزرسانی شد.');
    }

    public function destroy(User $psychologist)
    {
        $psychologist->categories()->detach();
        $psychologist->delete();

        return redirect()->route('psychologists.index')->with('success', 'روانشناس با موفقیت حذف شد.');
    }
    public function psychologists(Request $request, Category $category = null)
    {
        if ($request->online) {
            $categories = Category::all();
            $psychologists = User::where('role', 'psychologist')->where('online_consultation', true)->get();
            return view('site.psychologists.index', compact('psychologists', 'categories'));
        }
        if ($category) {
            $psychologists = $category->psychologists()->get();
            return view('site.psychologists.index', compact('psychologists', 'category'));
        } else {
            $categories = Category::all();
            $psychologists = User::where('role', 'psychologist')->get();
            return view('site.psychologists.index', compact('psychologists', 'categories'));
        }
        
    }
    public function psychologist(User $psychologist)
    {
        return view('site.psychologists.show', compact('psychologist'));
    }
}
