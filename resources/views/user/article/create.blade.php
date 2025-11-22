@extends('layout.user')

@section('content')
    <x-page-title-cloud title="記事作成" img_name="article" />

    <x-breadcrumb :items="[
        ['記事一覧', route('user.article.index')],
        ['記事作成', ''],
    ]" />

    <!-- Content Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="relative bg-white rounded-lg shadow mb-10 p-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 space-y-4 md:space-y-0">
            <div id="template-selector" class="flex flex-col md:flex-row items-start md:items-center space-y-2 md:space-y-0 md:space-x-4">
                <select
                    id="templateDropdown"
                    class="border-gray-300 rounded-md shadow-sm p-2 w-full md:w-auto">
                    <option value="" disabled selected>テンプレートを選択</option>
                    <option value="diving-log">ダイビングログ</option>
                    <option value="diving-trip">旅行レポート</option>
                    <option value="creature-introduction">生き物紹介</option>
                </select>
                <button
                    id="applyTemplateButton"
                    class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-md w-full md:w-auto text-center shadow-sm hover:bg-blue-600 transition">
                    テンプレートを適用
                </button>
            </div>
            <div>
                <a
                    href="{{ route('user.article.instructions') }}"
                    class="text-blue-700 hover:text-blue-900 hover:underline block text-center md:text-right">
                    リッチエディタの使い方を見る
                </a>
            </div>
        </div>



        <form action="{{ route('user.article.store') }}" method="POST" id="myForm" enctype="multipart/form-data" onkeydown="return preventFormSubmit(event)">
            @csrf
            <input type="hidden" name="content" id="content">
            <input type="hidden" name="is_draft" id="is_draft" value="0">

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル</label>
                <input type="text" id="title" name="title" placeholder="記事タイトル" value="{{ old('title') }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required onkeydown="return preventEnterSubmit(event)">
                @error('title')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-700 text-sm font-bold mb-2">サムネイル画像</label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-gray-500 text-xs mt-1">※ JPG、PNG、GIF形式の画像をアップロードできます（最大2MB）</p>
                @error('thumbnail')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <script>
                const initialEditorData = @json(old('content', '{}'));
            </script>
            <div class="mb-4">
                <label for="editor-js" class="block text-gray-700 text-sm font-bold mb-2">本文</label>
                <div id="editor-js" class="bg-gray-100 rounded-lg p-6 editor-js"></div>
            </div>

            <div class="flex justify-end space-x-4">
                <button id="draftButton" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-1 px-2 md:py-2 md:px-4 rounded-lg text-sm">下書き保存</button>
                <button id="sendButton" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-1 px-2 md:py-2 md:px-4 rounded-lg text-sm">記事を投稿する</button>
            </div>
        </form>
    </div>
</div>

    @vite('resources/js/editorjs.js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Enterキーでのフォーム送信を防止する関数
    function preventEnterSubmit(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            event.preventDefault();
            return false;
        }
        return true;
    }

    // フォーム全体でのEnterキー送信を防止（ボタン以外）
    function preventFormSubmit(event) {
        if (event.key === 'Enter' || event.keyCode === 13) {
            // ボタン要素の場合は通常の動作を許可
            if (event.target.tagName === 'BUTTON') {
                return true;
            }
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>

<script>
    $(document).ready(function() {
        const imageQueue = [];

        $('#sendButton, #draftButton').click(function(e) {
            e.preventDefault();

            const isDraft = this.id === 'draftButton' ? 1 : 0;
            $('#is_draft').val(isDraft);

            window.editor.save().then((outputData) => {

                if (imageQueue.length > 0) {
                    uploadImages().then((uploadedImages) => {
                        uploadedImages.forEach((imageData, index) => {
                            if (outputData.blocks[index].type === 'image') {
                                outputData.blocks[index].data.file.url = imageData.url;
                            }
                        });

                        $('#content').val(JSON.stringify(outputData));
                        $('#myForm').off('submit').submit();
                    }).catch((error) => {
                        $('#myForm').off('submit').submit();
                    });
                } else {
                    $('#content').val(JSON.stringify(outputData));
                    $('#myForm').off('submit').submit();
                }

            }).catch((error) => {
            });
        });

        function uploadImages() {
            return new Promise((resolve, reject) => {
                const uploadedImages = [];
                const promises = imageQueue.map((image) => {
                    const formData = new FormData();
                    formData.append('image', image.file);

                    return fetch('/user/article/uploadImage', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(result => {
                        if (result.success) {
                            uploadedImages.push({ url: result.file.url });
                        }
                    })
                    .catch(error => {
                    });
                });

                Promise.all(promises).then(() => {
                    resolve(uploadedImages);
                }).catch(error => {
                    reject(error);
                });
            });
        }
    });
</script>



@endsection
