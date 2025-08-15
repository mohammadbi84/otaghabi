@extends('site.layout.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
    <title>ویرایش پروفایل</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <div class="row mt-4">
            <!-- moshakhasat -->
            <div class="col-md-3 filter-col">
                <div class="sidebar text-center pb-2 shadow border">
                    <img src="{{ asset(Auth::user()->image ?? 'assets/images/user.svg') }}" class="mb-2" width="70px"
                        alt="profile">
                    <p class="mb-1 text-muted">{{ Auth::user()->name }}</p>
                    <p class="mb-1 text-muted">{{ Auth::user()->mobile }}</p>
                    <p class="mb-1 text-muted">{{ Auth::user()->email }}</p>
                    <div class="list-group text-end mt-2 rounded-0">
                        <a href="{{ route('user.profile') }}"
                            class="list-group-item list-group-item-action
                            @if (Route::currentRouteName() == 'user.profile') border-end border-4 border-DarkBlue @endif ">
                            <i class="fa-solid fa-house-user"></i>
                            داشبورد
                        </a>
                        <a href="{{ route('user.edit') }}"
                            class="list-group-item list-group-item-action
                            @if (Route::currentRouteName() == 'user.edit') border-end border-4 border-DarkBlue @endif">
                            <i class="fa-solid fa-circle-user"></i>
                            اطلاعات حساب
                        </a>
                        <a href="{{ route('user.orders') }}"
                            class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.orders') border-end border-4 border-DarkBlue @endif">
                            <i class="fa-solid fa-circle-check"></i>
                            نوبت های من
                        </a>
                        <a href="{{ route('user.workshops') }}"
                            class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.workshops') border-end border-4 border-DarkBlue @endif">
                            <i class="fa-solid fa-circle-check"></i>
                            کارگاه های آموزشی من
                        </a>
                        <a href="{{ route('user.tests') }}"
                            class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.tests') border-end border-4 border-DarkBlue @endif">
                            <i class="fa-solid fa-circle-check"></i>
                            تست های من
                        </a>
                        <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            خروج
                        </a>
                    </div>
                </div>
            </div>
            <!-- left content -->
            <div class="col">
                <div class="row p-2 mx-1 rounded-4 shadow bg-white border">
                    <form action="{{ route('user.update',['user'=>Auth::user()]) }}" method="post" class="px-4 pb-2">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">نام :</label>
                                <input type="text" class="form-control" id="name" placeholder="نام" name="name"
                                    value="{{ Auth::user()->name }}">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="melicode" class="form-label">کد ملی :</label>
                                <input type="text" class="form-control" id="melicode" placeholder="کد ملی"
                                    name="meli_code" value="{{ Auth::user()->meli_code }}">
                                @error('meli_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="mobile" class="form-label">شماره موبایل :</label>
                                <input type="text" class="form-control" id="mobile" placeholder="شماره موبایل"
                                    name="mobile" value="{{ Auth::user()->mobile }}">
                                @error('mobile')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">ایمیل :</label>
                                <input type="email" class="form-control" id="email" placeholder="ایمیل" name="email"
                                    value="{{ Auth::user()->email }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">تغییر رمز عبور :</label>
                                <input type="password" class="form-control" id="password" placeholder="رمز ورود"
                                    name="password">
                            </div>

                        </div>
                        <div class="d-flex justify-content-center mt-4">
                            <button type="submit" class="btn btn-blue w-25 align-middle shadow">ذخیره</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
