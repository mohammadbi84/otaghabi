<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\ConsultationRequest;
use App\Models\Message;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

class DashboardController extends Controller
{
    //
    function jalali_month($date)
    {
        // اطمینان از فرمت ورودی (YYYY-MM)
        $dateWithDay = $date . '-01'; // اضافه کردن روز پیش‌فرض
        $jalaliDate = Jalalian::fromDateTime($dateWithDay);
        return $jalaliDate->format('%B'); // فقط نام ماه شمسی
    }
    public function index()
    {
        $months = collect();
        $visits = collect();
        $users = collect();
        $comments = collect();

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i)->format('Y-m');

            $months->push($this->jalali_month($month)); // یا همون Y-m

            $visits->push(
                Visit::whereYear('created_at', now()->subMonths($i)->year)
                    ->whereMonth('created_at', now()->subMonths($i)->month)
                    ->count()
            );

            $users->push(
                User::whereYear('created_at', now()->subMonths($i)->year)
                    ->whereMonth('created_at', now()->subMonths($i)->month)
                    ->count()
            );

            $comments->push(
                Comment::whereYear('created_at', now()->subMonths($i)->year)
                    ->whereMonth('created_at', now()->subMonths($i)->month)
                    ->count()
            );
        }

        $messages_count = Message::count();
        $appointment = ConsultationRequest::where('status','pending')->count();
        return view('dashboard.dashboard', [
            'months' => $months,
            'visits' => $visits,
            'users' => $users,
            'comments' => $comments
        ],compact('messages_count',
        'appointment'));
        // return view('dashboard.dashboard');
    }
}
