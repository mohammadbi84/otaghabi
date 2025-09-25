@extends('site.layout.master')
@section('head')
    <link rel="stylesheet" href="{{asset('assets/css/checkout.css')}}">
    <title>پرداخت و آپلود رسید</title>
@endsection
@section('content')
<div class="container checkout_main p-0 mt-5">
        <header>
            <h1>تکمیل فرآیند پرداخت</h1>
            <p>لطفا مبلغ سبد خرید خود را به شماره کارت زیر واریز کرده و رسید پرداخت را آپلود کنید</p>
        </header>

        <div class="content">
            <div class="order-summary">
                <h2>خلاصه سفارش</h2>
                <div class="summary-item">
                    <span>قیمت کل:</span>
                    <span>{{number_format($cart->total_price)}} تومان</span>
                </div>
                <div class="summary-item discount">
                    <span>تخفیف:</span>
                    <span>{{number_format($cart->total_price - $cart->final_price)}} تومان</span>
                </div>
                <div class="summary-item total">
                    <span>قیمت قابل پرداخت:</span>
                    <span>{{number_format($cart->final_price)}} تومان</span>
                </div>
            </div>

            <div class="card-container">
                <div class="card-header">
                    <div class="card-logo">بانک ملت</div>
                    <div class="card-chip"></div>
                </div>
                <div class="card-number">6037 - 9911 - 2345 - 6789</div>
                <div class="card-details">
                    <div class="card-holder">
                        <div class="card-label">صاحب کارت</div>
                        <div>فروشگاه آنلاین ما</div>
                    </div>
                    <div class="card-expiry">
                        <div class="card-label">تاریخ انقضا</div>
                        <div>08/25</div>
                    </div>
                </div>
            </div>

            <div class="upload-section">
                <h2>آپلود رسید پرداخت</h2>
                <div class="upload-area" id="uploadArea">
                    <div class="upload-icon">📁</div>
                    <div class="upload-text">برای آپلود رسید پرداخت، اینجا کلیک کنید یا فایل را اینجا رها کنید</div>
                    <button class="upload-btn">انتخاب فایل</button>

                    <div class="preview-container" id="previewContainer">
                        <img class="preview-image" id="previewImage" src="" alt="پیش نمایش تصویر">
                        <button class="change-file" id="changeFile">تغییر تصویر</button>
                    </div>

                    <div class="file-name" id="fileName">هیچ فایلی انتخاب نشده است</div>
                </div>
                <p>فرمت‌های مجاز: JPG, PNG (حداکثر حجم: 5MB)</p>
            </div>

            <div class="submit-section">
                <form action="{{route('cart.store',['cart'=>$cart])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="fileInput" name="image" style="display: none;" accept="image/*">
                    <button class="submit-btn" id="submitBtn">تایید و ارسال</button>
                </form>
            </div>
        </div>

        <footer class="cart_footer">
            <p>در صورت بروز هرگونه مشکل با پشتیبانی تماس بگیرید</p>
        </footer>
    </div>
@endsection
@section('script')
<script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const uploadArea = document.getElementById('uploadArea');
            const fileName = document.getElementById('fileName');
            const submitBtn = document.getElementById('submitBtn');
            const previewContainer = document.getElementById('previewContainer');
            const previewImage = document.getElementById('previewImage');
            const changeFileBtn = document.getElementById('changeFile');

            // مدیریت کلیک روی آپلود
            uploadArea.addEventListener('click', function(e) {
                if (e.target !== changeFileBtn) {
                    fileInput.click();
                }
            });

            // مدیریت تغییر فایل
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    fileName.textContent = file.name;

                    // نمایش پیش‌نمایش تصویر
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewContainer.classList.add('active');
                        };

                        reader.readAsDataURL(file);
                    }

                    uploadArea.style.borderColor = '#218DCD';
                    uploadArea.style.backgroundColor = 'rgba(33, 141, 205, 0.05)';
                } else {
                    fileName.textContent = 'هیچ فایلی انتخاب نشده است';
                    previewContainer.classList.remove('active');
                    uploadArea.style.borderColor = '#ccc';
                    uploadArea.style.backgroundColor = 'transparent';
                }
            });

            // مدیریت دکمه تغییر تصویر
            changeFileBtn.addEventListener('click', function(e) {
                e.stopPropagation(); // جلوگیری از اجرای کلیک روی uploadArea
                fileInput.click();
            });

            // مدیریت کشیدن و رها کردن فایل
            uploadArea.addEventListener('dragover', function(e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#218DCD';
                uploadArea.style.backgroundColor = 'rgba(33, 141, 205, 0.1)';
            });

            uploadArea.addEventListener('dragleave', function() {
                uploadArea.style.borderColor = '#ccc';
                uploadArea.style.backgroundColor = 'transparent';
            });

            uploadArea.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadArea.style.borderColor = '#218DCD';
                uploadArea.style.backgroundColor = 'rgba(33, 141, 205, 0.05)';

                if (e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    const file = fileInput.files[0];
                    fileName.textContent = file.name;

                    // نمایش پیش‌نمایش تصویر
                    if (file.type.match('image.*')) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            previewImage.src = e.target.result;
                            previewContainer.classList.add('active');
                        };

                        reader.readAsDataURL(file);
                    }
                }
            });
        });
    </script>
@endsection
