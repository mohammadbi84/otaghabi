@extends('site.layout.master')
@php
    function site_setting($key, $default = null)
    {
        return \App\Models\Setting::where('key', $key)->first()->value ?? $default;
    }
@endphp
@section('content')
    <!-- slider -->
    <div class="container-fluid">
        <div class="row border bg-white">
            <div class="col-md-4">
                <div id="info" class="bg-white p-3 d-flex flex-column align-items-center justify-content-center h-100">
                    <h3 class="mb-3 border-bottom border-blue border-3 ">کلینیک مشاوره آتاق آبی</h3>
                    <p class="text-center">
                        {{ site_setting('slider_text') }}
                    </p>
                    <a href="{{route('consultations.create')}}" class="btn btn-blue w-75">
                        دریافت نوبت مشاوره
                    </a>
                </div>
            </div>

            <div class="col-md-8 p-0">
                <div class="splide" id="slider0" role="group" aria-label="Splide Basic HTML Example">
                    <div class="splide__track rounded-4">
                        <!-- slider -->
                        <ul class="splide__list">
                            @foreach ($sliders as $slider)
                                <li class="splide__slide">
                                    <a href="{{ $slider->link ?? '#' }}">
                                        <img src="{{ asset($slider->image) }}" class="w-100 object-fit-cover" alt="{{ $slider->title }}">
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- main -->
    <div class="container">
        <!-- popular Services start -->
        <div class="col-md-12 p-2 mt-5">
            <h4 class="text-center services_header">
                <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">محبوب ترین خدمات
                    کلینیک
                    اتاق آبی</span>
            </h4>
        </div>
        <div class="row row-cols-2 ">
            @foreach ($top_cats as $cat)
                <div class="col-md-3 p-3">
                    <div class="card text-center rounded-4 shadow card_hover h-100">
                        <img src="{{ asset('storage/' . $cat->image) }}" class="card-img-top w-100 rounded-4 border-bottom object-fit-cover"
                            alt="{{ $cat->title }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $cat->title }}</h5>
                            <p class="card-text">
                                {{ $cat->short_description }}
                            </p>
                            <a href="{{ route('psychologists', ['category' => $cat]) }}" class="btn btn-blue w-100">دریافت
                                نوبت</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- popular services end -->
        <!-- benefits and manager start -->
        <div class="row p-4 mt-5">
            <!-- benefits -->
            <div class="col-md-4 mt-2 p-1">
                <div class="shadow p-3 rounded-4 border bg-white h-100">
                    <div class="d-blok">
                        <h4 class="text-center">
                            <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">چرا
                                کلینیک اتاق
                                آبی؟</span>
                        </h4>
                    </div>
                    <div class="row p-0 row-cols-2 row-cols-md-4 justify-content-md-center" style="height: 95%;">
                        <div class="col-md-6 mt-2 p-1">
                            <div class="card p-2 pt-3 border rounded-4 h-100 card_hover">
                                <img src="{{ asset('assets/images/brain.svg') }}" class="mx-auto object-fit-cover" width="60"
                                    alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ site_setting('why_clinic_1') }}</h5>
                                    {{-- <p class="card-text">ما با استفاده از جدیدترین روش‌های روان‌درمانی به شما کمک
                                        می‌کنیم.</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 p-1">
                            <div class="card p-2 pt-3 border rounded-4 h-100 card_hover">
                                <img src="{{ asset('assets/images/doctor.svg') }}" class=" mx-auto object-fit-cover" width="60"
                                    alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ site_setting('why_clinic_2') }}</h5>
                                    {{-- <p class="card-text">مشاوران ما از بهترین‌های ایران با سال‌ها تجربه تخصصی هستند.
                                    </p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 p-1">
                            <div class="card p-2 pt-3 border rounded-4 h-100 card_hover">
                                <img src="{{ asset('assets/images/spa.svg') }}" class=" mx-auto object-fit-cover" width="60"
                                    alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ site_setting('why_clinic_3') }}</h5>
                                    {{-- <p class="card-text">با طراحی فضایی آرام و الهام‌بخش، درمانی موثر و لذت‌بخش را
                                        تجربه کنید.</p> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 p-1">
                            <div class="card p-2 pt-3 border rounded-4 h-100 card_hover">
                                <img src="{{ asset('assets/images/sand_clock.svg') }}" class=" mx-auto object-fit-cover" width="60"
                                    alt="...">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ site_setting('why_clinic_4') }}</h5>
                                    {{-- <p class="card-text">20 سال سابقه کار در حوزه رواندرمانی</p> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- manager -->
            <div class="col-md-8 mt-2">
                <div class="row p-2 shadow rounded-4 border bg-white">
                    <!-- <div class="col-md-4 p-2">

                                                                                      </div> -->
                    <div class="col-md-12 p-4">
                        <h2 class="text-center mt-2 manager_header">
                            <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">دکتر
                                رضایی نسب، مدیر
                                کلینیک
                                روانپویشی اتاق آبی</span>
                        </h2>
                        <div class="border shadow-lg manager_div p-3 mt-3 text-center w-50 mx-auto">
                            <img src="{{ asset(site_setting('manager_image')) }}" alt="manager" class="w-50 mb-3" />
                        </div>
                        <p class="mt-3 p-3">
                            {{ site_setting('manager_text') }}
                        </p>
                        <div class="text-start px-3">
                            <a href="#" class="btn btn-blue p-2 manager_btn">مشاهده پروفایل دکتر رضایی نسب</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- benefits and manager end -->
        <!-- workshops start -->
        <div class="row manager_row">
            <div class="splide" id="slider2" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track p-3 rounded-4" style="background-color: #afd3e2">
                    <div class="clearfix">
                        <h4 class="float-end py-2 px-3 mb-3 services_header">
                            <i class="fa-solid fa-chalkboard-user fa-lg"></i>
                            کارگاه های آموزشی اتاق آبی
                        </h4>
                        <a href="{{ route('workshops') }}" class="float-start py-2 px-3 mb-3">
                            دیدن همه
                            <i class="fa-solid fa-arrow-left mx-1"></i>
                        </a>
                    </div>
                    <!-- slider -->
                    <ul class="splide__list">
                        @foreach ($workshops as $workshop)
                            <li class="splide__slide">
                                <a href="{{ route('workshop', ['workshop' => $workshop]) }}">
                                    <div class="card text-center rounded-4 card_hover">
                                        <img src="{{ asset($workshop->cover) }}"
                                            class="card-img-top w-100 rounded-4 border-bottom border-3 image_border object-fit-cover"
                                            alt="{{ $workshop->title }}" />
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $workshop->title }}</h5>
                                            <small class="text-secondary mt-2">
                                                {{ $workshop->category->title }} <span class="mx-2">|</span>
                                                <i class="fa-regular fa-eye"></i>
                                                {{ $workshop->views }} نفر
                                            </small>
                                            <p class="card-text mt-3">
                                                {{ $workshop->short_description }}
                                            </p>
                                            <p>
                                                @if ($workshop->discount > 0)
                                                    <small
                                                        class="text-danger"><del>{{ number_format($workshop->price) }}</del><span
                                                            class="badge bg-danger mx-2">{{ (($workshop->price - $workshop->final_price) * 100) / $workshop->price }}%</span></small>
                                                    {{ number_format($workshop->final_price) }} تومان
                                                @else
                                                    {{ number_format($workshop->final_price) }} تومان
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- workshops end -->
        <!-- other services start -->
        <div class="row justify-content-md-center mt-5">
            <div class="col-md-12 p-2 mt-2">
                <h4 class="text-center services_header">
                    <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">دیگر خدمات
                        کلینیک اتاق
                        آبی</span>
                </h4>
            </div>
            @foreach ($categories as $category)
                <div class="col-md-3 p-3">
                    <div class="card text-center rounded-4 shadow card_hover h-100">
                        <img src="{{ asset($category->image) }}" class="card-img-top w-100 rounded-4 border-bottom object-fit-cover"
                            alt="{{ $category->title }}" />
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->title }}</h5>
                            <p class="card-text">
                                {{ $category->short_description }}
                            </p>
                            <a href="{{ route('psychologists', ['category' => $category]) }}"
                                class="btn btn-blue w-100">دریافت نوبت</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- other services end -->
        <!-- articles start -->
        <div class="row manager_row">
            <div class="splide" id="slider3" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track p-3 border border-3 rounded-4 bg-white"
                    style="border-color: #146c94 !important">
                    <div class="clearfix">
                        <h4 class="float-end py-2 px-3 mb-3">
                            <i class="fa-solid fa-newspaper fa-lg"></i>
                            جدید ترین مقاله ها
                        </h4>
                        <a href="{{ route('blogs') }}" class="float-start py-2 px-3 mb-3">
                            دیدن همه
                            <i class="fa-solid fa-arrow-left mx-1"></i>
                        </a>
                    </div>
                    <!-- slider -->
                    <ul class="splide__list">
                        @foreach ($articles as $article)
                            <li class="splide__slide">
                                <div class="card text-end rounded-4 card_hover h-100">
                                    <a href="{{ route('blog', ['article' => $article]) }}">
                                        <img src="{{ asset($article->cover) }}"
                                            class="card-img-top w-100 rounded-4 border-bottom border-3 image_border object-fit-cover"
                                            alt="{{ $article->title }}" />
                                    </a>
                                    <div class="card-body pt-2 pb-0">
                                        <small class="text-secondary mt-0">
                                            <a href="{{ route('blog', ['article' => $article]) }}" class="text-reset">
                                                {{ $article->category->title }} </a>
                                            <span class="mx-2">|</span>
                                            <i class="fa-regular fa-eye"></i>
                                            {{ $article->view_count }} نفر
                                        </small>
                                        <a href="{{ route('blog', ['article' => $article]) }}" class="text-reset">
                                            <h5 class="card-title mt-3 mb-0">{{ $article->title }}</h5>
                                        </a>
                                        <p class="text-start text-secondary mt-0 pt-0">
                                            <small>{{ jdate($article->created_at)->format('%B %d، %Y') }}</small>
                                        </p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- articles end -->
        <!-- profiles start -->
        <div class="d-blok p-2 mt-5">
            <h4 class="text-center services_header">
                <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">برخی از مشاوران
                    کلینیک اتاق
                    آبی</span>
            </h4>
        </div>
        <div class="row row-cols-md-4 mt-2 justify-content-md-center">
            @foreach ($psychologists as $psychologist)
                <div class="col-md-6 mt-3">
                    <div class="card rounded-4 mb-3 h-100 card_hover">
                        <div class="row g-0 pb-0">
                            <div class="col-md-5 p-3 align-content-center">
                                <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}">
                                    <img src="{{ asset($psychologist->image) }}" class="img-fluid rounded-4 w-100 object-fit-cover"
                                        alt="{{ $psychologist->name }}" />
                                </a>
                            </div>
                            <div class="col-md-7">
                                <div
                                    class="card-body h-100 p-4 pb-0 d-flex flex-wrap align-content-around justify-content-center">
                                    <div class="row d-flex flex-wrap align-content-around">
                                        <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}"
                                            class="text-reset">
                                            <h5 class="card-title">{{ $psychologist->name }}</h5>
                                        </a>
                                        <small class="card-text text-secondary me-2">
                                            {{ $psychologist->degree }}
                                        </small>
                                        <ul class="list-group list-group-flush mt-3 pe-3">
                                            @foreach ($psychologist->categories as $cat)
                                                <li class="list-group-item p-1 border-0">
                                                    <i class="fa-regular fa-circle-check" style="color: #19a7ce"></i>
                                                    {{ $cat->title }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <ul class="list-group list-group-horizontal pe-0 border-0">
                                        <li class="list-group-item border-0">
                                            <i class="fa-solid fa-location-dot ms-1" style="color: #19a7ce"></i>
                                            مشاوره در {{ $psychologist->city->title }}
                                        </li>
                                        @if ($psychologist->online_consultation)
                                            <li class="list-group-item border-0">
                                                <i class="fa-solid fa-globe ms-1" style="color: #19a7ce"></i>
                                                مشاوره آنلاین
                                            </li>
                                        @endif
                                    </ul>
                                    <div class="row mt-3 d-flex justify-content-end w-100">
                                        <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}"
                                            class="btn btn-DarkBlue p-2">دیدن پروفایل و دریافت نوبت
                                            مشاوره</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-blok mt-5 text-center">
            <a href="{{ route('psychologists') }}" class="btn btn-blue shadow p-2 px-3">مشاهده همه مشاوران</a>
        </div>
        <!-- profiles end -->
    </div>
@endsection
