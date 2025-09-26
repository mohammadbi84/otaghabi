@extends('dashboard.layout.master')
@php
    use Morilog\Jalali\Jalalian;
@endphp
{{-- title --}}
@section('title')
    <title>مدیریت سفارش</title>
@endsection

{{-- body --}}
@section('body')
    <!-- main  -->
    <div class="col">
        <!-- tarakonesh ha -->
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2">
                <h5 class="float-end">اطلاعات کاربر</h5>
                <!-- <a href="#" class="btn btn-danger float-start">افزودن کاربر جدید</a> -->
            </div>
            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>شماره موبایل</th>
                            <th>ایمیل</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $cart->user->name }}</td>
                            <td>{{ $cart->user->mobile }}</td>
                            <td>{{ $cart->user->email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2">
                <h5 class="float-end">لیست محصولات سفارش</h5>
                <!-- <a href="#" class="btn btn-danger float-start">افزودن کاربر جدید</a> -->
            </div>
            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>عکس محصول</th>
                            <th>نام محصول</th>
                            <th>قیمت در سبد خرید</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart->items as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ asset($item->item->cover) }}" alt="{{ $item->item->title }}" width="130px"></td>
                                <td>{{ $item->item->title }}</td>
                                <td>{{ number_format($item->price) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>جمع قیمت محصولات</th>
                            <th>جمع با تخفیف محصولات</th>
                            <th>سود کاربر از خرید</th>
                            <th>مبلغ پرداخت شده</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ number_format($cart->total_price) }}</td>
                            <td>{{ number_format($cart->final_price) }}</td>
                            <td>{{ number_format($cart->total_price - $cart->final_price)}}</td>
                            <td>{{ number_format($cart->final_price) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-12 mb-4 text-center">
                <h5 class="text-center">رسید پرداخت</h5>
                <img src="{{asset($cart->receipt)}}" alt="رسید پرداخت" class="w-50 rounded">
            </div>
            @if ($cart->status == 3)
            @elseif ($cart->status == 2)
            <div class="col-6">
                <form action="{{ route('orders.status', ['id' => $cart->id]) }}" method="post" class="text-center">
                    @csrf
                    <button class="btn btn-success w-100" name="status" value="3">تکمیل سفارش</button>
                </form>
            </div>
            <div class="col-6">
                <form action="{{ route('orders.status', ['id' => $cart->id]) }}" method="post" class="text-center">
                    @csrf
                    <button class="btn btn-danger w-100" name="status" value="4">رد سفارش</button>
                </form>
            </div>
            @elseif ($cart->status == 1)
            @endif

        </div>
    </div>
@endsection
