<!DOCTYPE html>
<html lang="en">

<head>
    <title>ورود</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/fbc05d3d5f.js" crossorigin="anonymous"></script>
    {{-- sweet alert --}}
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
            max-height: 580px;
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
    <div class="container">
        <div class="d-flex align-items-center justify-content-center min-vh-100">
            <form action="{{route('signin')}}" method="post" class="text-center form p-4 border shadow rounded-4">
                @csrf
                 <div class="clearfix">
                    <div class="float-end">
                        <a href="/" class="text-reset back"><i class="fa-solid fa-chevron-right"></i> بازگشت </a>
                    </div>
                    <div class="float-start">
                        {{-- <a href="{{ route('dashboard') }}"><img src="{{ asset('assets/images/logo.jpg') }}"
                                class="w-50 mt-4" alt=""></a> --}}
                    </div>
                </div>
                <h3 class="mt-3">ورود</h3>
                <!-- phone number -->
                <p class="form-p mb-2 mt-4 pb-0 ">لطفا شماره موبایل خود را وارد کنید</p>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control rounded-4" id="mobile" placeholder="Enter phone number"
                        name="mobile" required>
                    <label for="mobile">شماره موبایل </label>
                    @error('mobile')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control rounded-4" id="password" placeholder="Enter password"
                        name="password" required>
                    <label for="password">رمز ورود </label>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <button type="submit" class="btn mt-3 mb-2 border py-2 rounded-3 w-100">
                    ورود
                </button>
                <span class="">هنوز ثبت نام نکردید؟<a href="{{ route('signup') }}" class="mx-3">ثبت
                        نام</a></span>
                <p class="form-p mt-2">ورود شما به معنای پذیرش شرایط سایت و قوانین حریم خصوصی است</p>
            </form>
        </div>
    </div>

    {{-- sweet alert --}}
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
