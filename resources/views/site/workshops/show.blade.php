@extends('site.layout.master')
@section('head')
    <title>{{ $workshop->title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary: #218DCD;
            --secondary: #146C94;
            --accent: #0ff6f9;
            --light: #fff;
        }

        .video-card {
            background: var(--light);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }


        .video-subtitle {
            opacity: 0.9;
            font-size: 1rem;
        }

        .player-section {
            padding: 0;
            position: relative;
        }

        .video-wrapper {
            position: relative;
            width: 100%;
            background: #000;
        }

        video {
            width: 100%;
            display: block;
            outline: none;
        }

        .custom-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
            padding: 1rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .video-wrapper:hover .custom-controls {
            opacity: 1;
        }

        .progress-container {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
            margin-bottom: 1rem;
            cursor: pointer;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            background: var(--accent);
            border-radius: 3px;
            width: 0%;
            transition: width 0.1s linear;
        }

        .control-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .left-controls,
        .right-controls {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .control-btn {
            background: none;
            border: none;
            color: var(--light);
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        .play-pause {
            background: var(--primary);
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .play-pause i {
            position: relative;
            top: 3px;
            font-size: xx-large
        }

        .play-pause:hover {
            background: var(--secondary);
        }

        .volume-container {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .volume-slider {
            width: 80px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            position: relative;
            cursor: pointer;
        }

        .volume-level {
            height: 100%;
            background: var(--light);
            border-radius: 2px;
            width: 80%;
        }

        .time-display {
            color: var(--light);
            font-size: 0.9rem;
            font-family: 'Courier New', monospace;
        }

        .video-info {
            padding: 1.5rem 2rem;
        }

        .video-description {
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }

        .video-meta {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
        }

        .video-actions {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .action-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .action-btn:hover {
            background: var(--primary);
            color: var(--light);
            transform: translateY(-2px);
        }

        .action-btn.like.active {
            background: #e74c3c;
            border-color: #e74c3c;
            color: var(--light);
        }



        .watermark {
            position: absolute;
            top: 10px;
            right: 10px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.8rem;
            background: rgba(0, 0, 0, 0.5);
            padding: 2px 8px;
            border-radius: 3px;
        }

        .no-download {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.7);
            color: var(--light);
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 0.9rem;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .video-wrapper:hover .no-download {
            opacity: 1;
        }

        @media (max-width: 768px) {
            .video-title {
                font-size: 1.4rem;
            }

            .control-buttons {
                flex-wrap: wrap;
                justify-content: center;
                gap: 0.5rem;
            }

            .right-controls {
                order: -1;
                width: 100%;
                justify-content: center;
                margin-bottom: 0.5rem;
            }

            .video-meta {
                gap: 1rem;
            }

            .video-actions {
                justify-content: center;
            }
        }

        /* جلوگیری از دانلود */
        video::-webkit-media-controls {
            display: none !important;
        }

        video {
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
    </style>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <!-- workshop -->
        <div class="row p-3 pt-4 mt-3 bg-white border rounded-4 shadow">
            <!-- main product -->
            <div class="col-md-4 img-col">
                <img class="border rounded-4" src="{{ asset($workshop->cover) }}" alt="{{ $workshop->title }}" width="100%" />
            </div>
            <!-- body -->
            <div class="col-md-5 pe-4">
                <h1 class="mt-2 pb-2 px-2 border-bottom" style="font-size: 26px">
                    {{ $workshop->title }}
                </h1>
                <ul class="list-group list-group-horizontal mx-0 px-0 product-cat-links">
                    <li class="list-group-item ps-0 pt-0 mt-0 border-0">
                        دسته‌ بندی : <a href="#" class="px-1 address-link">{{ $workshop->category->title }}</a>
                    </li>
                    <li class="list-group-item ps-0 pt-0 mt-0 border-0">
                        <a href="#comments" class="px-1 address-link">
                            <i class="fa-regular fa-comment mx-1" style="color: #19a7ce"></i>
                            {{ $workshop->comments_count }} دیدگاه</a>
                    </li>
                </ul>
                <!-- form -->
                <div class="row pe-2 mt-4">
                    <div class="col-2 text-start p-2">
                        <img src="{{ asset($workshop->teacher->image) }}" alt="{{ $workshop->teacher->name }}"
                            class="rounded-circle w-75 border" />
                    </div>
                    <div class="col-10 p-2 pt-3 align-content-center">
                        <h6>
                            <a href="{{ route('psychologist', ['psychologist' => $workshop->teacher]) }}"
                                class="text-reset">
                                {{ $workshop->teacher->name }} </a>
                        </h6>
                    </div>
                </div>
                <!-- options -->
                <div class="row pe-2">
                    {{-- <div class="col p-2">
                            <label for="option" class="d-block mt-4 pe-2 me-1">نوع شرکت در دوره :</label>
                            <select id="option" class="form-select mt-2 w-100 number-form">
                                <option disabled selected>انتخاب کنید</option>
                                <option>آنلاین</option>
                                <option>آفلاین</option>
                                <option>حضوری</option>
                            </select>
                        </div> --}}
                    @if (!Auth::user()?->workshops_buy()->find($workshop->id))
                        <div class="col text-center align-content-end p-2">
                            <!-- price -->
                            <p class="d-block mt-2 pe-2 me-1"><strong
                                    style="font-size:24px;">{{ number_format($workshop->final_price) }}</strong>
                                <small>تومان</small>
                                <span>
                                    @if ($workshop->discount > 0)
                                        <span
                                            class="badge bg-danger mx-2">{{ $workshop->price > 0 ? (($workshop->price - $workshop->final_price) * 100) / $workshop->price : '' }}%
                                        </span>
                                        <del>{{ number_format($workshop->price) }}</del>
                                    @endif
                                </span>
                            </p>
                        </div>
                        @if ($alreadyInCart)
                            <a href="{{ route('cart') }}" class="btn btn-outline-info px-4 py-2 mt-0">
                                رفتن به سبد خرید
                                <i class="fa-solid fa-cart-shopping me-2"></i>
                            </a>
                        @else
                            <form action="{{ route('cart.add', ['type' => 'workshop', 'id' => $workshop->id]) }}"
                                method="POST">
                                @csrf
                                <button type="submit" class="btn btn-blue px-4 py-2 mt-0">
                                    افزودن به سبد خرید
                                </button>
                            </form>
                        @endif
                    @endif

                </div>
            </div>
            <!-- attributes -->
            <div class="col-md-3">
                <h3 class="mt-3 pb-2 px-2 border-bottom" style="font-size: 20px">
                    ویژگی ها
                </h3>
                <ul class="list-group list-group-flush me-0 pe-0 product-cat-links">
                    <li class="list-group-item">
                        <span style="color: rgb(93, 93, 93); font-size: 14px">ظرفیت :</span> {{ $workshop->capacity }} نفر
                    </li>
                    <li class="list-group-item">
                        <span style="color: rgb(93, 93, 93); font-size: 14px">نوع برگزاری : </span>
                        @if ($workshop->type == 'offline')
                            آفلاین
                        @elseif ($workshop->type == 'online')
                            آنلاین
                        @else
                            حضوری
                        @endif
                    </li>
                    <li class="list-group-item">
                        <span style="color: rgb(93, 93, 93); font-size: 14px">رده سنی :</span>{{ $workshop->age_group }}
                    </li>
                </ul>
            </div>
        </div>
        <!-- description start -->
        <div class="row mt-4 bg-white border rounded-4 shadow p-4">
            <h5>توضیحات آموزش</h5>
            <p class="mt-2" style="text-align: justify;">
                {!! $workshop->description !!}
            </p>
        </div>
        <!-- description end -->
        {{-- buyed workshop start --}}
        @if (Auth::user() and Auth::user()->workshops_buy()->find($workshop->id))
            <div class="row mt-4 bg-white border rounded-4 shadow p-4">
                @if ($workshop->type == 'online')
                    <h5>لینک آموزش</h5>
                    <p class="mt-2">
                        <a href="{{ $workshop->link }}" class="text-decoration-none">برای ورود به کارگاه در ساعت اعلام شده
                            روی این لینک کلیک کنید.</a>
                    </p>
                @elseif ($workshop->type == 'offline')
                    <h5>ویدیو آموزش</h5>
                    <div class="video-card">
                        <!-- بخش پلیر -->
                        <div class="player-section">
                            <div class="video-wrapper">
                                <video id="mainVideo" poster="{{ asset($workshop->cover) }}">
                                    <source src="{{ asset($workshop->video) }}" type="video/mp4">
                                    مرورگر شما از تگ ویدیو پشتیبانی نمی‌کند.
                                </video>

                                <div class="watermark">کلینیک مشاوره اتاق آبی</div>
                                <!-- <div class="no-download">امکان دانلود این ویدیو وجود ندارد</div> -->

                                <!-- کنترل‌های سفارشی -->
                                <div class="custom-controls">
                                    <div class="progress-container" id="progressContainer" dir="ltr">
                                        <div class="progress-bar" id="progressBar"></div>
                                    </div>

                                    <div class="control-buttons">
                                        <div class="left-controls">
                                            <button class="control-btn play-pause" id="playPauseBtn">
                                                <i class="bi bi-play-fill" id="playIcon"></i>
                                            </button>
                                            <button class="control-btn" id="muteBtn">
                                                <i class="bi bi-volume-up-fill" id="volumeIcon"></i>
                                            </button>

                                            <div class="volume-container">
                                                <div class="volume-slider" id="volumeSlider" dir="ltr">
                                                    <div class="volume-level" id="volumeLevel"></div>
                                                </div>
                                            </div>

                                            <div class="time-display">
                                                <span id="currentTime">00:00</span> / <span id="duration">00:00</span>
                                            </div>
                                        </div>

                                        <div class="right-controls">
                                            <button class="control-btn" id="fullscreenBtn">
                                                <i class="bi bi-arrows-fullscreen"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @endif
        {{-- buyed workshop end --}}
        <!-- similar start -->
        <div class="row rounded-4 border bg-white shadow mt-5 p-3">
            <h5 class="wrapper-title text-dark pb-1">کارگاه های مشابه</h5>
            <section class="splide" id="slider" aria-label="Splide Basic HTML Example" dir="ltr">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($similars as $item)
                            @if ($item->id != $workshop->id)
                                <li class="splide__slide">
                                    <a href="{{ route('workshop', ['workshop' => $item]) }}">
                                        <div class="card text-center rounded-4 card_hover">
                                            <img src="{{ asset($item->cover) }}"
                                                class="card-img-top w-100 rounded-4 border-bottom border-3 image_border"
                                                alt="{{ $item->title }}" />
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $item->title }}</h5>
                                                <small class="text-secondary mt-2">
                                                    {{ $item->category->title }} <span class="mx-2">|</span>
                                                    <i class="fa-regular fa-eye"></i>
                                                    {{ $item->participants_count }} نفر
                                                </small>
                                                <p class="card-text mt-3">
                                                    {{ $item->short_description }}
                                                </p>
                                                <p>
                                                    @if ($item->discount > 0)
                                                        <small
                                                            class="text-danger"><del>{{ number_format($item->price) }}</del><span
                                                                class="badge bg-danger mx-2">{{ $item->price > 0 ? (($item->price - $item->final_price) * 100) / $item->price : '' }}%</span></small>
                                                        {{ number_format($item->final_price) }} تومان
                                                    @else
                                                        {{ number_format($item->final_price) }} تومان
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
        <!-- similar end -->
        <!-- comment start -->
        <div class="row mt-5" id="comments">
            <!-- Comments Section -->
            <div class="col-12 p-4 px-5 rounded-4 bg-white shadow border">
                <h4 class="m-2">نظرات کاربران</h4>
                <!-- Add Comment -->
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="commentable_type" value="App\Models\Workshop">
                    <input type="hidden" name="commentable_id" value="{{ $workshop->id }}">

                    <div class="mb-3">
                        <label>نام</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>نظر شما</label>
                        <textarea name="body" class="form-control" rows="3" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-blue px-3">ارسال نظر</button>
                </form>

                <!-- Display Comments -->
                <div class="mt-5">
                    <h5>نظرات:</h5>
                    @if ($workshop->comments()->where('is_approved', true)->exists())
                        @foreach ($workshop->comments()->where('is_approved', true)->latest()->get() as $comment)
                            <div class="border p-3 rounded-3 mb-3 bg-light">
                                <p class="mb-2"><strong>{{ $comment->name }}</strong></p>
                                <span class="text-secondary">{{ jdate($comment->created_at)->format('%B %d، %Y') }}</span>
                                <p class="mb-3 mt-3">
                                    {{ $comment->body }}
                                </p>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- comment end -->
    </div>
@endsection
@section('script')
    <script>
        var splide = new Splide("#slider", {
            // type: "loop",
            // drag: "free",
            gap: "1rem",
            direction: "rtl",
            focus: "right",
            perPage: 3,
            omitEnd: true,
            pagination: (boolean = false),
            // perMove: 1,
            breakpoints: {
                991: {
                    perPage: 3,
                },
                480: {
                    perPage: 1.5,
                    drag: true,
                },
            },
        });
        splide.mount();
    </script>
    {{-- video player --}}
    <script>
        // عناصر DOM
        const video = document.getElementById('mainVideo');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const playIcon = document.getElementById('playIcon');
        const muteBtn = document.getElementById('muteBtn');
        const volumeIcon = document.getElementById('volumeIcon');
        const volumeSlider = document.getElementById('volumeSlider');
        const volumeLevel = document.getElementById('volumeLevel');
        const progressContainer = document.getElementById('progressContainer');
        const progressBar = document.getElementById('progressBar');
        const currentTimeEl = document.getElementById('currentTime');
        const durationEl = document.getElementById('duration');
        const fullscreenBtn = document.getElementById('fullscreenBtn');

        // وضعیت پلیر
        let isPlaying = false;
        let isMuted = false;
        let volume = 0.8;

        // مقداردهی اولیه حجم صدا
        video.volume = volume;
        volumeLevel.style.width = `${volume * 100}%`;

        // پخش و توقف ویدیو
        playPauseBtn.addEventListener('click', togglePlay);
        video.addEventListener('click', togglePlay);

        function togglePlay() {
            if (isPlaying) {
                video.pause();
                playIcon.className = 'bi bi-play-fill';
            } else {
                video.play();
                playIcon.className = 'bi bi-pause-fill';
            }
            isPlaying = !isPlaying;
        }

        // قطع و وصل صدا
        muteBtn.addEventListener('click', toggleMute);

        function toggleMute() {
            if (isMuted) {
                video.muted = false;
                volumeIcon.className = 'bi bi-volume-up-fill';
            } else {
                video.muted = true;
                volumeIcon.className = 'bi bi-volume-mute-fill';
            }
            isMuted = !isMuted;
        }

        // کنترل حجم صدا
        volumeSlider.addEventListener('click', setVolume);

        function setVolume(e) {
            const rect = volumeSlider.getBoundingClientRect();
            const percent = (e.clientX - rect.left) / rect.width;
            volume = Math.max(0, Math.min(1, percent));
            video.volume = volume;
            volumeLevel.style.width = `${volume * 100}%`;

            if (volume === 0) {
                volumeIcon.className = 'bi bi-volume-mute-fill';
                isMuted = true;
            } else {
                volumeIcon.className = 'bi bi-volume-up-fill';
                isMuted = false;
            }
        }

        // نوار پیشرفت
        video.addEventListener('timeupdate', updateProgress);
        progressContainer.addEventListener('click', setProgress);

        function updateProgress() {
            const percent = (video.currentTime / video.duration) * 100;
            progressBar.style.width = `${percent}%`;

            // به روزرسانی زمان
            currentTimeEl.textContent = formatTime(video.currentTime);
            durationEl.textContent = formatTime(video.duration);
        }

        function setProgress(e) {
            const rect = progressContainer.getBoundingClientRect();
            const percent = (e.clientX - rect.left) / rect.width;
            video.currentTime = percent * video.duration;
        }

        // قالب زمان
        function formatTime(seconds) {
            let mins = Math.floor(seconds / 60);
            let secs = Math.floor(seconds % 60);
            return `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        }

        // تمام صفحه
        fullscreenBtn.addEventListener('click', toggleFullscreen);

        function toggleFullscreen() {
            if (!document.fullscreenElement) {
                video.parentElement.requestFullscreen().catch(err => {
                    console.log(`Error attempting to enable fullscreen: ${err.message}`);
                });
            } else {
                document.exitFullscreen();
            }
        }

        // جلوگیری از کلیک راست و ذخیره ویدیو
        video.addEventListener('contextmenu', function(e) {
            e.preventDefault();
            alert('امکان دانلود این ویدیو وجود ندارد.');
        });

        // جلوگیری از کشیدن ویدیو
        video.addEventListener('dragstart', function(e) {
            e.preventDefault();
        });
    </script>
@endsection
