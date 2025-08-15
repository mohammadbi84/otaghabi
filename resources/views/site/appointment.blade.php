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
                        <div class="mb-3">
                            <label for="field">حوزه مشاوره</label>
                            <select name="category_id" id="field">
                                <option value="" selected disabled>انتخاب کنید</option>
                                <option value="0">نیاز به کمک دارید؟</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <!-- مشاور -->
                        <div class="mb-3">
                            <label for="consultant_id">انتخاب مشاور</label>
                            <select name="consultant_id" class="choices form-select">
                                <option value="" disabled
                                    {{ old('consultant_id', $selectedConsultant ?? '') ? '' : 'selected' }}>
                                    انتخاب مشاور
                                </option>
                                @foreach ($consultants as $consultant)
                                    <option value="">نیاز به کمک دارید؟</option>
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
        new Choices('#field', {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false
        });

        new Choices('#consultant_id', {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
            placeholderValue: 'انتخاب مشاور',
        });
    </script>
    <script>
        const consultantSelect = document.getElementById('consultant_id');
        const consultantChoices = new Choices(consultantSelect, {
            searchEnabled: true,
            itemSelectText: '',
            shouldSort: false,
            placeholderValue: 'انتخاب مشاور',
        });

        const fieldSelect = document.getElementById('field');

        fieldSelect.addEventListener('change', function() {
            const categoryId = this.value;

            fetch(`/get-consultants-by-category/${categoryId}`)
                .then(res => res.json())
                .then(data => {
                    consultantChoices.clearChoices();
                    consultantChoices.setChoices(
                        data.map(item => ({
                            value: item.id,
                            label: item.name
                        })),
                        'value',
                        'label',
                        true
                    );
                });
        });

        new Choices('#field', {
            searchEnabled: false,
            itemSelectText: '',
            shouldSort: false
        });
    </script>
@endsection
