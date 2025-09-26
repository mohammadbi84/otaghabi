@extends('site.layout.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
    <title>ویرایش پروفایل</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <div class="row mt-4">
            @include('site.user.layout.sidebar')
            <!-- left content -->
            <div class="col">
                <div class="row p-2 mx-1 rounded-4 shadow bg-white border">
                    @foreach (Auth::user()->workshops_buy as $workshop)
                        <div class="col-md-4 p-2 mt-3">
                            <a href="{{ route('workshop', ['workshop' => $workshop]) }}">
                                <div class="card text-center rounded-4 card_hover">
                                    <img src="{{ asset($workshop->cover) }}"
                                        class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
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
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
