@extends('dashboard.layout.master')

{{-- title --}}
@section('title')
    <title>حوزه‌ها</title>
@endsection

{{-- body --}}
@section('body')
    <!-- main  -->
    <div class="col px-4">
        <!-- categories -->
        <div class="row mt-4 p-2 rounded-4 shadow bg-white">
            <div class="clearfix mt-2 mb-3">
                <h5 class="float-end">حوزه ها</h5>
                <a type="btn" class="btn btn-danger float-start" data-bs-toggle="modal"
                    data-bs-target="#addCategoryModal">افزودن حوزه</a>
                <!-- Modal -->
                <div class="modal fade" id="addCategoryModal">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <!-- Modal body -->
                            <div class="modal-body pt-0"><br>
                                <div class="clearfix">
                                    <h5 class="float-end">افزودن دسته بندی</h5>
                                </div>
                                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3 mt-3">
                                        <label for="title" class="form-label">عنوان حوزه :</label>
                                        <input type="text" class="form-control" id="title"
                                            placeholder="عنوان حوزه" name="title" value="{{ old('title') }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="short_description" class="form-label">توضیح کوتاه :</label>
                                        <textarea class="form-control" id="short_description" name="short_description" rows="2"
                                            placeholder="توضیح کوتاه بنویسید">{{ old('short_description') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="description" class="form-label">توضیح کامل :</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="توضیح کامل بنویسید">{{ old('description') }}</textarea>
                                    </div>


                                    <div class="mb-3">
                                        <label for="image" class="form-label">عکس حوزه :</label>
                                        <input type="file" class="form-control" id="image" name="image">
                                    </div>

                                    <div class="d-flex justify-content-center mt-4">
                                        <button type="submit" class="btn btn-danger w-25 align-middle">ذخیره</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Modal -->
            </div>

            <div class="table-responsive-sm">
                <table class="table mt-2 text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>عکس</th>
                            <th>عنوان</th>
                            <th>توضیح کوتاه</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="align-middle">{{ $category->id }}</td>
                                <td class="align-middle">
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" width="80px" alt="">
                                    @else
                                        --
                                    @endif
                                </td>
                                <td class="align-middle">{{ $category->title }}</td>
                                <td class="align-middle">{{ $category->short_description }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-success mx-1"><i
                                            class="fa-solid fa-pen-to-square"></i> ویرایش</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
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

            <!-- pagination -->
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection
@section('javaScript')
    <!-- Summernote JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'توضیح کامل بنویسید...',
                tabsize: 2,
                height: 200
            });
        });
    </script>
@endsection
