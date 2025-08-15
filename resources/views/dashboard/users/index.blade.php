@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت کاربران</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">مدیریت کاربران</h5>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام</th>
                            <th>شماره موبایل</th>
                            <th>تاریخ تولد</th>
                            <th>تاریخ عضویت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="align-middle">{{ $user->id }}</td>
                                <td class="align-middle">{{ $user->name }}</td>
                                <td class="align-middle">{{ $user->mobile }}</td>
                                <td class="align-middle">
                                    @if ($user->birth_date)
                                        {{ Morilog\Jalali\Jalalian::forge($user->birth_date)->format('Y/m/d') }}
                                    @else
                                        --
                                    @endif
                                </td>
                                <td class="align-middle">
                                    {{ Morilog\Jalali\Jalalian::forge($user->created_at)->format('Y/m/d') }}
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="btn btn-link text-primary p-0 mx-1">
                                        <i class="fa-solid fa-eye"></i> مشاهده
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1"
                                            onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">
                                            <i class="fa-regular fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $users->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
