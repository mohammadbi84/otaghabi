@extends('dashboard.layout.master')

@section('title')
    <title>جزئیات درخواست مشاوره</title>
@endsection

@section('body')
<div class="col px-4">
    <div class="row mt-4 p-4 rounded-4 shadow bg-white">
        <h5 class="mb-4">جزئیات درخواست مشاوره #{{ $consultation->id }}</h5>

        <!-- جدول اطلاعات درخواست -->
        <table class="table table-bordered mb-4">
            <tbody>
                <tr>
                    <th class="w-25">نام درخواست‌دهنده</th>
                    <td>{{ $consultation->name }}</td>
                </tr>
                <tr>
                    <th>موبایل</th>
                    <td>{{ $consultation->mobile }}</td>
                </tr>
                <tr>
                    <th>دسته‌بندی</th>
                    <td>{{ $consultation->category->title ?? '--' }}</td>
                </tr>
                <tr>
                    <th>مشاور</th>
                    <td>{{ $consultation->consultant->name ?? '--' }}</td>
                </tr>
                <tr>
                    <th>تاریخ ثبت</th>
                    <td>{{ jdate($consultation->created_at)->format('Y/m/d H:i') }}</td>
                </tr>
                <tr>
                    <th>وضعیت فعلی</th>
                    <td>
                        @if($consultation->status == 'pending')
                            <span class="badge bg-warning">در انتظار بررسی</span>
                        @elseif($consultation->status == 'approved')
                            <span class="badge bg-success">تایید شده</span>
                        @else
                            <span class="badge bg-danger">رد شده</span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- سوالات و جواب‌ها -->
        @if ($answers->count())
            <div class="mb-4">
                <h6>سوالات تکمیلی</h6>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>سوال</th>
                            <th>پاسخ کاربر</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($answers as $answer)
                            <tr>
                                <td>{{ $answer->question->question }}</td>
                                <td>{{ $answer->answer }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-muted">هیچ سوالی برای این درخواست ثبت نشده است.</p>
        @endif


        <!-- تغییر وضعیت -->
        <div class="mb-4">
            <div class="d-flex gap-2">
                <form action="{{ route('consultations.update-status', $consultation->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="approved">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-check"></i> بررسی شد
                    </button>
                </form>

                <form action="{{ route('consultations.update-status', $consultation->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="rejected">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-times"></i> رد درخواست
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
