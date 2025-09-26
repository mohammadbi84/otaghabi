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
                <div class="row p-2 mx-1 mt-4 rounded-4 shadow bg-white border">
                    <div class="clearfix mt-2">
                        <h5 class="float-end">نوبت های من</h5>
                    </div>
                    <div class="table-responsive-sm">
                        <table class="table mt-2 text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>تاریخ</th>
                                    <th>مشاور</th>
                                    <th>حوزه مشاوره</th>
                                    <th>وضعیت</th>
                                    <!-- <th>عملیات</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (Auth::user()->consultationRequests as $key=>$request)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{ jdate($request->created_at)->format('Y/m/d') }}</td>
                                        <td>{{ $request->consultant?->name ?? '' }}</td>
                                        <td class="">{{ $request->category?->title ?? '' }}</td>
                                        <td class="">{{ $request->getStatusTextAttribute() }}</td>
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
