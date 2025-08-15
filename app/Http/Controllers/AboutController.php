<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::firstOrCreate([]);
        return view('dashboard.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $about = About::first();
        $about->update([
            'content' => $request->content,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $path = $img->store('about_gallery', 'public');
                $about->galleries()->create(['image' => $path]);
            }
        }

        return redirect()->back()->with('success', 'بروزرسانی شد');
    }

    public function deleteImage($id)
    {
        $image = AboutGallery::findOrFail($id);
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return back()->with('success', 'تصویر حذف شد');
    }
}
