@extends('dashboard.layout.master')

@section('title')
    <title>افزودن متخصص</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-3 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">افزودن متخصص</h5>
            </div>

            <form action="{{ route('psychologists.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="name" class="form-label">نام<span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="نام متخصص"
                                value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="mobile" class="form-label">موبایل<span class="text-danger">*</span> :</label>
                            <input type="number" class="form-control" id="mobile" name="mobile"
                                placeholder="موبایل متخصص" value="{{ old('mobile') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 mt-3">
                            <label for="image" class="form-label">عکس پروفایل<span class="text-danger">*</span> :</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="degree" class="form-label">مدرک<span class="text-danger">*</span> :</label>
                            <input type="text" class="form-control" id="degree" name="degree"
                                placeholder="مدرک متخصص" value="{{ old('degree') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="city_id" class="form-label">شهر محل خدمت<span class="text-danger">*</span>
                                :</label>
                            <select class="form-select" id="city_id" name="city_id">
                                <option value="">انتخاب شهر</option>
                                @foreach ($cities as $city)
                                    <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>
                                        {{ $city->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">مشاوره آنلاین<span class="text-danger">*</span> :</label>
                            <select class="form-select" name="is_online">
                                <option value="0" {{ old('is_online') == '0' ? 'selected' : '' }}>ندارد</option>
                                <option value="1" {{ old('is_online') == '1' ? 'selected' : '' }}>دارد</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="categories" class="form-label">حوزه‌های مشاوره<span class="text-danger">*</span>
                                :</label>
                            <select class="form-select" id="categories" name="categories[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="bio" class="form-label">بیوگرافی<span class="text-danger">*</span> :</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4" placeholder="بیوگرافی متخصص">{{ old('bio') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-danger w-25">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <!-- Choices.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('categories');
            new Choices(categorySelect, {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'حوزه‌های مشاوره را انتخاب کنید',
                searchPlaceholderValue: 'جستجوی حوزه‌ها'
            });
            const citySelect = document.getElementById('city_id');
            new Choices(citySelect, {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'شهر محل خدمت را انتخاب کنید',
                searchPlaceholderValue: 'جستجوی حوزه‌ها'
            });

        });
    </script>

    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bio').summernote({
                placeholder: 'توضیح کامل بنویسید...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
