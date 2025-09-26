<!-- moshakhasat -->
<div class="col-md-3 filter-col">
    <div class="sidebar text-center pb-2 shadow border">
        <img src="{{ asset(Auth::user()->image ?? 'assets/images/user.svg') }}" class="mb-2" width="70px"
            alt="profile">
        <p class="mb-1 text-muted">{{ Auth::user()->name }}</p>
        <p class="mb-1 text-muted">{{ Auth::user()->mobile }}</p>
        <p class="mb-1 text-muted">{{ Auth::user()->email }}</p>
        <div class="list-group text-end mt-2 rounded-0">
            <a href="{{ route('user.profile') }}"
                class="list-group-item list-group-item-action
                            @if (Route::currentRouteName() == 'user.profile') border-end border-4 border-DarkBlue @endif ">
                <i class="fa-solid fa-house-user"></i>
                داشبورد
            </a>
            <a href="{{ route('user.edit') }}"
                class="list-group-item list-group-item-action
                            @if (Route::currentRouteName() == 'user.edit') border-end border-4 border-DarkBlue @endif">
                <i class="fa-solid fa-circle-user"></i>
                اطلاعات حساب
            </a>
            <a href="{{ route('user.orders') }}"
                class="list-group-item list-group-item-action
                            @if (Route::currentRouteName() == 'user.orders') border-end border-4 border-DarkBlue @endif">
                <i class="fa-solid fa-cart-shopping"></i>
                سفارشات من
            </a>
            <a href="{{ route('user.requests') }}"
                class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.requests') border-end border-4 border-DarkBlue @endif">
                <i class="fa-solid fa-circle-check"></i>
                نوبت های من
            </a>
            <a href="{{ route('user.workshops') }}"
                class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.workshops') border-end border-4 border-DarkBlue @endif">
                <i class="fa-solid fa-circle-check"></i>
                کارگاه های آموزشی من
            </a>
            <a href="{{ route('user.tests') }}"
                class="list-group-item list-group-item-action
                        @if (Route::currentRouteName() == 'user.tests') border-end border-4 border-DarkBlue @endif">
                <i class="fa-solid fa-circle-check"></i>
                تست های من
            </a>
            <a href="{{ route('logout') }}" class="list-group-item list-group-item-action">
                <i class="fa-solid fa-right-from-bracket"></i>
                خروج
            </a>
        </div>
    </div>
</div>
