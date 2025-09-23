@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت درباره ما</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" />
@endsection

@section('body')
    <div class="col px-4">

        {{-- پیغام موفقیت --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>مدیریت بخش درباره ما</h5>

            <form action="{{ route('about.update') }}" method="POST" enctype="multipart/form-data" id="mainForm">
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

                    {{-- نمایش تصاویر موجود --}}
                    @if ($about->galleries->count())
                        <div class="row mt-3" id="gallery-container">
                            @foreach ($about->galleries as $image)
                                <div class="col-md-3 position-relative mb-3 image-item" data-id="{{ $image->id }}">
                                    <img src="{{ asset($image->image) }}" class="img-fluid rounded shadow-sm">
                                    <button type="button"
                                        class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 delete-image-btn"
                                        data-id="{{ $image->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
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
    <!-- Summernote -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    <!-- jQuery -->
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            // Summernote initialization
            $('#content').summernote({
                height: 200,
                placeholder: 'متن درباره ما را وارد کنید...',
            });

            // حذف تصویر با Ajax
            $(document).on('click', '.delete-image-btn', function(e) {
                e.preventDefault();

                const imageId = $(this).data('id');
                const imageElement = $(this).closest('.image-item');

                if (confirm('آیا از حذف این تصویر مطمئن هستید؟')) {
                    $.ajax({
                        url: '{{ route('about.image.delete', '') }}/' + imageId,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            _method: 'DELETE'
                        },
                        success: function(response) {
                            if (response.success) {
                                // حذف تصویر از صفحه
                                imageElement.fadeOut(300, function() {
                                    $(this).remove();

                                    // اگر تصویری باقی نمانده بود، پیام نشان دهید
                                    if ($('#gallery-container .image-item').length ===
                                        0) {
                                        $('#gallery-container').html(
                                            '<p class="text-muted">تصویری وجود ندارد</p>'
                                            );
                                    }
                                });

                                // نمایش پیام موفقیت
                                showAlert('تصویر با موفقیت حذف شد', 'success');
                            } else {
                                showAlert('خطا در حذف تصویر', 'error');
                            }
                        },
                        error: function(xhr) {
                            console.error(xhr);
                            showAlert('خطا در حذف تصویر', 'error');
                        }
                    });
                }
            });

            // تابع برای نمایش پیام
            function showAlert(message, type) {
                // حذف آلرت قبلی اگر وجود دارد
                $('.custom-alert').remove();

                const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
                const alertHtml = `
                    <div class="alert ${alertClass} custom-alert alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;

                $('.container').prepend(alertHtml);

                // حذف خودکار پیام بعد از 5 ثانیه
                setTimeout(function() {
                    $('.custom-alert').alert('close');
                }, 5000);
            }
        });
    </script>
@endsection
