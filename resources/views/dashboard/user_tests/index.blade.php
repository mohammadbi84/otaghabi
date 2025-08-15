@extends('dashboard.layouts.master')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">لیست تست‌های خریداری شده</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>کاربر</th>
                <th>تست</th>
                <th>وضعیت</th>
                <th>فایل نتیجه</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($userTests as $userTest)
                <tr>
                    <td>{{ $userTest->user->name }}</td>
                    <td>{{ $userTest->psychologicalTest->title }}</td>
                    <td>{{ $userTest->status }}</td>
                    <td>
                        @if ($userTest->result_file)
                            <a href="{{ asset($userTest->result_file) }}" target="_blank" class="text-blue-500">دانلود
                                نتیجه</a>
                        @else
                            ---
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('user-tests.edit', $userTest->id) }}" class="btn btn-warning btn-sm">ویرایش</a>
                        <form action="{{ route('user-tests.destroy', $userTest->id) }}" method="POST"
                            onsubmit="return confirm('آیا مطمئن هستید؟')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $userTests->links() }}
    </div>
@endsection
