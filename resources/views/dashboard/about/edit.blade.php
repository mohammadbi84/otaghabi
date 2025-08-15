@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت درباره ما</title>
@endsection

@section('body')
    <div class="col px-4">

        {{-- پیغام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>مدیریت بخش درباره ما</h5>

            <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- متن درباره ما --}}
                <div class="mb-4 mt-3">
                    <label for="content" class="form-label">متن درباره ما:</label>
                    <textarea class="form-control" name="content" id="content" rows="5">{{ old('content', $about->content) }}</textarea>
                </div>

                {{-- گالری تصاویر --}}
                <div class="mb-4">
                    <label class="form-label">گالری تصاویر:</label>
                    <input type="file" name="images[]" multiple class="form-control">
                    @if ($about->galleries->count())
                        <div class="row mt-3">
                            @foreach ($about->galleries as $image)
                                <div class="col-md-3 position-relative mb-3">
                                    <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid rounded shadow-sm">
                                    <form action="{{ route('about.image.delete', $image->id) }}" method="POST"
                                        class="position-absolute top-0 end-0 m-1">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('حذف شود؟')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- موقعیت جغرافیایی --}}
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="latitude" class="form-label">عرض جغرافیایی (Latitude):</label>
                        <input type="text" name="latitude" id="latitude" class="form-control"
                            value="{{ old('latitude', $about->latitude) }}">
                    </div>
                    <div class="col-md-6">
                        <label for="longitude" class="form-label">طول جغرافیایی (Longitude):</label>
                        <input type="text" name="longitude" id="longitude" class="form-control"
                            value="{{ old('longitude', $about->longitude) }}">
                    </div>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-25">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <!-- Summernote (اختیاری برای متن درباره ما) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />

    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 200,
                placeholder: 'متن درباره ما را وارد کنید...',

            });
        });
    </script>
@endsection
