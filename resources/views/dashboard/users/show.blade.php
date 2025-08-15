@extends('dashboard.layout.master')

@section('title')
    <title>پروفایل کاربر</title>
@endsection

@section('body')
    <!-- main -->
    <div class="col pb-5">
        {{-- دکمه بازگشت --}}
        <div class="row g-0 mt-4 p-2 rounded-4 shadow bg-white">
            <div class="col-md-12 text-start">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-2"></i> بازگشت به لیست کاربران
                </a>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger float-end" onclick="return confirm('آیا از حذف این کاربر مطمئن هستید؟')">
                        <i class="fa-regular fa-trash-can me-2"></i> حذف کاربر
                    </button>
                </form>
            </div>
        </div>
        <!-- info -->
        <div class="row g-0 mt-4 p-2 rounded-4 shadow bg-white">
            <div class="col-md-2 p-2 text-center rounded-4 border">
                <img src="{{ asset($user->image ?? 'files/user.svg') }}" alt="profile" class="w-100"
                    style="max-width: 120px;">
            </div>
            <div class="col-md-10 p-2 rounded-4 border">
                {{-- اطلاعات --}}
                <div class="row p-2 m-2">
                    <div class="col-md-6 p-2">
                        <div class="d-flex">
                            <h5 class="ms-3">نام کاربر :</h5>
                            <p class="">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <div class="d-flex">
                            <h5 class="ms-3">شماره موبایل :</h5>
                            <p class="">{{ $user->mobile }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <div class="d-flex">
                            <h5 class="ms-3">تاریخ تولد :</h5>
                            <p class="">
                                @if($user->birth_date)
                                    {{ Morilog\Jalali\Jalalian::forge($user->birth_date)->format('%d %B ، %Y') }}
                                @else
                                    --
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 p-2">
                        <div class="d-flex">
                            <h5 class="ms-3">تاریخ عضویت :</h5>
                            <p class="">
                                {{ Morilog\Jalali\Jalalian::forge($user->created_at)->format('%d %B ، %Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection
