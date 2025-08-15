@extends('dashboard.layout.master')

@section('title')
    <title>تنظیمات سایت</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>مدیریت بخش های صفحه اصلی</h5>

            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mt-4">

                    {{-- متن اسلایدر --}}
                    <div class="col-md-12 mb-3">
                        <label for="slider_text" class="form-label">متن کنار اسلایدر:</label>
                        <textarea class="form-control" id="slider_text" name="slider_text" rows="2">{{ old('slider_text', $settings['slider_text']->value ?? '') }}</textarea>
                    </div>

                    {{-- چرا کلینیک؟ --}}
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="col-md-6 mb-3">
                            <label for="why_clinic_{{ $i }}" class="form-label">چرا کلینیک؟ {{ $i }}:</label>
                            <input type="text" class="form-control" id="why_clinic_{{ $i }}" name="why_clinic_{{ $i }}"
                                   value="{{ old("why_clinic_$i", $settings["why_clinic_$i"]->value ?? '') }}">
                        </div>
                    @endfor

                    {{-- متن معرفی مدیر --}}
                    <div class="col-md-12 mb-3">
                        <label for="manager_text" class="form-label">متن معرفی مدیر:</label>
                        <textarea class="form-control" id="manager_text" name="manager_text" rows="3">{{ old('manager_text', $settings['manager_text']->value ?? '') }}</textarea>
                    </div>

                    {{-- عکس مدیر --}}
                    <div class="col-md-6 mb-3">
                        <label for="manager_image" class="form-label">عکس مدیر کلینیک:</label>
                        <input type="file" class="form-control" id="manager_image" name="manager_image">
                        @if (!empty($settings['manager_image']->value))
                            <img src="{{ asset($settings['manager_image']->value) }}" width="150" class="mt-2 rounded">
                        @endif
                    </div>

                    {{-- متن فوتر --}}
                    <div class="col-md-12 mb-3">
                        <label for="footer_text" class="form-label">متن داخل فوتر:</label>
                        <textarea class="form-control" id="footer_text" name="footer_text" rows="2">{{ old('footer_text', $settings['footer_text']->value ?? '') }}</textarea>
                    </div>

                </div>

                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-success w-25">ذخیره تنظیمات</button>
                </div>
            </form>
        </div>
    </div>
@endsection
