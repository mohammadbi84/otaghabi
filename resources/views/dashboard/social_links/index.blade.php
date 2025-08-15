@extends('dashboard.layout.master')

@section('title')
    <title>شبکه‌های اجتماعی</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-4 bg-white shadow rounded-4">
            <h5>شبکه‌های اجتماعی</h5>

            <form action="{{ route('social-links.bulkUpdate') }}" method="POST">
                @csrf

                <div id="social-links-wrapper">
                    @foreach ($links as $index => $link)
                        <div class="row mb-2 social-link-row">
                            <input type="hidden" name="links[{{ $index }}][id]" value="{{ $link->id }}">
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="links[{{ $index }}][platform]"
                                    value="{{ $link->platform }}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="links[{{ $index }}][url]"
                                    value="{{ $link->url }}">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger btn-sm remove-row"
                                    onclick="removeSocialRow(this, {{ $link->id }})">حذف</button>
                            </div>
                        </div>
                    @endforeach

                    <!-- Hidden input to collect deleted IDs -->
                    <input type="hidden" id="deleted_ids" name="deleted_ids" value="">

                </div>

                <button type="button" class="btn btn-success btn-sm mb-3" id="add-row">+ افزودن شبکه جدید</button>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary w-25">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <script>
        let index = {{ count($links) }};
        document.getElementById('add-row').addEventListener('click', function() {
            const wrapper = document.getElementById('social-links-wrapper');

            const row = document.createElement('div');
            row.className = 'row mb-2 social-link-row';

            row.innerHTML = `
            <div class="col-md-5">
                <input type="text" class="form-control" name="links[${index}][platform]" placeholder="مثلاً linkedin">
            </div>
            <div class="col-md-5">
                <input type="text" class="form-control" name="links[${index}][url]" placeholder="لینک">
            </div>
            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove-row">حذف</button>
            </div>
        `;

            wrapper.appendChild(row);
            index++;
        });

        // document.addEventListener('click', function(e) {
        //     if (e.target.classList.contains('remove-row')) {
        //         e.target.closest('.social-link-row').remove();
        //     }
        // });
    </script>
    <script>
        function removeSocialRow(button, id) {
            if (id) {
                let deletedInput = document.getElementById('deleted_ids');
                let current = deletedInput.value ? deletedInput.value.split(',') : [];
                current.push(id);
                deletedInput.value = current.join(',');
            }

            button.closest('.social-link-row').remove();
        }
    </script>
@endsection
