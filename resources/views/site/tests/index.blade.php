@extends('site.layout.master')
@section('head')
    <title>کارگاه های آموزشی</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- filters start -->
        <form action="{{ route('tests') }}" method="get">
            <div class="row mt-5 p-3 border bg-white rounded-4 shadow-sm">
                <div class="col-md-3 mt-2">
                    <select class="form-select" id="order" name="order">
                        <option disabled {{ request('order') ? '' : 'selected' }}>مرتب سازی بر اساس</option>
                        <option value="1" {{ request('order') == 1 ? 'selected' : '' }}>محبوب ترین</option>
                        <option value="2" {{ request('order') == 2 ? 'selected' : '' }}>ارزان ترین</option>
                        <option value="3" {{ request('order') == 3 ? 'selected' : '' }}>گران ترین</option>
                    </select>
                </div>
                <div class="col-md-3 mt-2">
                    <input type="text" class="form-control" placeholder="جستجوی تست" dir="rtl" name="search"
                    value="{{ request('search') }}" />
                </div>
                <div class="col-md-3 mt-2"></div>
                <div class="col-md-3 mt-2 text-center">
                    <button class="btn btn-blue border w-50 pt-2" type="submit">
                        فیلتر نتایج
                        <i class="fa-solid fa-magnifying-glass me-3"></i>
                    </button>
                </div>
            </div>
        </form>

        <!-- filters end -->
        <!-- tests start -->
        <div class="row mt-3">
            @foreach ($tests as $test)
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
                                        <small class="text-danger"><del>{{ number_format($test->price) }}</del><span
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
        <!-- tests end -->
    </div>
@endsection
