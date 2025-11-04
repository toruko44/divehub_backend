@extends('layout.user')

@section('content')
    <x-page-title-cloud title="記事編集" img_name="article" />

    <x-breadcrumb :items="[
        ['記事一覧', route('user.article.index')],
        ['記事編集', ''],
    ]" />

    <div class="relative bg-white mx-4 rounded-lg mb-10 p-6">
        <form action="{{ route('user.article.update',['article_id' => $article_report->id]) }}" method="POST" id="myForm" enctype="multipart/form-data" onkeydown="return preventFormSubmit(event)">
            @csrf
            @method('PUT')
            <input type="hidden" name="content" id="content">
            <input type="hidden" name="is_draft" id="is_draft" value="0">

            <div class="mb-4">
                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">タイトル</label>
                <input type="text" id="title" name="title" placeholder="記事タイトル" value="{{ (old('title',$article_report->title)) }}"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required onkeydown="return preventEnterSubmit(event)">
            </div>

            <div class="mb-4">
                <label for="thumbnail" class="block text-gray-700 text-sm font-bold mb-2">サムネイル画像</label>
                @if($article_report->image && $article_report->image->path)
                    <div class="mb-2">
                        <img src="{{ $article_report->image->path }}" alt="現在のサムネイル" class="w-32 h-20 object-cover rounded border">
                        <p class="text-sm text-gray-500 mt-1">現在のサムネイル画像</p>
                    </div>
                @endif
                <input type="file" id="thumbnail" name="thumbnail" accept="image/*" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                <p class="text-gray-500 text-xs mt-1">※ JPG、PNG、GIF形式の画像をアップロードできます（最大2MB）</p>
                @error('thumbnail')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="editor-js" class="block text-gray-700 text-sm font-bold mb-2">本文</label>
                <div id="editor-js" class="bg-gray-100 rounded-lg p-6 editor-js"></div>
            </div>

            <div class="flex justify-end space-x-4">
                <button id="draftButton" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded-lg">下書き保存</button>
                <button id="sendButton" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">記事を投稿する</button>
            </div>
        </form>
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
        const initialEditorData = @json($article_report->content ?? null);

        $(document).ready(function() {
            const imageQueue = [];

            // 保存ボタンのクリック処理
            $('#sendButton, #draftButton').click(function(e) {
                e.preventDefault();
                const isDraft = this.id === 'draftButton' ? 1 : 0;
                $('#is_draft').val(isDraft);

                editor.save().then((outputData) => {
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
                    console.error('エディタ保存中にエラーが発生しました:', error);
                });
            });

            // 画像のアップロード処理
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
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                uploadedImages.push({ url: result.file.url });
                            }
                        }).catch(error => console.error('画像アップロードエラー:', error));
                    });

                    Promise.all(promises).then(() => resolve(uploadedImages)).catch(reject);
                });
            }
        });
    </script>
@endsection
