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
                            <th>متن نظر</th>
                            <th>وضعیت</th>
                            <th>تاریخ</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($comments as $comment)
                            <tr>
                                <td class="align-middle">{{ $comment->id }}</td>
                                <td class="align-middle">{{ $comment->name }}</td>
                                <td class="align-middle">{{ Str::limit($comment->body, 50) }}</td>
                                <td class="align-middle">
                                    @if ($comment->is_approved)
                                        <span class="badge bg-success">تایید شده</span>
                                    @else
                                        <span class="badge bg-warning text-dark">در انتظار تایید</span>
                                    @endif
                                </td>
                                <td class="align-middle">{{ jdate($comment->created_at)->format('Y/m/d H:i') }}</td>
                                <td class="align-middle">
                                    @if (!$comment->is_approved)
                                        <form action="{{ route('comments.approve', $comment->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-link text-success p-0 mx-1">
                                                <i class="fa-solid fa-check"></i> تایید
                                            </button>
                                        </form>
                                    @endif
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1">
                                            <i class="fa-regular fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $comments->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
