<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ConsultationAnswer;
use App\Models\ConsultationQuestion;
use App\Models\ConsultationRequest;
use App\Models\User;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    public function create($consultantId = null)
    {
        $consultants = User::where('role', 'psychologist')->get();
        $categories = Category::all();
        $questions = ConsultationQuestion::where('is_active',true)->get();
        return view('site.appointment', [
            'consultants' => $consultants,
            'selectedConsultant' => $consultantId,
            'categories' => $categories,
            'questions' => $questions,
        ]);
    }


    public function store(Request $request)
    {
        // شرطی‌سازی ولیدیشن
        $rules = [
            'name' => 'required|string|max:100',
            'mobile' => 'required|digits:11',
        ];

        // اگر کاربر "نیاز به کمک دارم" انتخاب کرده
        if ($request->category_id == 0) {
            $rules['questions'] = 'required|array|min:1';
            $rules['questions.*'] = 'required|string|max:500';
        } else {
            $rules['category_id'] = 'required|exists:categories,id';
            $rules['consultant_id'] = 'required|exists:users,id';
        }

        $messages = [
            'name.required' => 'نام الزامی می‌باشد.',
            'mobile.required' => 'شماره موبایل الزامی می‌باشد.',
            'mobile.digits' => 'شماره موبایل باید 11 رقمی باشد.',

            'category_id.required' => 'انتخاب حوزه مشاوره الزامی می‌باشد.',
            'consultant_id.required' => 'انتخاب مشاور الزامی می‌باشد.',

            'questions.required' => 'پاسخ به سوالات الزامی است.',
            'questions.*.required' => 'تمام سوالات باید پاسخ داده شوند.',
        ];

        $data = $request->validate($rules, $messages);

        // بررسی وجود درخواست در حال انتظار با همین شماره موبایل
        $exists = ConsultationRequest::where('mobile', $data['mobile'])
            ->where('status', 'pending')
            ->exists();

        if ($exists) {
            return redirect()->back()
                ->with('fail', 'با این شماره موبایل یک درخواست در حال بررسی ثبت شده است.')
                ->withInput();
        }

        $data['user_id'] = auth()->id();

        $consultation = ConsultationRequest::create($data);

        // اگر سوالات وجود داشت، ذخیره بشن
        if ($request->category_id == 0 && $request->has('questions')) {
            foreach ($request->questions as $questionId => $answer) {
                ConsultationAnswer::create([
                    'consultation_request_id' => $consultation->id,
                    'consultation_question_id'     => $questionId,
                    'answer'          => $answer,
                ]);
            }
        }

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

        return redirect(route('consultations.index'))->with('success', 'وضعیت نوبت با موفقیت به‌روزرسانی شد.');
    }

    public function destroy(ConsultationRequest $consultation)
    {
        $consultation->delete();
        return back()->with('success', 'نوبت مشاوره با موفقیت حذف شد.');
    }
    public function show(ConsultationRequest $consultation)
    {
        $statuses = [
            'pending' => 'در انتظار تایید',
            'approved' => 'تکمیل شده',
            'rejected' => 'رد شده',
        ];

        // سوالات و جواب‌های مرتبط با درخواست
        $answers = $consultation->answers()->with('question')->get();

        return view('dashboard.consultations.show', compact('consultation', 'statuses', 'answers'));
    }
}
