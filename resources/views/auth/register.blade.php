<!DOCTYPE html>
<html lang="en">

<head>
    <title>ثبت نام</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fbc05d3d5f.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        a {
            text-decoration: none;
        }

        .alert {
            top: 20px;
            right: 50px;
            position: absolute;
        }

        body {
            direction: rtl;
            text-align: right;
            background-color: #218DCD;
        }

        .form {
            max-width: 400px;
            /* max-height: 440px; */
            background: white;
            /* backdrop-filter: blur(30px); */
        }

        span {
            font-size: 14px
        }

        .btn {
            background-color: #146C94;
            border: 2px solid #146C94;
            color: #ffffff;
        }

        .btn:hover {
            background-color: #248fc1;
            border: 2px solid #146C94;
            color: #ffffff;
            /* border: 2px solid #146C94;
            color: #146C94; */
        }

        label {
            right: 0px !important;
        }

        input:focus+label {
            right: -50px !important;
        }

        input:valid+label {
            right: -50px !important;
        }
    </style>
</head>

<body>
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
    <div class="container p-3">
        <div class="d-flex align-items-center justify-content-center min-vh-100">
            <form action="{{ route('register') }}" class="text-center form p-4 border shadow rounded-4" method="post"
                autocomplete="off">
                @CSRF
                <div class="clearfix">
                    <div class="float-end">
                        <a href="/" class="text-reset back"><i class="fa-solid fa-chevron-right"></i> بازگشت </a>
                    </div>
                    <div class="float-start">
                        {{-- <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo.jpg') }}"
                                class="w-50 mt-4" alt=""></a> --}}
                    </div>
                </div>

                <h3 class="mb-3 mt-3">ثبت نام</h3>
                <!-- inputs -->
                <div class="row mt-3 text-end">
                    <!-- name -->
                    <div class="col-md-12 mt-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" id="name" placeholder="Enter name"
                                name="name" value="{{ old('name') }}" required>
                            <label for="name">نام کاربری</label>
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <!-- phone -->
                    <div class="col-md-12 mt-2">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" id="mobile"
                                placeholder="Enter phone number" name="mobile" value="{{ old('mobile') }}" required>
                            <label for="mobile">شماره موبایل </label>
                            @error('mobile')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>
                    {{-- email --}}
                    {{-- <div class="col-md-6 mt-2">
                        <label for="email" class="form-label">ایمیل :</label>
                        <input type="email" class="form-control" id="email" placeholder="example@gmail.com"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div> --}}
                    <!-- password -->
                    <div class="col-md-12 mt-2">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-4" id="password"
                                placeholder="Enter password" name="password" required>
                            <label for="password">رمز ورود </label>
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn mt-5 rounded-3 w-100">
                    ثبت نام
                </button>
                <span class="text-dark">اکانت دارید؟<a href="{{ route('login') }}"
                        class="text-reset mx-3">ورود</a></span>
                <p class="form-p mt-2">ورود شما به معنای پذیرش شرایط سایت و قوانین حریم خصوصی است</p>
            </form>
        </div>
    </div>
</body>

</html>
