@extends('site.layout.master')
@section('head')
    <title>تماس کلینیک اتاق آبی</title>
    <style>
        #info {
            /* background: #fff; */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
        }

        .contact-form {
            /* background: #fff; */
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 20px;
            /* border-radius: 10px; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        .button-title {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .required-star {
            color: red;
        }
    </style>
@endsection
@php
    $socialLinks2 = App\Models\SocialLink::all();
    function getSocialIcon3($platform)
    {
        return match (strtolower($platform)) {
            'instagram' => 'fa-instagram',
            'telegram' => 'fa-telegram',
            'linkedin' => 'fa-linkedin',
            'whatsapp' => 'fa-whatsapp',
            'facebook' => 'fa-facebook',
            'twitter', 'x' => 'fa-x-twitter',
            'youtube' => 'fa-youtube',
            'github' => 'fa-github',
            'phone' => 'fa-phone',
            'mobile' => 'fa-mobile-alt',
            'address' => 'fa-map-marker-alt',
            'worktime' => 'fa-clock',
            default => 'fa-globe',
        };
    }

    function formatLabel3($platform)
    {
        return match (strtolower($platform)) {
            'phone' => 'تلفن',
            'mobile' => 'موبایل',
            'address' => 'آدرس',
            'worktime' => 'ساعت کاری',
            default => ucfirst($platform),
        };
    }
@endphp
@section('content')
    <!-- main -->
    <div class="container mt-5">
        <div class="row align-items-center">
            <div id="info"
                class="col-md-5 bg-white d-flex flex-column align-items-center justify-content-center rounded-4 shadow h-100">
                <img src="{{ asset('assets/images/logo_full.jpg') }}" alt="کلینیک اتاق آبی" class="img-fluid mb-3"
                    style="max-width: 100px;">
                <p class="text-center">هرگونه سوال، پیشنهاد یا انتقادی دارید، خوشحال میشویم با ما در میان بگذارید. تیم ما
                    همواره آماده شنیدن
                    نظرات شماست!</p>
                {{-- <div class="m-1 ">
                    <i class="fa-brands fa-instagram fa-xl"></i>
                    <a href="#" class="text-footer text-reset">@otagheabi</a>
                </div>
                <div class="m-1 ">
                    <i class="fa-brands fa-telegram fa-xl"></i>
                    <a href="#" class="text-footer text-reset">@otagheabi</a>
                </div>
                <div class="m-1 ">
                    <i class="fa-regular fa-circle-play fa-xl"></i>
                    <a href="#" class="text-footer text-reset">آپارات اتاق آبی</a>
                </div> --}}
                <ul class="list-unstyled">
                    @foreach ($socialLinks2 as $link)
                        <li class="mb-2">
                            @if (in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                <i class="fa-solid {{ getSocialIcon3($link->platform) }}"></i>
                                <span>{{ formatLabel3($link->platform) }} :</span> <span>{{ $link->url }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <ul class="list-inline">
                    @foreach ($socialLinks2 as $link)
                        <li class="list-inline-item">
                            @if (!in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none text-muted">
                                    <i class="fab {{ getSocialIcon3($link->platform) }} fa-2x"></i>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-7 ">
                <div class="contact-form rounded-4 bg-white shadow h-100">
                    <form method="post" action="{{ route('messages.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">نام و نام خانوادگی <span
                                    class="required-star">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="نام و نام خانوادگی" required>
                        </div>
                        <div class="mb-3">
                            <label for="mobile" class="form-label">شماره تماس <span class="required-star">*</span></label>
                            <input type="text" name="mobile" id="mobile" class="form-control" placeholder="11 رقمی"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">پیام شما <span class="required-star">*</span></label>
                            <textarea name="text" id="text" class="form-control" placeholder="نظرات، پیشنهادات، انتقادات و سوالات شما"
                                rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-blue">ارسال</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
