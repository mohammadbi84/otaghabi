{{-- index.blade.php --}}
@extends('dashboard.layout.master')

@section('title')
    <title>لیست کارگاه‌ها</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">لیست کارگاه‌ها</h5>
                <a href="{{ route('workshops.create') }}" class="btn btn-danger float-start">افزودن کارگاه</a>
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>کاور</th>
                            <th>عنوان</th>
                            <th>استاد</th>
                            <th>نوع برگزاری</th>
                            <th>قیمت نهایی</th>
                            <th>تعداد شرکت کننده</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($workshops as $workshop)
                            <tr>
                                <td>{{ $workshop->id }}</td>
                                <td>
                                    @if ($workshop->cover)
                                        <img src="{{ asset($workshop->cover) }}" width="80px" alt="">
                                    @else
                                        --
                                    @endif
                                </td>
                                <td>{{ $workshop->title }}</td>
                                <td>{{ $workshop->teacher->name }}</td>
                                <td>
                                    @switch($workshop->type)
                                        @case('online')
                                            آنلاین
                                        @break

                                        @case('offline')
                                            آفلاین
                                        @break

                                        @case('in_person')
                                            حضوری
                                        @break
                                    @endswitch
                                </td>
                                <td>{{ number_format($workshop->final_price) }} تومان</td>
                                <td>{{ $workshop->participants_count }} نفر</td>
                                <td>
                                    <a href="{{ route('workshops.edit', $workshop->id) }}" class="text-success mx-1"><i
                                            class="fa-solid fa-pen-to-square"></i> ویرایش</a>
                                    <form action="{{ route('workshops.destroy', $workshop->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1"><i
                                                class="fa-regular fa-trash-can"></i> حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $workshops->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('javaScript')
@endsection
