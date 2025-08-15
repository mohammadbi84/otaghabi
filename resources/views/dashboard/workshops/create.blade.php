@extends('dashboard.layout.master')

@section('title')
    <title>{{ isset($workshop) ? 'ویرایش کارگاه' : 'افزودن کارگاه' }}</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>{{ isset($workshop) ? 'ویرایش کارگاه' : 'افزودن کارگاه' }}</h5>

            <form action="{{ isset($workshop) ? route('workshops.update', $workshop->id) : route('workshops.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($workshop))
                    @method('PUT')
                @endif
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">عنوان کارگاه :</label>
                            <input type="text" class="form-control" id="title" name="title"
                                placeholder="عنوان کارگاه" value="{{ old('title', $workshop->title ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cover" class="form-label">کاور :</label>
                            <input type="file" class="form-control" id="cover" name="cover">
                            @if (isset($workshop) && $workshop->cover)
                                <img src="{{ asset($workshop->cover) }}" width="120px" class="mt-2">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">قیمت :</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="قیمت"
                                value="{{ old('price', $workshop->price ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="discount" class="form-label">تخفیف :</label>
                            <input type="number" class="form-control" id="discount" name="discount"
                                placeholder="میزان تخفیف" value="{{ old('discount', $workshop->discount ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="capacity" class="form-label">ظرفیت :</label>
                            <input type="number" class="form-control" id="capacity" name="capacity" placeholder="ظرفیت"
                                value="{{ old('capacity', $workshop->capacity ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="age_group" class="form-label">رده سنی :</label>
                            <input type="text" class="form-control" id="age_group" name="age_group"
                                placeholder="مثلاً 15 تا 30 سال" value="{{ old('age_group', $workshop->age_group ?? '') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="type" class="form-label">نوع برگزاری :</label>
                            <select class="form-select" id="type" name="type">
                                <option value="online"
                                    {{ old('type', $workshop->type ?? '') == 'online' ? 'selected' : '' }}>
                                    آنلاین</option>
                                <option value="offline"
                                    {{ old('type', $workshop->type ?? '') == 'offline' ? 'selected' : '' }}>
                                    آفلاین</option>
                                <option value="in_person"
                                    {{ old('type', $workshop->type ?? '') == 'in_person' ? 'selected' : '' }}>حضوری
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3" id="link_section" style="display: none;">
                            <label for="link" class="form-label">لینک برگزاری (در صورت آنلاین) :</label>
                            <input type="text" class="form-control" id="link" name="link"
                                placeholder="لینک برگزاری" value="{{ old('link', $workshop->link ?? '') }}">
                        </div>
                        <div class="mb-3" id="video_section" style="display: none;">
                            <label for="video" class="form-label">ویدیو آموزشی (در صورت آفلاین) :</label>
                            <input type="file" class="form-control" id="video" name="video">
                            @if (isset($workshop) && $workshop->video)
                                <video src="{{ asset($workshop->video) }}" controls width="200"
                                    class="mt-2"></video>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="teacher_id" class="form-label">انتخاب استاد :</label>
                            <select class="form-select" id="teacher_id" name="teacher_id">
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}"
                                        {{ old('teacher_id', $workshop->teacher_id ?? '') == $teacher->id ? 'selected' : '' }}>
                                        {{ $teacher->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="categories" class="form-label">انتخاب دسته‌بندی‌ها :</label>
                            <select class="form-select" id="categories" name="category">
                                @foreach ($categories as $category)
                                    <option value="" selected disabled>انخاب کنید</option>
                                    <option value="{{ $category->id }}"
                                        {{ isset($workshop) && $workshop->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="short_description" class="form-label">توضیح کوتاه :</label>
                            <textarea class="form-control" id="short_description" name="short_description" rows="2"
                                placeholder="توضیح کوتاه بنویسید">{{ old('short_description', $workshop->short_description ?? '') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">توضیح کامل :</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="توضیح کامل بنویسید">{{ old('description', $workshop->description ?? '') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-danger w-25 align-middle">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        new Choices('#categories', {
            removeItemButton: true
        });

        function toggleSections() {
            var type = document.getElementById('type').value;
            document.getElementById('link_section').style.display = (type === 'online') ? 'block' : 'none';
            document.getElementById('video_section').style.display = (type === 'offline') ? 'block' : 'none';
        }

        document.getElementById('type').addEventListener('change', toggleSections);
        toggleSections();
    </script>

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
