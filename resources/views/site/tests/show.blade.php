@extends('site.layout.master')
@section('head')
    <title>{{ $test->title }}</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- test -->
        <div class="row p-3 pt-4 mt-3 bg-white border rounded-4 shadow">
            <!-- main product -->
            <div class="col-md-4 img-col">
                <img class="border rounded-4" src="{{ asset($test->cover) }}" alt="{{ $test->title }}" width="100%" />
            </div>
            <!-- body -->
            <div class="col-md-5 pe-4">
                <h1 class="mt-2 pb-2 px-2 border-bottom" style="font-size: 26px">
                    {{ $test->title }}
                </h1>
                <ul class="list-group list-group-horizontal mx-0 px-0 product-cat-links">
                    <li class="list-group-item ps-0 pt-0 mt-0 border-0">
                        دسته‌ بندی : <a href="#" class="px-1 address-link">{{ $test->category->title }}</a>
                    </li>
                    <li class="list-group-item ps-0 pt-0 mt-0 border-0">
                        <a href="#comments" class="px-1 address-link">
                            <i class="fa-regular fa-comment mx-1" style="color: #19a7ce"></i>
                            {{$test->comments->count()}} دیدگاه</a>
                    </li>
                </ul>
                <!-- form -->
                <!-- options -->
                <div class="row pe-2">
                    <div class="col-12 mt-3 p-2">
                        {{ $test->short_description }}
                    </div>
                    <div class="col text-center align-content-end p-2">
                        <!-- price -->
                        <p class="d-block mt-2 pe-2 me-1"><strong
                                style="font-size:24px;">{{ number_format($test->final_price) }}</strong>
                            <small>تومان</small>
                            <span>
                                <span
                                    class="badge bg-danger mx-2">{{ (($test->price - $test->final_price) * 100) / $test->price }}%
                                </span>
                                <del>{{ number_format($test->price) }}</del>
                            </span>
                        </p>
                    </div>
                    @if ($alreadyInCart)
                        <a href="{{ route('cart') }}" class="btn btn-outline-info px-4 py-2 mt-0">
                            رفتن به سبد خرید
                            <i class="fa-solid fa-cart-shopping me-2"></i>
                        </a>
                    @else
                        <form action="{{ route('cart.add', ['type' => 'test', 'id' => $test->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-blue px-4 py-2 mt-0 w-100">
                                افزودن به سبد خرید
                                <i class="fa-solid fa-cart-shopping me-2"></i>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            <!-- attributes -->
            <div class="col-md-3">
                <h3 class="mt-3 pb-2 px-2 border-bottom" style="font-size: 20px">
                    ویژگی ها
                </h3>
                <ul class="list-group list-group-flush me-0 pe-0 product-cat-links">
                    <li class="list-group-item">
                        <span style="color: rgb(93, 93, 93); font-size: 14px">تعداد بازدید :</span> {{ $test->view_count }}
                        نفر
                    </li>
                    <li class="list-group-item">
                        <span style="color: rgb(93, 93, 93); font-size: 14px">رده سنی :</span> {{ $test->age_group }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- description start -->
        <div class="row mt-4 bg-white border rounded-4 shadow p-4">
            <h5>توضیحات آموزش</h5>
            <p class="mt-2">
                {!! $test->description !!}
            </p>
        </div>
        <!-- description end -->
        <!-- similar start -->
        <div class="row rounded-4 border bg-white shadow mt-5 p-3">
            <h5 class="wrapper-title text-dark pb-1">تست های مشابه</h5>
            <section class="splide" id="slider" aria-label="Splide Basic HTML Example" dir="ltr">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($similars as $item)
                            @if ($item->id != $test->id)
                                <li class="splide__slide">
                                    <a href="{{ route('test', ['test' => $item]) }}">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="{{ asset($item->cover) }}"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="{{ $item->title }}" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->title }}</h5>
                                                <small class="text-secondary mt-2">
                                                    {{ $item->category->title }} <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    {{ $item->participants_count }} نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    {{ $item->short_description }}
                                                </p>
                                                <p>
                                                    @if ($item->discount > 0)
                                                        <small
                                                            class="text-danger"><del>{{ number_format($item->price) }}</del><span
                                                                class="badge bg-danger mx-2">{{ (($item->price - $item->final_price) * 100) / $item->price }}%</span></small>
                                                        {{ number_format($item->final_price) }} تومان
                                                    @else
                                                        {{ number_format($item->final_price) }} تومان
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <!-- similar end -->
        <!-- comment start -->
        <div class="row mt-5" id="comments">
            <!-- Comments Section -->
            <div class="col-12 p-4 px-5 rounded-4 bg-white shadow border">
                <h4 class="m-2">نظرات</h4>
                <!-- Add Comment -->
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\PsychologicalTest">
                    <input type="hidden" name="commentable_id" value="{{ $test->id }}">

                    <div class="mb-3">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>نظر شما</label>
                        <textarea name="body" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-blue px-3">ارسال نظر</button>
                </form>

                <!-- Display Comments -->
                <div class="mt-5">
                    <h5>نظرات:</h5>
                    @if ($test->comments()->where('is_approved', true)->exists())
                        @foreach ($test->comments()->where('is_approved', true)->latest()->get() as $comment)
                            <div class="border p-3 rounded-3 mb-3 bg-light">
                                <p class="mb-2"><strong>{{ $comment->name }}</strong></p>
                                <span class="text-secondary">{{ jdate($comment->created_at)->format('%B %d، %Y') }}</span>
                                <p class="mb-3 mt-3">
                                    {{ $comment->body }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- comment end -->
    </div>
@endsection
@section('script')
    <script>
        var splide = new Splide("#slider", {
            // type: "loop",
            // drag: "free",
            gap: "1rem",
            direction: "rtl",
            focus: "right",
            perPage: 3,
            omitEnd: true,
            pagination: (boolean = false),
            // perMove: 1,
            breakpoints: {
                991: {
                    perPage: 3,
                },
                480: {
                    perPage: 1.5,
                    drag: true,
                },
            },
        });
        splide.mount();
    </script>
@endsection
