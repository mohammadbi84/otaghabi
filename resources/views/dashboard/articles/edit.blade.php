@extends('dashboard.layout.master')

@section('title')
    <title>ویرایش مقاله</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <h5 class="my-3">ویرایش مقاله</h5>

            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">عنوان مقاله:</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title', $article->title) }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">دسته‌بندی:</label>
                    <select name="category_id" class="form-control">
                        <option value="">انتخاب کنید</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">خلاصه توضیحات:</label>
                    <textarea name="summary" class="form-control" rows="3">{{ old('summary', $article->summary) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">متن کامل:</label>
                    <textarea name="body" id="body" class="form-control" rows="5">{{ old('body', $article->body) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">عکس کاور:</label><br>
                    <img src="{{ asset($article->cover) }}" width="120px" class="mb-2">
                    <input type="file" class="form-control" name="cover">
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-danger w-25">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#body').summernote({
                placeholder: 'متن کامل مقاله...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
