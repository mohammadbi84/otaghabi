<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->keyBy('key');
        return view('dashboard.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $keys = [
            'slider_text',
            'why_clinic_1',
            'why_clinic_2',
            'why_clinic_3',
            'why_clinic_4',
            'why_clinic_text_1',
            'why_clinic_text_2',
            'why_clinic_text_3',
            'why_clinic_text_4',
            'mission_number_1',
            'mission_number_2',
            'mission_number_3',
            'mission_number_4',
            'mission_text_1',
            'mission_text_2',
            'mission_text_3',
            'mission_text_4',
            'manager_text',
            'manager_image',
            'footer_text',
            'cart_numder',
            'cart_owner',
            'bank_name',
        ];

        foreach ($keys as $key) {
            if ($key === 'manager_image' && $request->hasFile('manager_image')) {

                $file = $request->file('manager_image');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'uploads/settings';
                $file->move($destination_path, $file_name);
                $path = $destination_path . '/' . $file_name;
                Setting::updateOrCreate(['key' => 'manager_image'], ['value' => $path]);
            } elseif ($request->has($key)) {
                Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key)]);
            }
        }

        return back()->with('success', 'تنظیمات با موفقیت ذخیره شد.');
    }
}
