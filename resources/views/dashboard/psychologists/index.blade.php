@extends('dashboard.layout.master')

@section('title')
    <title>لیست روانشناسان</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">لیست روانشناسان</h5>
                <a href="{{ route('psychologists.create') }}" class="btn btn-danger float-start">افزودن روانشناس</a>
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام</th>
                            <th>شهر</th>
                            <th>مدرک</th>
                            <th>مشاوره آنلاین</th>
                            <th>حوزه‌ها</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($psychologists as $psychologist)
                            <tr>
                                <td class="align-middle">{{ $psychologist->id }}</td>
                                <td class="align-middle">{{ $psychologist->name }}</td>
                                <td class="align-middle">{{ $psychologist->city->title ?? '--' }}</td>
                                <td class="align-middle">{{ $psychologist->degree }}</td>
                                <td class="align-middle">
                                    {{ $psychologist->online_consultation ? 'دارد' : 'ندارد' }}
                                </td>
                                <td class="align-middle">
                                    @foreach ($psychologist->categories as $category)
                                        <span class="badge bg-primary">{{ $category->title }}</span>
                                    @endforeach
                                </td>
                                <td class="align-middle">
                                    <a href="{{ route('psychologists.edit', $psychologist->id) }}" class="text-success mx-1">
                                        <i class="fa-solid fa-pen-to-square"></i> ویرایش
                                    </a>
                                    <form action="{{ route('psychologists.destroy', $psychologist->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1">
                                            <i class="fa-regular fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $psychologists->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
