@extends('site.layout.master')
@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
    <title>ویرایش پروفایل</title>
@endsection
@section('content')
    <!-- main -->
    <div class="container">
        <div class="row mt-4">
            @include('site.user.layout.sidebar')

            <!-- left content -->
            <div class="col">
                <!-- oreders -->
                <div class="row p-2 mx-1 rounded-4 shadow bg-white border">
                    <div class="clearfix mt-2">
                        <h5 class="float-end">نوبت های من</h5>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>کاربر</th>
                                    <th>قیمت نهایی</th>
                                    <th>وضعیت</th>
                                    <th>تاریخ ثبت</th>
                                    {{-- <th>کد تخفیف</th> --}}
                                    <th>عملیات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $key => $cart)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $cart->user->name }}</td>
                                        <td>{{ number_format($cart->final_price) }} تومان</td>
                                        @if ($cart->status == 3)
                                            <td class="text-success">تکمیل شده</td>
                                        @elseif ($cart->status == 2)
                                            <td class="text-primary">در انتظار تایید</td>
                                        @elseif ($cart->status == 1)
                                            <td class="text-warning">در انتظار پرداخت</td>
                                        @elseif ($cart->status == 4)
                                            <td class="text-danger">رد شده</td>
                                        @endif
                                        <td>{{ jdate($cart->updated_at)->format('Y/m/d h:i') }}</td>
                                        {{-- <td>{{ $cart->discount_code->code ?? '--' }}</td> --}}
                                        <td>
                                            <a href="{{ route('user.orders.show', ['id' => $cart->id]) }}"
                                                class="text-primary mx-1"><i class="fa-solid fa-eye"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
