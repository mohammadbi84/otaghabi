@extends('site.layout.master')
@section('head')
    <title>متخصصان</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- categories start -->
        @if (isset($categories))
            <div class="d-blok p-2 mt-5">
                <h4 class="text-center services_header">
                    <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">حوزه های درمانی در
                        کلینیک اتاق آبی</span>
                </h4>
            </div>
            <div class="row row-cols-md-3 mt-2 justify-content-md-center">
                @foreach ($categories as $category)
                    <div class="col-md-4 p-2">
                        <a href="{{ route('psychologists', ['category' => $category]) }}"
                            class="btn btn-DarkBlue p-2 w-100">{{ $category->title }}</a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="row mt-4 bg-white shadow rounded-4 p-2">
                <h4 class="p-2 ">{{ $category->title }}</h4>
                <p class="">
                    {!! $category->description !!}
                </p>
            </div>
        @endif

        <!-- categories end -->
        <!-- profiles start -->
        <div class="d-blok p-2 mt-5">
            <h3 class="text-center services_header">
                @if (isset($categories))
                    <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">برخی از مشاوران
                        کلینیک
                        اتاق
                        آبی</span>
                @else
                    <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">
                        لیست مشاوران حوزه {{ $category->title }}
                    </span>
                @endif
            </h3>
        </div>
        <div class="row row-cols-md-4 mt-2 justify-content-md-center">
            @foreach ($psychologists as $psychologist)
                <div class="col-md-6 mt-3">
                    <div class="card rounded-4 mb-3 h-100 card_hover">
                        <div class="row g-0 pb-0">
                            <div class="col-md-5 p-3 align-content-center">
                                <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}">
                                    <img src="{{ asset($psychologist->image) }}" class="img-fluid rounded-4 w-100"
                                        alt="{{ $psychologist->name }}" />
                                </a>
                            </div>
                            <div class="col-md-7">
                                <div
                                    class="card-body h-100 p-4 pb-0 d-flex flex-wrap align-content-around justify-content-center">
                                    <div class="row d-flex flex-wrap align-content-around">
                                        <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}" class="text-reset">
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
                                        <a href="{{ route('psychologist', ['psychologist' => $psychologist]) }}" class="btn btn-DarkBlue p-2">دیدن پروفایل و دریافت نوبت
                                            مشاوره</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- profiles end -->
    </div>
@endsection
