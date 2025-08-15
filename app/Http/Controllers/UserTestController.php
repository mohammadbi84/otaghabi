<?php

namespace App\Http\Controllers;

use App\Models\UserTest;
use App\Models\PsychologicalTest;
use App\Models\User;
use Illuminate\Http\Request;

class UserTestController extends Controller
{
    public function index()
    {
        $userTests = UserTest::with('user', 'psychologicalTest')->latest()->paginate(10);
        return view('dashboard.user_tests.index', compact('userTests'));
    }

    public function edit($id)
    {
        $userTest = UserTest::with('user', 'psychologicalTest')->findOrFail($id);
        return view('dashboard.user_tests.edit', compact('userTest'));
    }

    public function update(Request $request, $id)
    {
        $userTest = UserTest::findOrFail($id);
        $request->validate([
            'status' => 'required|in:in_progress,completed',
            'result_file' => 'nullable|mimes:pdf'
        ], [
            'status.required' => 'وضعیت را انتخاب کنید.',
            'result_file.mimes' => 'فایل نتیجه باید از نوع PDF باشد.'
        ]);

        if ($request->hasFile('result_file')) {
            $file = $request->file('result_file');
            $filename = 'results/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('results'), $filename);
            $userTest->result_file = $filename;
        }

        $userTest->status = $request->status;
        $userTest->save();

        return redirect()->route('user-tests.index')->with('success', 'وضعیت تست با موفقیت بروزرسانی شد.');
    }

    public function destroy($id)
    {
        $userTest = UserTest::findOrFail($id);
        $userTest->delete();
        return redirect()->route('user-tests.index')->with('success', 'رکورد با موفقیت حذف شد.');
    }
}
