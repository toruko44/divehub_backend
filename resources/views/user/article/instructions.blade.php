@extends('layout.user')

@section('content')
    <x-page-title-cloud title="リッチエディタの使い方" img_name="article" />

    <x-breadcrumb :items="[['記事一覧', route('user.article.index')],
                           ['リッチエディタの使い方', route('user.article.instructions')]]"
    />

    <div class="bg-white mx-4 rounded-lg mb-10 p-6">
        <h2 class="text-2xl font-bold mb-4">リッチエディタの使い方</h2>

        <p class="mb-4 text-gray-700">
            このリッチエディタでは、記事作成時に簡単にテキストや画像、リスト、表などを追加できます。以下は主な機能の説明です。
        </p>

        <h3 class="text-xl font-semibold mb-2">基本操作</h3>
        <ul class="list-disc list-inside mb-6 text-gray-700">
            <li>ツールバーに表示されるアイコンをクリックして、各種ブロックを挿入できます。</li>
            <li>ドラッグ＆ドロップで、挿入したブロックの順序を簡単に変更可能です。</li>
            <li>各ブロックを選択すると、関連する編集オプションがツールバーに表示されます。</li>
        </ul>

        <h3 class="text-xl font-semibold mb-2">ツールの使い方</h3>

        <div class="mb-4">
            <h4 class="text-lg font-semibold">1. 見出し</h4>
            <p class="text-gray-700">「見出し」を選択すると、記事内の章や節に名前を付けることができます。見出しのレベルを変更するには、エディタ内でオプションを選んでください。</p>
        </div>

        <div class="mb-4">
            <h4 class="text-lg font-semibold">2. リスト</h4>
            <p class="text-gray-700">「リスト」ツールは、箇条書きや番号付きリストを作成するのに適しています。ボタンをクリックすると、リストが追加されます。数字を削除したいときはEnterで削除できます。</p>
        </div>

        <div class="mb-4">
            <h4 class="text-lg font-semibold">3. 表</h4>
            <p class="text-gray-700">「表」ツールを使うと、行や列を指定して表を挿入できます。数値やデータを整理する際に便利です。</p>
        </div>

        <div class="mb-4">
            <h4 class="text-lg font-semibold">4. 画像の追加</h4>
            <p class="text-gray-700">「画像」ツールで、画像ファイルをアップロードできます。5MB以下の画像のみ追加可能です。挿入した画像は自由に配置や削除が可能です。</p>
        </div>

        <div class="mb-4">
            <h4 class="text-lg font-semibold">5. 警告</h4>
            <p class="text-gray-700">「警告」ツールを使うと、注意点や重要な情報を強調表示できます。タイトルと内容を入力して使います。</p>
        </div>

        <h3 class="text-xl font-semibold mb-2">ツールバーの使い方</h3>
        <ul class="list-disc list-inside text-gray-700 mb-6">
            <li>「太字」「斜体」「リンク」などの装飾オプションがあり、テキストを強調したりリンクを追加できます。</li>
            <li>「引用」「コード」ブロックも追加可能で、引用文やコードの挿入に便利です。</li>
        </ul>

        <h3 class="text-xl font-semibold mb-2">保存方法</h3>
        <p class="text-gray-700 mb-4">
            作成した記事は「下書き保存」または「記事を投稿する」ボタンで保存できます。下書きは後から編集でき、投稿すると公開されます。
        </p>

        <div class="flex justify-end">
            <a href="{{ route('user.article.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                記事を作成する
            </a>
        </div>
    </div>
@endsection
