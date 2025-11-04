@props(['question', 'answer', 'edit' => false])
<div class="fixed inset-0 z-10 overflow-y-auto hidden mt-16 md:mt-36" id="modal_answer">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form action="{{ $edit ? route('user.answer.update', ['answer_id' => $answer->id]) : route('user.question_box.answer', ['question_id' => $question->id]) }}" method="post" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @if($edit)
                        @method('put')
                    @endif
                        <div>
                            <label for="content" class="block text-sm font-medium text-gray-700">回答</label>
                            <textarea id="content" name="content" rows="4" placeholder="回答を入力"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $edit ? old('content', $answer->content) : old('content') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ $edit ? '更新' : '送信' }}
                            </button>
                            <button type="button" id="closeAnswerModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                閉じる
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    @if (Auth::check())
        document.getElementById('openAnswerModalButton').addEventListener('click', function() {
            document.getElementById('modal_answer').classList.remove('hidden');
        });
    @else
        document.getElementById('openAnswerModalButton').addEventListener('click', function() {
            window.location.href = "{{ route('user.login') }}";
        });
    @endif

    document.getElementById('closeAnswerModalButton').addEventListener('click', function() {
        document.getElementById('modal_answer').classList.add('hidden');
    });

    @if ($errors->any())
        document.getElementById('modal_answer').classList.remove('hidden');
    @endif
</script>
