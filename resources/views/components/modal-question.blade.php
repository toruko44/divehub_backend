@props(['tags', 'question', 'edit' => false])


<div class="fixed inset-0 z-10 overflow-y-auto hidden mt-16 md:mt-36" id="modal_question">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div
            class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <form action="{{ $edit ? route('user.question_box.update', $question->id) : route('user.question_box.store') }}" method="post" class="space-y-4" enctype="multipart/form-data">
                    @csrf
                    @if($edit)
                        @method('put')
                    @endif
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">タイトル</label>
                        <input type="text" id="title" name="title" value="{{ $edit ? old('title', $question->title) : old('title') }}" placeholder="タイトルを入力"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('title')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700">内容</label>
                        <textarea id="content" name="content" rows="4" placeholder="内容を入力"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ $edit ? old('content', $question->content) : old('content') }}</textarea>
                        @error('content')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="tag" class="block text-sm font-medium text-gray-700">タグ</label>
                        <select id="tag" name="tag"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">タグを選択してください</option>
                            @foreach ($tags as $value => $label)
                                <option value="{{ $value }}" {{ $edit ? (old('tag', $question->tag->id) == $value ? 'selected' : '') : (old('tag') == $value ? 'selected' : '') }}>
                                    {{ \App\Enums\TagType::from($label)->label() }}</option>
                            @endforeach
                        </select>
                        @error('tag')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">画像</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        @error('image')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ $edit ? '更新' : '送信' }}
                        </button>
                        <button type="button" id="closeModalButtonQuestion"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
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
        document.getElementById('openModalButtonQuestion').addEventListener('click', function() {
            document.getElementById('modal_question').classList.remove('hidden');
        });
    @else
        document.getElementById('openModalButtonQuestion').addEventListener('click', function() {
            window.location.href = "{{ route('user.login') }}";
        });
    @endif

    document.getElementById('closeModalButtonQuestion').addEventListener('click', function() {
        document.getElementById('modal_question').classList.add('hidden');
    });

    @if ($errors->any())
        document.getElementById('modal_question').classList.remove('hidden');
    @endif
</script>
