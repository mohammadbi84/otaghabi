@extends('dashboard.layout.master')
@section('title')
<title>لیست تست های روانشناختی</title>
@endsection
@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">لیست تست‌های روانشناختی</h5>
                <a href="{{ route('psychological-tests.create') }}" class="btn btn-danger float-start">افزودن تست جدید</a>
            </div>
            <div class="table-responsive-sm">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>عنوان</th>
                            <th>دسته‌بندی</th>
                            <th>قیمت</th>
                            <th>لینک تست</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tests as $test)
                            <tr>
                                <td>{{ $test->title }}</td>
                                <td>{{ $test->category->title }}</td>
                                <td>{{ number_format($test->final_price) }} تومان</td>
                                <td><a href="{{ $test->test_link }}" target="_blank" class="text-blue-500">مشاهده لینک</a>
                                </td>
                                <td>
                                    <a href="{{ route('psychological-tests.edit', $test->id) }}" class="text-warning"><i
                                            class="fa-solid fa-pen-to-square"></i> ویرایش</a>
                                    <form action="{{ route('psychological-tests.destroy', $test->id) }}" method="POST"
                                        onsubmit="return confirm('آیا مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1"><i
                                                class="fa-regular fa-trash-can"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tests->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
