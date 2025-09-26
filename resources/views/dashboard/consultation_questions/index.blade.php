@extends('dashboard.layout.master')

@section('title')
    <title>مدیریت سوالات مشاوره</title>
@endsection

@section('body')
    <div class="col px-4">
        <div class="row mt-4 p-4 rounded-4 shadow bg-white">
            <h5>مدیریت سوالات مشاوره</h5>

            <form action="{{ route('consultation-questions.bulkUpdate') }}" method="POST" id="questionsForm">
                @csrf

                <div id="questions-container" class="mt-3">
                    @foreach ($questions as $question)
                        <div class="input-group mb-3 question-item" data-id="{{ $question->id }}">
                            <input type="hidden" name="questions[{{ $loop->index }}][id]" value="{{ $question->id }}">
                            <input type="text" class="form-control" name="questions[{{ $loop->index }}][question]"
                                value="{{ $question->question }}" placeholder="متن سوال">
                            <button type="button" class="btn btn-outline-danger remove-question"
                                data-id="{{ $question->id }}">
                                حذف
                            </button>
                        </div>
                    @endforeach
                </div>


                <div class="mb-3">
                    <button type="button" id="addQuestionBtn" class="btn btn-outline-primary">
                        افزودن سوال جدید
                    </button>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary w-25">ذخیره</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javaScript')
    <script>
        let questionIndex = {{ $questions->count() }};

        // افزودن سوال جدید
        document.getElementById('addQuestionBtn').addEventListener('click', function() {
            let container = document.getElementById('questions-container');
            let div = document.createElement('div');
            div.classList.add('input-group', 'mb-3', 'question-item');
            div.innerHTML = `
            <input type="hidden" name="questions[${questionIndex}][id]" value="">
            <input type="text" class="form-control" name="questions[${questionIndex}][question]" placeholder="متن سوال جدید">
            <button type="button" class="btn btn-outline-danger remove-question">حذف</button>
        `;
            container.appendChild(div);
            questionIndex++;
        });

        // حذف سوال با Ajax
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-question')) {
                let questionId = e.target.getAttribute('data-id');
                let item = e.target.closest('.question-item');

                // اگر سوال جدید بود (id نداشت)
                if (!questionId) {
                    item.remove();
                    return;
                }

                if (confirm('آیا مطمئن هستید که می‌خواهید این سوال را حذف کنید؟')) {
                    fetch("{{ route('consultation-questions.destroy', '') }}/" + questionId, {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Content-Type": "application/json"
                            },
                            body: JSON.stringify({
                                _method: "DELETE"
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                item.remove();
                            } else {
                                alert('خطا در حذف سوال');
                            }
                        })
                        .catch(err => {
                            console.error(err);
                            alert('خطا در ارتباط با سرور');
                        });
                }
            }
        });
    </script>
@endsection
