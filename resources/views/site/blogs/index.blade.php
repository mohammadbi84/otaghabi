@extends('site.layout.master')
@section('head')
    <title>مقاله ها</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- filters start -->
        <form action="{{ route('blogs') }}" method="get">
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
        <!-- workshops start -->
        <div class="row mt-3">
            @foreach ($articles as $article)
                <div class="col-md-6 mt-4 px-4">
                    <div class="row bg-white rounded-4 shadow">
                        <!-- image -->
                        <div class="col-md-4 px-0">
                            <a href="{{ route('blog', ['article' => $article]) }}">
                                <img src="{{ asset($article->cover) }}" class="w-100 h-100 rounded-4 border-3"
                                    alt="{{ $article->title }}" />
                            </a>
                        </div>
                        <!-- body -->
                        <div class="col-md-8 pe-3 p-2">
                            <small class="text-secondary mt-0">
                                <a href="#" class="text-reset"> {{ $article->category->title }} </a>
                                <span class="mx-2">|</span>
                                <i class="fa-regular fa-eye"></i>
                                {{ $article->view_count }} نفر
                            </small>
                            <a href="{{ route('blog', ['article' => $article]) }}" class="text-reset">
                                <h5 class="card-title mt-3 mb-0">{{ $article->title }}</h5>
                            </a>
                            <p class="text-end text-secondary mt-3 pt-0">
                                <small>
                                    <i class="fa-solid fa-calendar-days mx-2"></i>
                                    {{ jdate($article->created_at)->format('%B %d، %Y') }}
                                </small>
                            </p>
                            <p class="text-end text-secondary mt-3 mb-1 pt-0">
                                <small>
                                    <i class="fa-regular fa-user mx-2"></i>
                                    {{ $article->author->name }}
                                </small>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- workshops end -->
    </div>
@endsection
