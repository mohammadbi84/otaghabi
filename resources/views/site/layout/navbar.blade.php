@php
    $categories = App\Models\Category::all();
@endphp

<style>
    #search-results {
        max-width: 515px;
        max-height: 400px;
        overflow-y: auto;
    }

    #search-results a {
        text-decoration: none;
        color: #333;
        transition: background-color 0.2s;
    }

    #search-results a:hover {
        background-color: #f8f9fa;
    }
</style>
<!-- first row -->
<div class="px-3 pt-3 Jumbotron-div bg-white">
    <div class="container">
        <div class="row d-flex align-items-center">
            <!-- <div class="col-md-1"></div> -->
            <!-- logo -->
            <div class="col-md-2 pt-1 text-center">
                <a href="/" class="text-reset me-3">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="logo" width="100" />
                </a>
            </div>
            <!-- serch input -->
            <div class="col-md-7 pe-3 p-2 text-center position-relative">
                <form class="d-flex input-group w-75 my-auto mb-3 mb-md-0">
                    <div class="input-group search-group mx-auto">
                        <input type="text" id="search-input" class="form-control search-input" placeholder="...جستجو"
                            style="border-top-right-radius: 30px; border-bottom-right-radius: 30px; border-top-left-radius: 0px; border-bottom-left-radius: 0px;" />
                        <button class="btn search-btn border pt-2" type="submit"
                            style="border-top-left-radius: 30px; border-bottom-left-radius: 30px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;">
                            <i class="fa-solid fa-magnifying-glass fa-lg"></i>
                        </button>
                    </div>
                </form>
                <div id="search-results" class="position-absolute bg-white shadow rounded mt-1"
                    style="z-index: 1000; display: none; width: 85%; max-height: 500px; overflow-y: auto;"></div>
            </div>
            <!-- login adn cart -->
            <div class="col-md-3 p-2 text-right d-flex justify-content-center">
                <!-- login / logout -->
                @if (Auth::user())
                    <a class="btn login px-3 mx-2 bg-white" href="{{ route('user.profile') }}" role="button">
                        <i class="fa-regular fa-user ms-2"></i>
                        {{ Auth::user()->name ?? 'پروفایل' }}
                    </a>
                @else
                    <a class="btn login px-3 mx-2 bg-white" href="{{ route('login') }}" role="button">ورود | ثبت‌
                        نام</a>
                @endif
                <a href="{{ route('cart') }}" class="btn px-0 mx-2">
                    <img src="{{ asset('assets/images/cart.svg') }}" class="" alt="cart"
                        style="margin-top: 6px" width="25px" />
                </a>
                <!-- cart -->
            </div>
            <!-- <div class="col-md-1"></div> -->
        </div>
    </div>
</div>
<!-- nav bar -->
<nav class="navbar navbar-expand-sm sticky-top bg-white" style="z-index: 99">
    <div class="container px-5">
        <!-- logo -->
        <div class="navbar-brand logo">
            <a class="text-reset" href="/user/profile.html">
                <i class="fa-regular fa-circle-user fa-2xl"></i>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="/">
                        <i class="fa-solid fa-house fa-sm"></i>
                        صفحه اصلی</a>
                </li>
                <li class="nav-item home-nav-item dropdown navbar-dropdown">
                    <a class="nav-link" role="button" data-mdb-toggle="dropdown">
                        خدمات روانشناسی
                        <i class="fa-solid fa-chevron-down fa-2xs"></i>
                    </a>
                    <ul class="dropdown-menu navbar-dropdown-menu text-end">
                        @foreach ($categories as $category)
                            <li>
                                <a class="dropdown-item px-2 py-2"
                                    href="{{ route('psychologists', ['category' => $category]) }}">{{ $category->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item home-nav-item dropdown navbar-dropdown">
                    <a class="nav-link" role="button" data-mdb-toggle="dropdown">
                        متخصصان
                        <i class="fa-solid fa-chevron-down fa-2xs"></i>
                    </a>
                    <ul class="dropdown-menu navbar-dropdown-menu text-end">
                        <li>
                            <a class="dropdown-item px-2 py-2" href="{{ route('psychologists') }}">روانشناسان یزد</a>
                        </li>
                        <li>
                            <a class="dropdown-item px-2 py-2"
                                href="{{ route('psychologists', ['online' => true]) }}">روانشناسان آنلاین</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item home-nav-item dropdown navbar-dropdown">
                    <a class="nav-link" href="{{ route('workshops') }}" role="button">
                        دوره های آموزشی
                    </a>
                </li>
                <li class="nav-item home-nav-item dropdown navbar-dropdown">
                    <a class="nav-link" href="{{ route('tests') }}" role="button">
                        تست های روانشناختی
                    </a>
                </li>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="{{ route('blogs') }}">
                        مقالات
                    </a>
                </li>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="{{ route('about') }}">
                        درباره ما</a>
                </li>
                <li class="nav-item home-nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">
                        تماس با ما</a>
                </li>
                @if (Auth::user())
                    <li class="nav-item home-nav-item">
                        <a class="nav-link" href="#">
                            پروفایل</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#search-input').on('input', function() {
            let query = $(this).val();

            if (query.length >= 2) { // حداقل 2 کاراکتر برای جستجو
                $.ajax({
                    url: '/search',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        displayResults(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            } else {
                $('#search-results').hide();
            }
        });

        function displayResults(results) {
            let resultsContainer = $('#search-results');
            resultsContainer.empty();

            if (results.length === 0) {
                resultsContainer.append(`
            <div class="p-3 text-center text-muted">
                <i class="fas fa-search me-2"></i>
                نتیجه‌ای یافت نشد
            </div>
        `);
            } else {
                $.each(results, function(index, result) {
                    let item = '';
                    let typeBadge = '';
                    let imageUrl = result.image || result.cover || '/images/default-thumbnail.jpg';

                    // تعیین نوع محتوا و رنگ badge
                    switch (result.type) {
                        case 'article':
                            typeBadge = '<span class="badge bg-primary me-2">مقاله</span>';
                            break;
                        case 'category':
                            typeBadge = '<span class="badge bg-success me-2">دسته‌بندی</span>';
                            break;
                        case 'psychologicaltest':
                            typeBadge =
                                '<span class="badge bg-warning text-dark me-2">تست روانشناسی</span>';
                            break;
                        case 'user':
                            typeBadge = '<span class="badge bg-info text-dark me-2">روانشناس</span>';
                            break;
                    }

                    item = `
                <a href="${getItemUrl(result)}" class="d-block text-decoration-none text-dark">
                    <div class="row g-0 p-3 border-bottom hover-bg">
                        <div class="col-md-2 d-flex align-items-center">
                            <img src="${imageUrl}" class="img-fluid rounded" style="width: 80px; height: 80px; object-fit: cover;" alt="${result.title || result.name}">
                        </div>
                        <div class="col-md-10 d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">${result.title || result.name}</h6>
                                <div class="d-flex align-items-center">
                                    ${typeBadge}
                                    <small class="text-muted">${result.description ? result.description.substring(0, 60) + '...' : ''}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            `;

                    resultsContainer.append(item);
                });
            }

            resultsContainer.show();
        }

        // تابع برای ایجاد URL بر اساس نوع محتوا
        function getItemUrl(item) {
            switch (item.type) {
                case 'article':
                    return `/blogs/${item.id}`;
                case 'category':
                    return `/psychologists/${item.id}`;
                case 'psychologicaltest':
                    return `/tests/${item.id}`;
                case 'user':
                    return `/psychologists/${item.id}/profile`;
                default:
                    return '#';
            }
        }

        // مخفی کردن نتایج وقتی روی صفحه کلیک می‌شود
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search-input, #search-results').length) {
                $('#search-results').hide();
            }
        });
    });
</script>
