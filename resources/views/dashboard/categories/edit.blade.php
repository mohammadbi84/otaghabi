@extends('dashboard.layout.master')

{{-- title --}}
@section('title')
    <title>ویرایش دسته‌بندی</title>
@endsection

{{-- body --}}
@section('body')
    <!-- main  -->
    <div class="col">
        <!-- edit category -->
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">ویرایش دسته‌بندی</h5>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary float-start">بازگشت</a>
            </div>

            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- نمایش ارورها --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3 mt-3">
                    <label for="title" class="form-label">عنوان دسته‌بندی:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="عنوان دسته‌بندی"
                        value="{{ old('title', $category->title) }}">
                </div>

                <div class="mb-3">
                    <label for="short_description" class="form-label">توضیح کوتاه:</label>
                    <input type="text" class="form-control" id="short_description" name="short_description"
                        placeholder="توضیح کوتاه" value="{{ old('short_description', $category->short_description) }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">توضیح کامل:</label>
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="توضیح کامل">{{ old('description', $category->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">عکس دسته‌بندی:</label>
                    <input type="file" class="form-control" id="image" name="image">
                    @if ($category->image)
                        <div class="mt-3">
                            <img src="{{ asset('storage/' . $category->image) }}" width="120px" alt="عکس فعلی">
                        </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success w-25 align-middle">ویرایش</button>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- فعال کردن text editor --}}
@section('javaScript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'توضیح کامل را وارد کنید...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
