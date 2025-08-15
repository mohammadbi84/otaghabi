@extends('dashboard.layout.master')

@section('title')
    <title>مقالات</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">مقالات</h5>
                <a type="btn" class="btn btn-danger float-start" href="{{ route('articles.create') }}">افزودن مقاله</a>
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>عکس</th>
                            <th>عنوان</th>
                            <th>دسته‌بندی</th>
                            <th>تعداد بازدید</th>
                            <th>نویسنده</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td class="align-middle">{{ $article->id }}</td>
                                <td class="align-middle">
                                    <img src="{{ asset($article->cover) }}" width="80px" alt="">
                                </td>
                                <td class="align-middle">{{ $article->title }}</td>
                                <td class="align-middle">{{ $article->category->title }}</td>
                                <td class="align-middle">{{ $article->view_count }}</td>
                                <td class="align-middle">{{ $article->author->name }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="text-success mx-1"><i
                                            class="fa-solid fa-pen-to-square"></i> ویرایش</a>
                                    <form action="{{ route('articles.destroy', $article->id) }}" method="POST"
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

            {{ $articles->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
