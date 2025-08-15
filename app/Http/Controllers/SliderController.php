<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(10);
        return view('dashboard.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('dashboard.sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url'],
            'status' => ['required', 'boolean'],
            'image' => ['required', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = 'uploads/sliders';
            $file->move($destination_path, $file_name);
            $data['image'] = $destination_path . '/' . $file_name;
        }

        Slider::create($data);

        return redirect()->route('sliders.index')->with('success', 'اسلایدر با موفقیت ایجاد شد.');
    }

    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'link' => ['nullable', 'url'],
            'status' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_name = time() . '.' . $file->getClientOriginalExtension();
            $destination_path = 'uploads/sliders';
            $file->move($destination_path, $file_name);
            $data['image'] = $destination_path . '/' . $file_name;
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'اسلایدر بروزرسانی شد.');
    }

    public function destroy(Slider $slider)
    {
        $slider->delete();
        return redirect()->route('sliders.index')->with('success', 'اسلایدر حذف شد.');
    }
}
