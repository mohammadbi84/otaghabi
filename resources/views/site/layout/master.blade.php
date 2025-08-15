<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fbc05d3d5f.js" crossorigin="anonymous"></script>
    <!-- styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/Home-style.css') }}" />
    <!-- slider -->
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/slider.js') }}"></script>
    <!-- title -->
    <title>اتاق آبی</title>
    @yield('head')
    <!-- Floating Buttons -->
    <style>
        .floating-buttons {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 999;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .floating-buttons button {
            background-color: #19A7CE;
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .floating-buttons a {
            background: #833AB4;
            background: linear-gradient(141deg, rgba(131, 58, 180, 1) 0%, rgba(253, 29, 29, 1) 39%, rgba(252, 176, 69, 1) 100%);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .floating-buttons a:hover,
        .floating-buttons button:hover {
            background-color: #146C94;
        }
    </style>

</head>

<body style="direction: rtl">
    {{-- navbar --}}
    @include('site.layout.navbar')

    {{-- main --}}
    @yield('content')

    {{-- footer --}}
    @include('site.layout.footer')

    {{-- script --}}
    @yield('script')
    <div class="floating-buttons">
        <!-- Instagram -->
        <a href="https://instagram.com/YOUR_USERNAME" target="_blank" aria-label="Instagram">
            <i class="fab fa-instagram fs-5"></i>
        </a>

        <!-- Scroll to Top -->
        <button onclick="scrollToTop()" aria-label="Scroll to Top">
            <i class="fas fa-arrow-up fs-5"></i>
        </button>
    </div>
    <script>
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (Session::has('success'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                text: "{{ Session::get('success') }}",
                showConfirmButton: false,
                width: 400,
                timer: 2000,
            });
        </script>
    @endif
    @if (Session::has('fail'))
        <script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                text: "{{ Session::get('fail') }}",
                showConfirmButton: false,
                width: 400,
                timer: 2000,
            });
        </script>
    @endif
</body>

</html>
