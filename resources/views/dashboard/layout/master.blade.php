<!DOCTYPE html>
<html lang="fa">

{{-- head --}}
@include('dashboard.layout.head')

<body dir="rtl">
    <div class="container-fluid">
        <div class="row">

            {{-- sidebar --}}
            @include('dashboard.layout.sidebar')
            <!-- main  -->
            @yield('body')
        </div>
    </div>
    {{-- @include('layout.footer') --}}

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
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mt-3 w-25">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('javaScript')
</body>

</html>
