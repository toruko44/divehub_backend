@extends('layout.admin')

@section('content')
    <?php
    $columns = [
        'title' => 'タイトル',
        'content' => '内容',
        'created_at' => '登録日時',
        'actions' => '',
    ];
    ?>
    <?php
    $breadcrumb_items = [['お知らせ管理', route('admin.news.index')]];
    ?>
    <x-admin-page-title>お知らせ管理</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>お知らせ一覧</x-card-title>

        <div class="flex justify-between items-end gap-2 flex-wrap m-2">
            <form method="GET" action="{{ route('admin.answer.index') }}" class="m-5">
                <div class="flex items-end gap-2 flex-wrap m-2">
                    <x-filter-input name="keyword" label="キーワード" placeholder="キーワード" />
                </div>
                <div class="flex items-end gap-2 flex-wrap m-2">
                    <x-filter-input name="created_at_start" label="投稿日時" type="datetime-local" />
                    <span class="item-center mb-6">~</span>
                    <x-filter-input name="created_at_end" label="" type="datetime-local" />
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-200 mb-4">
                        検索
                    </button>
                </div>
            </form>
            <div class="flex items-center mb-5">
                <a href="{{ route('admin.news.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-200 mb-4">
                    お知らせ作成
                </a>
            </div>
        </div>

        <x-table>
            <x-sort-table-thead :columns="$columns" />
            <tbody>
                @foreach ($news_items as $news_item)
                    <tr class="border-b border-gray-200">
                        @foreach ($columns as $key => $value)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($key === 'title')
                                    <a href="{{ route('admin.news.show', $news_item->id) }}" class="text-blue-500 hover:text-blue-700">{{ Str::limit($news_item->$key, 50, '...') }}</a>
                                @elseif ($key === 'created_at')
                                    {{ $news_item->created_at->format('Y-m-d') }}
                                @elseif ($key === 'actions')
                                    <a href="{{ route('admin.news.edit', $news_item->id) }}" class="text-blue-500 hover:text-blue-700 ml-4">編集</a>
                                    <form action="{{ route('admin.news.delete', $news_item->id) }}" method="POST" class="inline-block ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                                    </form>
                                    @elseif ($key === 'content')
                                    <div class="truncate w-64" title="{{ $news_item->$key }}">{{ Str::limit($news_item->$key, 70, '...') }}</div>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </x-table>
        <x-pagination :items="$news_items" />
    </div>
@endsection
