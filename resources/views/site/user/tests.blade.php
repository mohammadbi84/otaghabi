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
                    @foreach (Auth::user()->psychological_tests as $test)
                        <div class="col-md-4 p-2 mt-3">
                            <a href="{{ route('test', ['test' => $test]) }}">
                                <div class="card text-center rounded-4 card_hover">
                                    <img src="{{ asset($test->cover) }}"
                                        class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                        alt="{{ $test->title }}" />
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $test->title }}</h5>
                                        <small class="text-secondary mt-2">
                                            {{ $test->category->title }} <span class="mx-2">|</span>
                                            <i class="fa-regular fa-eye"></i>
                                            {{ $test->view_count }} نفر
                                        </small>
                                        <p class="card-text mt-3">
                                            {{ $test->short_description }}
                                        </p>
                                        <p>
                                            @if ($test->discount > 0)
                                                <small
                                                    class="text-danger"><del>{{ number_format($test->price) }}</del><span
                                                        class="badge bg-danger mx-2">{{ (($test->price - $test->final_price) * 100) / $test->price }}%</span></small>
                                                {{ number_format($test->final_price) }} تومان
                                            @else
                                                {{ number_format($test->final_price) }} تومان
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
