@extends('site.layout.master')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/css/cart-style.css') }}" />
    <title>سبد خرید</title>
@endsection

@section('content')
    <div class="container">
        <div class="row mt-3">
            <!-- products -->
            <div class="col products-col border rounded-4 bg-white shadow">
                <header
                    class="page-header d-flex flex-wrap justify-content-between align-items-center pt-3 mb-2 border-bottom border-2">
                    <h1 class="me-3">سبد خرید</h1>
                </header>

                @forelse ($cart->items as $item)
                    @php
                        $product = $item->item;
                        $type = class_basename($item->item_type); // برای بررسی نوع
                    @endphp
                    <div class="row p-2 border-bottom">
                        <div class="col img-col d-flex">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="product-img w-100"
                                        src="{{ asset($product->cover ?? 'images/default.png') }}" alt="product" />
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group pe-0 pb-2">
                                        <li class="list-group-item text-muted">
                                            <h5 class="mt-3 pb-2 px-2" style="font-size: 22px">
                                                {{ $product->title ?? 'بدون عنوان' }}
                                            </h5>
                                        </li>
                                        @if ($type === 'Workshop')
                                            <li class="list-group-item text-muted">
                                                @if ($product->type == 'offline')
                                                    آفلاین
                                                @elseif ($product->type == 'online')
                                                    آنلاین
                                                @else
                                                    حضوری
                                                @endif
                                            </li>
                                            <li class="list-group-item text-muted">{{ $product->age_group }}</li>
                                        @endif

                                        <h5 class="mt-4 me-3">
                                            @if ($product->discount > 0)
                                                <small
                                                    class="text-danger"><del>{{ number_format($product->price) }}</del><span
                                                        class="badge bg-danger mx-2">{{ (($product->price - $product->final_price) * 100) / $product->price }}%</span></small>
                                                {{ number_format($product->final_price) }} تومان
                                            @else
                                                {{ number_format($product->final_price) }} تومان
                                            @endif
                                        </h5>
                                    </ul>
                                </div>
                                <div class="col-md-2 p-3 text-start">
                                    <form action="{{ route('cart.item.remove', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-outline-danger p-1 px-2 pt-2">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 text-center text-muted">سبد خرید شما خالی است.</div>
                @endforelse
            </div>

            <!-- summary -->
            <div class="col-md-3 mt-4 filter-col">
                <div class="sidebar border rounded-4 p-2 px-4 pb-3 text-center shadow bg-white">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td class="text-end">قیمت کالاها</td>
                                <td class="text-start">
                                    {{ number_format($cart->items->sum(fn($i) => $i->item->price ?? 0)) }}
                                    <span style="font-size: 12px">تومان</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-end">جمع سبد خرید</td>
                                <td class="text-start">
                                    {{ number_format($cart->items->sum(fn($i) => $i->item->final_price ?? 0)) }}
                                    <span style="font-size: 12px">تومان</span>
                                </td>
                            </tr>
                            <tr class="text-danger">
                                <td class="text-end text-danger">سود شما از خرید</td>
                                <td class="text-start text-danger">
                                    {{ number_format($cart->items->sum(fn($i) => $i->item->discount ?? 0)) }}
                                    <span style="font-size: 12px">تومان</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="{{ route('cart.checkout') }}" class="btn btn-blue w-100" style="height: 40px">تایید و تکمیل
                        سفارش</a>
                </div>
            </div>
        </div>
    </div>
@endsection
