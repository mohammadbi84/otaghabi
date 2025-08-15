@extends('site.layout.master')
@section('head')
    <title>{{ $psychologist->name }}</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- profiles start -->
        <div class="row row-cols-md-4 mt-2 justify-content-md-center">
            <div class="col-md-12 mt-3">
                <div class="card rounded-4 mb-3 h-100 shadow">
                    <div class="row g-0 pb-0">
                        <!-- image -->
                        <div class="col-md-3 p-3 align-content-center">
                            <img src="{{ asset($psychologist->image) }}" class="img-fluid rounded-4 w-100"
                                alt="{{ $psychologist->name }}" />
                        </div>
                        <div class="col-md-9">
                            <div class="card-body h-100 p-2 py-4 pb-0">
                                <div class="row g-0">
                                    <div class="col-md-6 p-4 border-start">
                                        <h2 class="">{{ $psychologist->name }}</h2>
                                        <p class="text-muted me-3 mt-4">{{ $psychologist->degree }}</p>
                                        <ul class="list-group list-group-flush mt-4 pe-3">
                                            @foreach ($psychologist->categories as $cat)
                                                <li class="list-group-item p-1 border-0">
                                                    <i class="fa-regular fa-circle-check" style="color: #19a7ce"></i>
                                                    {{ $cat->title }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6 p-4 align-content-center">
                                        <ul class="list-group list-group-horizontal pe-0 align-content-center">
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
                                    </div>
                                </div>
                                <div class="row g-0 mt-3 mb-2 w-100 text-center">
                                    <a href="{{ route('consultations.create', $psychologist->id) }}"
                                        class="btn btn-DarkBlue p-2 w-75 mx-auto">دریافت نوبت مشاوره</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- profiles end -->
        <div class="row mt-4 p-3">
            <div class="col-12 p-4 px-5 rounded-4 bg-white shadow border">
                <h4 class="m-2">بیوگرافی و معرفی رواندرمانگر، {{ $psychologist->name }}</h4>
                <p class="mt-5">
                    {!! $psychologist->bio !!}
                </p>
            </div>
        </div>
        <!-- comment start -->
        <div class="row mt-5">
            <!-- Comments Section -->
            <div class="col-12 p-4 px-5 rounded-4 bg-white shadow border">
                <h4 class="m-2">نظرات کاربران</h4>
                <!-- Add Comment -->
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\User">
                    <input type="hidden" name="commentable_id" value="{{ $psychologist->id }}">

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
                    @if ($psychologist->comments()->where('is_approved', true)->exists())
                        @foreach ($psychologist->comments()->where('is_approved', true)->latest()->get() as $comment)
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
