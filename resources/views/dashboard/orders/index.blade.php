@extends('dashboard.layout.master')
@php
    use Morilog\Jalali\Jalalian;
@endphp
{{-- title --}}
@section('title')
    <title>سفارش ها</title>
@endsection

{{-- body --}}
@section('body')
    <!-- main  -->
    <div class="col">
        <!-- tarakonesh ha -->
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2">
                <h5 class="float-end">سفارش ها</h5>
                <!-- <a href="#" class="btn btn-danger float-start">افزودن کاربر جدید</a> -->
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
                                    <a href="{{ route('orders.show', ['id' => $cart->id]) }}" class="text-primary mx-1"><i
                                            class="fa-solid fa-eye"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $carts->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
