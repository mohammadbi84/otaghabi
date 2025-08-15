@extends('dashboard.layout.master')
@section('title')
    <title>{{ isset($test) ? 'ویرایش تست' : 'افزودن تست' }}</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>{{ isset($test) ? 'ویرایش تست' : 'افزودن تست' }}</h5>
            <form
                action="{{ isset($test) ? route('psychological-tests.update', $test->id) : route('psychological-tests.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($test))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">عنوان تست</label>
                            <input type="text" name="title" class="form-control"
                                value="{{ old('title', $test->title ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">تصویر کاور</label>
                            <input type="file" name="cover" class="form-control">
                            @if (isset($test) && $test->cover)
                                <img src="{{ asset($test->cover) }}" alt="کاور" class="w-25 mt-2 rounded">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">قیمت (تومان)</label>
                            <input type="number" name="price" class="form-control"
                                value="{{ old('price', $test->price ?? 0) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">تخفیف (تومان)</label>
                            <input type="number" name="discount" class="form-control"
                                value="{{ old('discount', $test->discount ?? 0) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">دسته‌بندی</label>
                            <select name="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $test->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label class="block mb-1">لینک آزمون</label>
                            <input type="url" name="test_link" class="form-control"
                                value="{{ old('test_link', $test->test_link ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label class="block mb-1">توضیح کوتاه</label>
                            <textarea name="short_description" class="form-control">{{ old('short_description', $test->short_description ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label class="block mb-1">توضیحات کامل</label>
                            <textarea name="description" id="description" class="form-control">{{ old('description', $test->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success">{{ isset($test) ? 'ویرایش' : 'ثبت تست' }}</button>
            </form>
        </div>
    </div>
@endsection
@section('javaScript')
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'توضیح کامل بنویسید...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
