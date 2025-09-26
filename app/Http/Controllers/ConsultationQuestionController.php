<?php

namespace App\Http\Controllers;

use App\Models\ConsultationQuestion;
use Illuminate\Http\Request;

class ConsultationQuestionController extends Controller
{
    public function index()
    {
        $questions = ConsultationQuestion::all();
        return view('dashboard.consultation_questions.index', compact('questions'));
    }

    public function bulkUpdate(Request $request)
    {
        $data = $request->input('questions', []);

        foreach ($data as $item) {
            if (!empty($item['id'])) {
                // بروزرسانی سوال موجود
                $question = ConsultationQuestion::find($item['id']);
                if ($question) {
                    $question->update([
                        'question' => $item['question'] ?? '',
                    ]);
                }
            } else {
                // ساخت سوال جدید
                if (!empty($item['question'])) {
                    ConsultationQuestion::create([
                        'question' => $item['question'],
                    ]);
                }
            }
        }

        return redirect()->route('consultation-questions.index')
            ->with('success', 'سوالات با موفقیت ذخیره شدند.');
    }
    public function destroy($id)
    {
        $question = ConsultationQuestion::find($id);

        if ($question) {
            $question->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
