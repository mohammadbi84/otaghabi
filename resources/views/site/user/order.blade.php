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
                <div class="row p-2 mx-1 rounded-4 shadow bg-white border">
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
                                        <td><img src="{{ asset($item->item->cover) }}" alt="{{ $item->item->title }}"
                                                width="130px"></td>
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
                                    <td>{{ number_format($cart->total_price - $cart->final_price) }}</td>
                                    <td>{{ number_format($cart->final_price) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-12 mb-4 text-center">
                        <h5 class="text-center">رسید پرداخت</h5>
                        <img src="{{ asset($cart->receipt) }}" alt="رسید پرداخت" class="w-50 rounded">
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
@endsection
