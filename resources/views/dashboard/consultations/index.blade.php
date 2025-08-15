@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت نوبت‌های مشاوره</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">مدیریت نوبت‌های مشاوره</h5>
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>نام درخواست دهنده</th>
                            <th>موبایل</th>
                            <th>دسته‌بندی</th>
                            <th>مشاور</th>
                            <th>تاریخ درخواست</th>
                            <th>وضعیت</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($consultations as $consultation)
                            <tr>
                                <td class="align-middle">{{ $consultation->id }}</td>
                                <td class="align-middle">{{ $consultation->name }}</td>
                                <td class="align-middle">{{ $consultation->mobile }}</td>
                                <td class="align-middle">{{ $consultation->category->title ?? '--' }}</td>
                                <td class="align-middle">{{ $consultation->consultant->name ?? '--' }}</td>
                                <td class="align-middle">
                                    {{ Morilog\Jalali\Jalalian::forge($consultation->created_at)->format('Y/m/d H:i') }}
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('consultations.update-status', $consultation->id) }}"
                                        method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm"
                                            onchange="this.form.submit()">
                                            @foreach ($statuses as $key => $status)
                                                <option value="{{ $key }}"
                                                    {{ $consultation->status == $key ? 'selected' : '' }}>
                                                    {{ $status }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('consultations.destroy', $consultation->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link text-danger p-0 mx-1"
                                            onclick="return confirm('آیا از حذف این نوبت مطمئن هستید؟')">
                                            <i class="fa-regular fa-trash-can"></i> حذف
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $consultations->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
