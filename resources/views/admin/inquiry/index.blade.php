@extends('layout.admin')

@section('content')
    <?php
    $columns = [
        'name' => 'ユーザー名',
        'message' => 'メッセージ',
        'created_at' => '登録日時',
        'actions' => '',
    ];
    ?>
    <?php
    $breadcrumb_items = [['お問い合わせ一覧', route('admin.inquiry.index')]];
    ?>
    <x-admin-page-title>お問い合わせ管理</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>お問い合わせ一覧</x-card-title>

        <div class="flex justify-between items-end gap-2 flex-wrap m-2">
            <form method="GET" action="{{ route('admin.inquiry.index') }}" class="m-5">
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
        </div>

        <x-table>
            <x-sort-table-thead :columns="$columns" />
            <tbody>
                @foreach ($inquiries as $inquiry)
                    <tr class="border-b border-gray-200">
                        @foreach ($columns as $key => $value)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($key === 'message')
                                    <a href="{{ route('admin.inquiry.show', $inquiry->id) }}" class="text-blue-500 hover:text-blue-700">{{ Str::limit($inquiry->$key, 50, '...') }}</a>
                                @elseif ($key === 'created_at')
                                    {{ $inquiry->created_at->format('Y-m-d') }}
                                @elseif ($key === 'actions')
                                    <form action="{{ route('admin.inquiry.delete', $inquiry->id) }}" method="POST" class="inline-block ml-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                                    </form>
                                @else
                                    {{ $inquiry->$key }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </x-table>
        <x-pagination :items="$inquiries" />
    </div>
@endsection
