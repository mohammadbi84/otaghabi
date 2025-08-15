@extends('site.layout.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
    <title>{{ Auth::user()->name }}</title>
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
                        <a href="{{ route('logout') }}"
                            class="list-group-item list-group-item-action">
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
                        <a href="{{ route('user.orders') }}" class="text-primary float-start">مشاهده همه<i
                                class="fa-solid fa-arrow-left fa-xs me-2"></i>
                        </a>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th>مشاور</th>
                                    <th>نوع جلسه</th>
                                    <th>وضعیت</th>
                                    <!-- <th>عملیات</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>1403/5/3</td>
                                    <td>محمد حسن غلامی</td>
                                    <td class="">آنلاین</td>
                                    <td class="text-warning">در انتظار</td>
                                    <!-- <td>
                                        <a href="#" class="text-success mx-1"><i class="fa-solid fa-pen-to-square"></i>
                                          <a href="#" class="text-primary mx-1"><i class="fa-solid fa-eye"></i>
                                      </td> -->
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>1403/5/3</td>
                                    <td>محمد حسن غلامی</td>
                                    <td class="">حضوری</td>
                                    <td class="text-warning">در انتظار</td>
                                    <!-- <td>
                                        <a href="#" class="text-success mx-1"><i class="fa-solid fa-pen-to-square"></i>
                                          <a href="#" class="text-primary mx-1"><i class="fa-solid fa-eye"></i>
                                      </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- workshops -->
                <div class="row p-2 mx-1 mt-4 rounded-4 shadow bg-white border">
                    <div class="clearfix mt-2">
                        <h5 class="float-end">آموزش های من</h5>
                        <!-- <a href="#" class="text-primary float-start">مشاهده همه<i
                                        class="fa-solid fa-arrow-left fa-xs me-2"></i> </a> -->
                    </div>
                    <div class="splide" id="slider4" role="group" aria-label="Splide Basic HTML Example">
                        <div class="splide__track p-3 rounded-4">
                            <!-- slider -->
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <a href="/workshop.html">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="/images/tests/workshop.png"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">کارگاه آموزشی فلان</h5>
                                                <small class="text-secondary mt-2">
                                                    دسته بندی <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    1,000 نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                    صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و
                                                    متون بلکه روزنامه
                                                </p>
                                                <p>
                                                    <small class="text-danger"><del>110,000</del><span
                                                            class="badge bg-danger mx-2">10%</span></small>
                                                    100,000 تومان
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="splide__slide">
                                    <a href="/workshop.html">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="/images/tests/workshop.png"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">کارگاه آموزشی فلان</h5>
                                                <small class="text-secondary mt-2">
                                                    دسته بندی <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    1,000 نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                    صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و
                                                    متون بلکه روزنامه
                                                </p>
                                                <p>
                                                    <small class="text-danger"><del>110,000</del><span
                                                            class="badge bg-danger mx-2">10%</span></small>
                                                    100,000 تومان
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="splide__slide">
                                    <a href="/workshop.html">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="/images/tests/workshop.png"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">کارگاه آموزشی فلان</h5>
                                                <small class="text-secondary mt-2">
                                                    دسته بندی <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    1,000 نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                    صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و
                                                    متون بلکه روزنامه
                                                </p>
                                                <p>
                                                    <small class="text-danger"><del>110,000</del><span
                                                            class="badge bg-danger mx-2">10%</span></small>
                                                    100,000 تومان
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li class="splide__slide">
                                    <a href="/workshop.html">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="/images/tests/workshop.png"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="..." />
                                            <div class="card-body">
                                                <h5 class="card-title">کارگاه آموزشی فلان</h5>
                                                <small class="text-secondary mt-2">
                                                    دسته بندی <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    1,000 نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از
                                                    صنعت چاپ و با استفاده از طراحان گرافیک است چاپگرها و
                                                    متون بلکه روزنامه
                                                </p>
                                                <p>
                                                    <small class="text-danger"><del>110,000</del><span
                                                            class="badge bg-danger mx-2">10%</span></small>
                                                    100,000 تومان
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        var splide = new Splide("#slider4", {
            //   type: "loop",
            // drag: "free",
            direction: "rtl",
            focus: "center",
            perPage: 3,
            gap: "2rem",
            omitEnd: true,
            pagination: (boolean = false),
            // perMove: 1,
            breakpoints: {
                991: {
                    perPage: 1,
                },
            },
        });
        splide.mount();
    </script>
@endsection
