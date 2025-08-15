@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت نظرات</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">مدیریت نظرات</h5>
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام</th>
                            <th>شماره موبایل</th>
                            <th>متن پیام</th>
                            <th>تاریخ</th>
                            {{-- <th>عملیات</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($messages as $key=>$message)
                            <tr>
                                <td class="align-middle">{{ $key+1 }}</td>
                                <td class="align-middle">{{ $message->name }}</td>
                                <td class="align-middle">{{ $message->mobile }}</td>
                                <td class="align-middle">{{ $message->text }}</td>
                                <td class="align-middle">{{ jdate($message->created_at)->format('Y/m/d') }}</td>
                                {{-- <td class="align-middle">
                                    @if (!$comment->is_approved)
                                        <form action="#" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link text-success p-0 mx-1">
                                                <i class="fa-solid fa-check"></i> تایید
                                            </button>
                                        </form>
                                    @endif
                                    <form action="#" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1">
                                            <i class="fa-regular fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $messages->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
