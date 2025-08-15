@extends('dashboard.layout.master')

@section('body')
<div class="col px-5">
    <div class="row mt-4 p-3 bg-white shadow rounded-4">
        <h4 class="mb-4">ایجاد کد تخفیف</h4>
        <form action="{{ route('coupons.store') }}" method="POST">
            @include('dashboard.coupons._form')
        </form>
    </div>
</div>
@endsection
