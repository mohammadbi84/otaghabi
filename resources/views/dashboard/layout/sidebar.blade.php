<nav class="navbar navbar-expand-sm bg-light shadow rounded-4">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">اتاق آبی</a>
        <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
        </div>
    </div>
</nav>


{{-- desktop sidebar --}}
<!-- sidebar -->
<div class="col-2 sidebar-col">
    <div class="row">
        <div class="sidebar pt-1 text-center">
            <p class="sidebar-item shadow sidebarmobilebtn">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="#" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'user.profile') color:#0b4cff; @endif">
                    <img src="" class="float-center mx-3" alt="profile" width="50px" />
                    <span class="">{{ Auth::user()->name }}</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('dashboard') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-house mx-3"></i>
                    <span class="text">خانه</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('categories.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'categories.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-clipboard-list mx-3"></i>
                    <span class="text">حوزه های مشاوره</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('psychologists.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'psychologists.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-users mx-3"></i>
                    <span class="text">متخصصان</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('articles.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'articles.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-newspaper mx-3"></i>
                    <span class="text">مقاله ها</span>
                </a>
            </p>
            {{-- <p class="sidebar-item shadow p-2">
                <a href="{{ route('coupons.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'coupons.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-clipboard-list mx-3"></i>
                    <span class="text">کد تخفیف</span>
                </a>
            </p> --}}
            <div class="card accordion-card">
                <div class="card-header rounded-4 bg-white">
                    <a class="btn d-flex justify-content-sm-between align-items-center w-100 accordion-link"
                        style="@if (Route::currentRouteName() == 'workshops.index' or Route::currentRouteName() == 'workshops.create') color:#0b4cff; @endif" data-bs-toggle="collapse"
                        href="#requests">
                        <span class="accordion-span1">
                            <i class="fa-solid fa-chalkboard-user ms-2"></i>
                            کارگاه های آموزشی
                        </span>
                        <span class="accordion-span2"><i class="fa-solid fa-angle-down"></i></span>
                    </a>
                </div>
                <div id="requests" class="collapse @if (Route::currentRouteName() == 'workshops.index' or Route::currentRouteName() == 'workshops.create') show @endif">
                    <div class="card-body accordion-card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('workshops.index') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'workshops.index') color:#0b4cff; @endif">
                                کارگاه ها
                            </a>
                            <a href="{{ route('workshops.create') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'workshops.create') color:#0b4cff; @endif">
                                کارگاه جدید
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card accordion-card">
                <div class="card-header rounded-4 bg-white">
                    <a class="btn d-flex justify-content-sm-between align-items-center w-100 accordion-link"
                        style="@if (Route::currentRouteName() == 'psychological-tests.index' or Route::currentRouteName() == 'user-tests.index') color:#0b4cff; @endif" data-bs-toggle="collapse"
                        href="#tests">
                        <span class="accordion-span1">
                            <i class="fa-solid fa-square-check ms-2"></i>
                            تست های روانشناختی
                        </span>
                        <span class="accordion-span2"><i class="fa-solid fa-angle-down"></i></span>
                    </a>
                </div>
                <div id="tests" class="collapse @if (Route::currentRouteName() == 'psychological-tests.index' or Route::currentRouteName() == 'user-tests.index') show @endif">
                    <div class="card-body accordion-card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('psychological-tests.index') }}"
                                class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'psychological-tests.index') color:#0b4cff; @endif">
                                لیست تست ها
                            </a>
                            <a href="{{ route('user-tests.index') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'user-tests.index') color:#0b4cff; @endif">
                                تست های در انتظار پاسخ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card accordion-card">
                <div class="card-header rounded-4 bg-white">
                    <a class="btn d-flex justify-content-sm-between align-items-center w-100 accordion-link"
                        style="@if (Route::currentRouteName() == 'sliders.index' or
                                Route::currentRouteName() == 'about.edit' or
                                Route::currentRouteName() == 'social-links.index' or
                                Route::currentRouteName() == 'settings.index') color:#0b4cff; @endif" data-bs-toggle="collapse"
                        href="#site">
                        <span class="accordion-span1">
                            <i class="fa-solid fa-sliders ms-2"></i>
                            پیکربندی سایت
                        </span>
                        <span class="accordion-span2"><i class="fa-solid fa-angle-down"></i></span>
                    </a>
                </div>
                <div id="site" class="collapse @if (Route::currentRouteName() == 'sliders.index' or
                        Route::currentRouteName() == 'about.edit' or
                        Route::currentRouteName() == 'social-links.index' or
                        Route::currentRouteName() == 'settings.index') show @endif">
                    <div class="card-body accordion-card-body">
                        <div class="list-group list-group-flush">
                            <a href="{{ route('settings.index') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'settings.index') color:#0b4cff; @endif">
                                مدیریت صفحه اصلی
                            </a>
                            <a href="{{ route('sliders.index') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'sliders.index') color:#0b4cff; @endif">
                                اسلایدر
                            </a>
                            <a href="{{ route('about.edit') }}" class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'about.edit') color:#0b4cff; @endif">
                                صفحه درباره ما
                            </a>
                            <a href="{{ route('social-links.index') }}"
                                class="list-group-item list-group-item-action"
                                style="@if (Route::currentRouteName() == 'social-links.index') color:#0b4cff; @endif">
                                شبکه های اجتماعی
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('consultations.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'consultations.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-clipboard-list mx-3"></i>
                    <span class="text">مدیریت نوبت ها</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('comments.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'comments.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-comment-dots mx-3"></i>
                    <span class="text">مدیریت نظرات</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('messages.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'messages.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-message mx-3"></i>
                    <span class="text">مدیریت پیام ها</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('users.index') }}" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'users.index') color:#0b4cff; @endif">
                    <i class="fa-solid fa-user mx-3"></i>
                    <span class="text">مدیریت کاربران</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="{{ route('logout') }}" class="d-flex justify-content-start align-items-center">
                    <i class="fa-solid fa-right-from-bracket mx-3" style="color: #e74b4b;"></i>
                    <span class="text text-danger">خروج</span>
                </a>
            </p>
        </div>
    </div>
</div>


{{-- mobile sidebar --}}
<!-- Offcanvas Sidebar -->
<div class="offcanvas offcanvas-end" id="demo">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="sidebarmobile w-100 pt-1 text-center">
            <p class="sidebar-item shadow sidebarmobilebtn">
                <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#demo">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="#" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'profile') color:#0b4cff; @endif">
                    <img src="" class="float-center mx-3" alt="profile" width="50px" />
                    <span class="">ادمین</span>
                </a>
            </p>
            <p class="sidebar-item shadow p-2">
                <a href="#" class="d-flex justify-content-start align-items-center"
                    style="@if (Route::currentRouteName() == 'home') color:#0b4cff; @endif">
                    <i class="fa-solid fa-house mx-3"></i>
                    <span class="text">خانه</span>
                </a>
            </p>
        </div>
    </div>
</div>
