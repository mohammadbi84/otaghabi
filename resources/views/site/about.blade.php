@extends('site.layout.master')
@section('head')
    <title>درباره کلینیک اتاق آبی</title>
    <!-- Leaflet Map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 300px;
            width: 100%;
            border-radius: 12px;
        }
    </style>
@endsection
@php
    $socialLinks2 = App\Models\SocialLink::all();
    function getSocialIcon2($platform)
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

    function formatLabel2($platform)
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
    <div class="container py-5">
        <!-- عنوان -->
        <div class="d-blok p-2 mt-2 mb-3">
            <h3 class="text-center services_header">
                <span class="px-3 border-bottom border-3" style="border-color: #afd3e2 !important">درباره کلینیک اتاق
                    آبی</span>
            </h3>
        </div>
        <!-- متن درباره ما -->
        <div class="row align-items-center mb-5">
            <div class="col-lg-12 mt-3 px-0">
                <div class="bg-white rounded-4 shadow border p-3">
                    <p class="lh-lg">{!! $about->content !!}</p>
                </div>
            </div>
            <!-- گالری تصاویر -->
            @if ($about->galleries && $about->galleries->count())
                <div class="col-lg-12 mt-3 px-0">
                    <div class="bg-white rounded-4 shadow border p-3">
                        <h4 class="px-4">تصاویری از محیط کلینیک</h4>
                        <div class="splide" id="slider4" role="group" aria-label="Splide Basic HTML Example">
                            <div class="splide__track p-3 rounded-4">
                                <ul class="splide__list">
                                    @foreach ($about->galleries as $gallery)
                                        <li class="splide__slide">
                                            <img src="{{ asset('storage/' . $gallery->image) }}" class="w-100 rounded-3"
                                                alt="gallery">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- راه‌های ارتباطی و نقشه -->
        <div class="row gy-4 align-items-center bg-white rounded-4 shadow border p-3">
            <div class="col-lg-6 text-center">
                <h5 class="mb-3 me-4">راه‌های ارتباط با ما</h5>
                <ul class="list-unstyled">
                    @foreach ($socialLinks2 as $link)
                        <li class="mb-2">
                            @if (in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                <i class="fa-solid {{ getSocialIcon2($link->platform) }}"></i>
                                <span>{{ formatLabel2($link->platform) }} :</span> <span>{{ $link->url }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
                <ul class="list-inline mt-4">
                    @foreach ($socialLinks2 as $link)
                        <li class="list-inline-item">
                            @if (!in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none text-muted">
                                    <i class="fab {{ getSocialIcon2($link->platform) }} fa-2x"></i>
                                </a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <div>
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Leaflet نقشه -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        var lat = {{ $about->latitude ?? 35.6892 }};
        var lng = {{ $about->longitude ?? 51.389 }};
        var map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
        L.marker([lat, lng]).addTo(map)
            .bindPopup('کلینیک اتاق آبی')
            .openPopup();
    </script>

    <!-- Splide گالری -->
    <script>
        var splide = new Splide("#slider4", {
            direction: "rtl",
            focus: "center",
            perPage: 3,
            gap: "2rem",
            omitEnd: true,
            pagination: false,
            breakpoints: {
                991: {
                    perPage: 1.5
                },
            },
        });
        splide.mount();
    </script>
@endsection
