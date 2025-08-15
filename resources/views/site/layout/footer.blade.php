@php
    $socialLinks = App\Models\SocialLink::all();
    function getSocialIcon($platform)
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

    function formatLabel($platform)
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
<!-- footer -->
<div class="container-fluid text-white mt-5 p-0">
    <footer class="text-right footer border-top border-4 border-blue">
        <div class="container py-5">
            <div class="row py-3">
                <div class="col-lg-4 col-md-6 mb-lg-0">
                    <h5 class="font-weight-bold mb-4">کلینیک روانپویشی اتاق آبی</h5>
                    <p class="text-white mb-4">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با
                        استفاده از طراحان گرافیک است، چاپگرها و متون بلکه روزنامه و مجله
                        در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد
                        نیاز، و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                    </p>
                    <ul class="list-inline mt-4">
                        {{-- <li class="list-inline-item">
                            <a href="#" target="_blank" title="twitter"><i class="fab fa-2x fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="instagram"><i
                                    class="fab fa-2x fa-instagram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="vimeo"><i class="fab fa-2x fa-telegram"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" target="_blank" title="vimeo"><i class="fab fa-2x fa-google"></i></a>
                        </li> --}}
                        @foreach ($socialLinks as $link)
                            <li class="list-inline-item">
                                @if (!in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                    <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                                        <i class="fab {{ getSocialIcon($link->platform) }} fa-2x"></i>
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <h6 class="font-weight-bold mb-4">راه های ارتباطی</h6>
                    <ul class="list-unstyled mb-0">
                        @foreach ($socialLinks as $link)
                            <li class="mb-2">
                                @if (in_array($link->platform, ['phone', 'mobile', 'address', 'worktime']))
                                    <i class="fa-solid {{ getSocialIcon($link->platform) }}"></i>
                                    <span>{{ formatLabel($link->platform) }} :</span> <span>{{ $link->url }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <h6 class="font-weight-bold mb-4">دسترسی سریع</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3">
                            <a href="/psychologists.html" class="">رواندرمانی</a>
                        </li>
                        <li class="mb-3">
                            <a href="/psychologists.html" class="">روانشناسان</a>
                        </li>
                        <li class="mb-3">
                            <a href="/blogs.html" class="">وبلاگ</a>
                        </li>
                        <!-- <li class="mb-3">
                            <a href="#" class="">درباره ما</a>
                        </li> -->
                        <li class="mb-3">
                            <a href="/user/profile.html" class="">پروفایل</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0 border">
                    <img src="/images/no-image.png" alt="enemad" class="w-100" />
                </div>
            </div>
        </div>
    </footer>
</div>
