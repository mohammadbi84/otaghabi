<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ConsultationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    public function create($consultantId = null)
    {
        $consultants = User::where('role', 'psychologist')->get();
        $categories = Category::all();
        return view('site.appointment', [
            'consultants' => $consultants,
            'selectedConsultant' => $consultantId,
            'categories' => $categories
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'mobile' => 'required|digits:11',
            'category_id' => 'required|exists:categories,id',
            'consultant_id' => 'required|exists:users,id',
        ], [
            'name.required' => 'نام الزامی می‌باشد.',
            'mobile.required' => 'شماره موبایل الزامی می‌باشد.',
            'category_id.required' => 'انتخاب حوزه مشاوره الزامی می‌باشد.',
            'consultant_id.required' => 'انتخاب مشاور الزامی می‌باشد.',
            'digits.digits' => 'شماره موبایل باید 11 رقمی باشد.',
        ]);
        // بررسی وجود درخواست در حال انتظار با همین شماره موبایل
        // $exists = ConsultationRequest::where('mobile', $data['mobile'])
        //     ->where('status', 'pending')
        //     ->exists();

        // if ($exists) {
        //     return redirect()->back()
        //         ->with('fail', 'با این شماره موبایل یک درخواست در حال بررسی ثبت شده است.')
        //         ->withInput();
        // }
        $data['user_id'] = auth()->id(); // اگر لاگین کرده باشه

        ConsultationRequest::create($data);

        return redirect(route('user.profile'))->with('success', 'درخواست شما با موفقیت ثبت شد.');
    }

    public function getConsultantsByField($field)
    {
        $consultants = User::where('role', 'psychologist')
            ->where('field', $field)
            ->get(['id', 'name']);

        return response()->json($consultants);
    }

    public function index()
    {
        $consultations = ConsultationRequest::with(['user', 'category', 'consultant'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $statuses = [
            'pending' => 'در انتظار تایید',
            'approved' => 'تکمیل شده',
            'rejected' => 'رد شده',
        ];

        return view('dashboard.consultations.index', compact('consultations', 'statuses'));
    }

    public function updateStatus(Request $request, ConsultationRequest $consultation)
    {
        // return $request;
        $validated = $request->validate([
            'status' => 'required'
        ]);

        $consultation->update(['status' => $validated['status']]);

        return back()->with('success', 'وضعیت نوبت با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(ConsultationRequest $consultation)
    {
        $consultation->delete();
        return back()->with('success', 'نوبت مشاوره با موفقیت حذف شد.');
    }
}
