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
                    <img src="{{asset('assets/images/user.svg')}}" class="mb-2" width="70px" alt="profile">
                    <p class="mb-1 text-muted">امیر عبدالهی</p>
                    <p class="mb-1 text-muted">09121231234</p>
                    <p class="mb-1 text-muted">masal@gmail.com</p>
                    <div class="list-group text-end mt-2 rounded-0">
                        <a href="/user/profile.html" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-house-user"></i>
                            داشبورد
                        </a>
                        <a href="/user/edit.html"
                            class="list-group-item list-group-item-action border-end border-4 border-DarkBlue ">
                            <i class="fa-solid fa-circle-user"></i>
                            اطلاعات حساب
                        </a>
                        <a href="/user/orders.html" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-circle-check"></i>
                            نوبت های من
                        </a>
                        <!-- <a href="#" class="list-group-item list-group-item-action">
                                <i class="fa-solid fa-heart"></i>
                                مورد علاقه
                            </a> -->
                        <a href="#" class="list-group-item list-group-item-action">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            خروج
                        </a>
                    </div>
                </div>
            </div>
            <!-- left content -->
            <div class="col">
                <div class="row p-2 mx-1 rounded-4 shadow bg-white border">
                    <form action="" class="px-4 pb-2">
                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">نام :</label>
                                <input type="text" class="form-control" id="name" placeholder="نام" name="name">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="melicode" class="form-label">کد ملی :</label>
                                <input type="text" class="form-control" id="melicode" placeholder="کد ملی"
                                    name="melicode">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">شماره موبایل :</label>
                                <input type="text" class="form-control" id="phone" placeholder="شماره موبایل"
                                    name="phone">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">ایمیل :</label>
                                <input type="email" class="form-control" id="email" placeholder="ایمیل"
                                    name="email">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">تغییر رمز عبور :</label>
                                <input type="password" class="form-control" id="password" placeholder="رمز ورود"
                                    name="password">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="address"> آدرس : </label>
                            <textarea class="form-control" rows="3" id="address" name="address"></textarea>
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
