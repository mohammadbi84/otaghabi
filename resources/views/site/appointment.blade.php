@extends('site.layout.master')

@section('head')
    <title>درخواست مشاوره</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />

    <style>
        .form-box {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .custom-input-group {
            position: relative;
            margin-bottom: 25px;
        }

        .custom-input-group input,
        .custom-input-group select {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 14px 12px 6px;
            width: 100%;
            background: #fff;
            outline: none;
        }

        .custom-input-group label {
            position: absolute;
            top: 12px;
            right: 14px;
            background: white;
            padding: 0 4px;
            font-size: 14px;
            color: #888;
            transition: 0.2s;
            pointer-events: none;
        }

        .custom-input-group input:focus+label,
        .custom-input-group input:not(:placeholder-shown)+label,
        .custom-input-group select:focus+label,
        .custom-input-group select:not([value=""])+label {
            top: -8px;
            right: 10px;
            font-size: 12px;
            color: #3a3a3a;
        }

        /* استایل برای Choices.js */
        .choices {
            margin-bottom: 0;
        }

        .choices__inner {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 12px;
            min-height: auto;
            background: #fff;
        }

        .choices__list--dropdown .choices__item--selectable {
            padding-right: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-box">
                    <h4 class="mb-4 text-center">درخواست جلسه مشاوره</h4>

                    <form action="{{ route('consultations.store') }}" method="POST">
                        @csrf

                        <!-- نام -->
                        <div class="custom-input-group">
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', auth()->user()->name ?? '') }}" required placeholder=" ">
                            <label for="name">نام کامل</label>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- شماره موبایل -->
                        <div class="custom-input-group">
                            <input type="text" name="mobile" id="mobile" class="form-control"
                                value="{{ old('mobile', auth()->user()->mobile ?? '') }}" required placeholder=" ">
                            <label for="mobile">شماره موبایل</label>
                            @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- حوزه مشاوره -->
                        <div class="custom-input-group">
                            <select name="category_id" id="field" required>
                                <option value="" selected disabled>انتخاب حوزه مشاوره</option>
                                <option value="0">نیاز به کمک دارید؟</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->title }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- مشاور -->
                        <div class="custom-input-group" id="consultant-field">
                            <select name="consultant_id" id="consultant_id">
                                <option value="" selected disabled>انتخاب مشاور</option>
                                @foreach ($consultants as $consultant)
                                    <option value="{{ $consultant->id }}"
                                        {{ old('consultant_id', $selectedConsultant ?? '') == $consultant->id ? 'selected' : '' }}>
                                        {{ $consultant->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('consultant_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- سوالات -->
                        <div id="questions-box" class="mt-4" style="display:none;">
                            <h5 class="mb-3">لطفا به سوالات زیر پاسخ دهید:</h5>

                            @foreach ($questions as $question)
                                <div class="custom-input-group">
                                    <input type="text" name="questions[{{ $question->id }}]"
                                        id="question-{{ $question->id }}" class="form-control"
                                        value="{{ old('questions.' . $question->id) }}" placeholder=" ">
                                    <label for="question-{{ $question->id }}">{{ $question->question }}</label>
                                </div>
                            @endforeach
                        </div>

                        <!-- دکمه ثبت -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-blue py-2">ارسال درخواست</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // مقداردهی اولیه Choices
            let fieldChoices, consultantChoices;

            // فقط اگر المنت وجود دارد، Choices را ایجاد کن
            const fieldSelect = document.getElementById('field');
            const consultantSelect = document.getElementById('consultant_id');

            if (fieldSelect) {
                fieldChoices = new Choices(fieldSelect, {
                    searchEnabled: false,
                    itemSelectText: '',
                    shouldSort: false,
                    placeholderValue: 'انتخاب حوزه مشاوره'
                });
            }

            if (consultantSelect) {
                consultantChoices = new Choices(consultantSelect, {
                    searchEnabled: true,
                    itemSelectText: '',
                    shouldSort: false,
                    placeholderValue: 'انتخاب مشاور'
                });
            }

            // مدیریت تغییر حوزه مشاوره
            if (fieldSelect) {
                fieldSelect.addEventListener('change', function() {
                    const categoryId = this.value;
                    const questionsBox = document.getElementById('questions-box');
                    const consultantField = document.getElementById('consultant-field');

                    if (categoryId === "0") {
                        // گزینه "نیاز به کمک دارید؟"
                        if (questionsBox) questionsBox.style.display = "block";
                        if (consultantField) consultantField.style.display = "none";

                        // پاک کردن انتخاب مشاور
                        if (consultantChoices) {
                            consultantChoices.setChoiceByValue('');
                        }
                    } else {
                        // سایر حوزه‌های مشاوره
                        if (questionsBox) questionsBox.style.display = "none";
                        if (consultantField) consultantField.style.display = "block";

                        // بارگذاری مشاوران مربوط به این دسته‌بندی
                        loadConsultantsByCategory(categoryId);
                    }
                });
            }

            // تابع برای بارگذاری مشاوران بر اساس دسته‌بندی
            function loadConsultantsByCategory(categoryId) {
                if (!consultantChoices) return;

                fetch(`/get-consultants-by-category/${categoryId}`)
                    .then(res => {
                        if (!res.ok) throw new Error('Network response was not ok');
                        return res.json();
                    })
                    .then(data => {
                        consultantChoices.clearChoices();
                        consultantChoices.setChoices(
                            data.map(item => ({
                                value: item.id,
                                label: item.name,
                                selected: false
                            })),
                            'value',
                            'label',
                            false
                        );
                    })
                    .catch(error => {
                        console.error('Error loading consultants:', error);
                    });
            }

            // مقداردهی اولیه وضعیت فرم بر اساس مقدار selected
            const initialCategory = "{{ old('category_id') }}";
            if (initialCategory === "0") {
                const questionsBox = document.getElementById('questions-box');
                const consultantField = document.getElementById('consultant-field');
                if (questionsBox) questionsBox.style.display = "block";
                if (consultantField) consultantField.style.display = "none";
            }
        });
    </script>
@endsection
