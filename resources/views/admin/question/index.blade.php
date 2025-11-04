@extends('layout.admin')

@section('content')
    <?php
    $columns = [
        'title' => '質問タイトル',
        'content' => '質問内容',
        'tag_id' => '質問タグ',
        'user_name' => 'ユーザー名',
        'created_at' => '投稿日時',
        'actions' => '',
    ];
    ?>
    <?php
    $breadcrumb_items = [['質問管理', route('admin.question.index')]];
    ?>

    <x-admin-page-title>質問箱管理</x-admin-page-title>
    <x-admin-breadcrumb :items="$breadcrumb_items" />
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>質問一覧</x-card-title>

        <form method="GET" action="{{ route('admin.question.index') }}" class="m-5">
            <div class="flex items-end gap-2 flex-wrap m-2">
                <x-filter-input name="user_name" label="ユーザー名" placeholder="ユーザー名" />
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

        <x-table>
            <x-sort-table-thead :columns="$columns" />
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        @foreach ($columns as $key => $value)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($key === 'title')
                                    <a href="{{ route('admin.question.show', $item->id) }}"
                                        class="text-cyan-600 hover:text-cyan-400 truncate w-64 block"
                                        title="{{ $item->$key }}">{{ Str::limit($item->$key, 30, '...') }}</a>
                                @elseif ($key === 'content')
                                    <div class="truncate w-64" title="{{ $item->$key }}">{{ Str::limit($item->$key, 50, '...') }}</div>
                                @elseif ($key === 'tag_id')
                                    {{ \App\Enums\TagType::from($item->tag->name)->label() ?? '一般' }}
                                @elseif ($key === 'user_name')
                                    {{ $item->user->name }}
                                @elseif ($key === 'created_at')
                                    {{ $item->created_at->format('Y/m/d H:i') }}
                                @elseif ($key === 'actions')
                                    <div class="flex justify-center">
                                        <a href="{{ route('admin.question.edit', $item->id) }}"
                                            class="text-cyan-600 hover:text-cyan-400 mr-2">編集</a>
                                        <form method="POST" action="{{ route('admin.question.delete', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-400">削除</button>
                                        </form>
                                    </div>
                                @else
                                    {{ $item->$key }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </x-table>
        <x-pagination :items="$items" />
    </div>
@endsection
