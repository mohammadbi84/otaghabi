@extends('site.layout.master')
@section('head')
    <title>{{ $article->title }}</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- Article Section -->
        <div class="article-section my-5 border rounded-4 bg-white shadow p-5">
            <!-- Article Metadata -->
            <div class="article-meta text-muted mb-4">
                <small class="mx-2"><i class="fa-regular fa-clock"></i> تاریخ انتشار:
                    {{ jdate($article->created_at)->format('%B %d، %Y') }} - ساعت:
                    {{ jdate($article->created_at)->format('H:i') }}</small> |
                <small class="mx-2"><i class="fa-regular fa-folder-open"></i> دسته‌بندی: <a href="/blogs.html"
                        class="text-reset">{{ $article->category->title }}</a></small> |
                <small class="mx-2"><i class="fa-regular fa-user"></i> نویسنده: {{ $article->author->name }}</small>
            </div>

            <!-- Article Title -->
            <h1 class="article-title mb-4">{{ $article->title }}</h1>

            <!-- Article Image -->
            <div class="article-image mb-4">
                <img src="{{ asset($article->cover) }}" alt="{{ $article->title }}" class="img-fluid rounded">
            </div>

            <!-- Article Content -->
            <div class="article-content">
                <p style="line-height: 2;"></p>
                {!! $article->body !!}
                </p>
            </div>

            <!-- Article Author -->
            <div class="article-author mt-5">
                <h5>نویسنده: {{ $article->author->name }}</h5>
            </div>

            <!-- comment start -->
            <div class="row mt-5">
                <!-- Comments Section -->
                <div class="col-12 p-4 px-5 rounded-4 bg-white border">
                    <h4 class="m-2">نظرات کاربران</h4>
                    <!-- Add Comment -->
                    <!-- فرم ارسال نظر -->
                    <form action="{{ route('comments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="commentable_type" value="App\Models\Article">
                        <input type="hidden" name="commentable_id" value="{{ $article->id }}">

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

                    {{-- <form class="mt-4 border rounded-4 p-3">
                        <div class="mb-3">
                            <label for="commentText" class="form-label">نظر خود را بنویسید:</label>
                            <textarea class="form-control" id="commentText" rows="3" placeholder="نظر خود را اینجا بنویسید..."></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="commentAuthor" class="form-label">نام شما:</label>
                            <input type="text" class="form-control w-50" id="commentAuthor"
                                placeholder="نام خود را وارد کنید" />
                        </div>
                        <button type="submit" class="btn btn-blue px-3">ارسال نظر</button>
                    </form> --}}

                    <!-- Display Comments -->
                    <div class="mt-5">
                        <h5>نظرات:</h5>
                        @if ($article->comments()->where('is_approved', true)->exists())
                            @foreach ($article->comments()->where('is_approved', true)->latest()->get() as $comment)
                                <div class="border p-3 rounded-3 mb-3 bg-light">
                                    <p class="mb-2"><strong>{{ $comment->name }}</strong></p>
                                    <span
                                        class="text-secondary">{{ jdate($comment->created_at)->format('%B %d، %Y') }}</span>
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
    </div>
@endsection
