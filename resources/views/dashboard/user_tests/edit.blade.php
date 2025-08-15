@extends('dashboard.layouts.master')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">ویرایش وضعیت تست کاربر</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('user-tests.update', $userTest->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block mb-1">کاربر</label>
            <input type="text" value="{{ $userTest->user->name }}" class="form-input" disabled>
        </div>

        <div class="mb-4">
            <label class="block mb-1">تست</label>
            <input type="text" value="{{ $userTest->psychologicalTest->title }}" class="form-input" disabled>
        </div>

        <div class="mb-4">
            <label class="block mb-1">وضعیت</label>
            <select name="status" class="form-select">
                <option value="در حال انجام" {{ $userTest->status == 'در حال انجام' ? 'selected' : '' }}>در حال انجام
                </option>
                <option value="تکمیل شده" {{ $userTest->status == 'تکمیل شده' ? 'selected' : '' }}>تکمیل شده</option>
            </select>
        </div>

        <div class="mb-4">
            <label class="block mb-1">آپلود فایل نتیجه (PDF)</label>
            <input type="file" name="result_file" class="form-input">
            @if ($userTest->result_file)
                <a href="{{ asset($userTest->result_file) }}" target="_blank" class="text-blue-500 mt-2 block">دانلود فایل
                    فعلی</a>
            @endif
        </div>

        <button type="submit" class="btn btn-success">بروزرسانی وضعیت</button>
    </form>
@endsection
