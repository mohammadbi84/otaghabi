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
                <!-- oreders -->
                <div class="row p-2 mx-1 mt-4 rounded-4 shadow bg-white border">
                    <div class="clearfix mt-2">
                        <h5 class="float-end">نوبت های من</h5>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th>مشاور</th>
                                    <th>حوزه مشاوره</th>
                                    <th>وضعیت</th>
                                    <!-- <th>عملیات</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->consultationRequests as $request)
                                    <tr>
                                        <td>1</td>
                                        <td>{{ jdate($request->created_at)->format('Y/m/d') }}</td>
                                        <td>{{ $request->consultant->name }}</td>
                                        <td class="">{{ $request->category->title }}</td>
                                        <td class="text-warning">{{ $request->getStatusTextAttribute() }}</td>
                                        <!-- <td>
                                                    <a href="#" class="text-success mx-1"><i class="fa-solid fa-pen-to-square"></i>
                                                      <a href="#" class="text-primary mx-1"><i class="fa-solid fa-eye"></i>
                                                  </td> -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
