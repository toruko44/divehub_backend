@extends('layout.admin')

@section('content')
    <?php
    $columns = [
        'name' => 'ユーザー名',
        'email' => 'メールアドレス',
        'license' => 'ライセンス',
        'created_at' => '登録日時',
        'actions' => '',
    ];
    ?>
    <?php
    $breadcrumb_items = [['ユーザー管理', route('admin.user.index')]];
    ?>

    <x-admin-page-title>ユーザー管理</x-admin-page-title>
    <x-admin-breadcrumb :items="$breadcrumb_items" />

    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>ユーザー一覧</x-card-title>

        <div class="flex justify-between items-end gap-2 flex-wrap m-2">
            <form method="GET" action="{{ route('admin.user.index') }}" class="flex flex-wrap items-end gap-2">
                <div class="flex items-end gap-2 flex-wrap m-2">
                    <x-filter-input name="user_name" label="ユーザー名" placeholder="ユーザー名" value="{{ request('user_name') }}" />
                    <x-filter-input name="mail" label="メールアドレス" placeholder="メールアドレス" value="{{ request('mail') }}" />
                </div>
                <div class="flex items-end gap-2 flex-wrap m-2">
                    <x-filter-input name="created_at_start" label="登録日時" type="datetime-local" value="{{ request('created_at_start') }}" />
                    <span class="item-center mb-6">~</span>
                    <x-filter-input name="created_at_end" label="" type="datetime-local" value="{{ request('created_at_end') }}" />
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-200 mb-4">
                        検索
                    </button>
                </div>
            </form>
            <div class="flex items-center mb-2">
                <a href="{{ route('admin.user.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-200 mb-4">
                    ユーザー作成
                </a>
            </div>
        </div>

        <x-table>
            <x-sort-table-thead :columns="$columns" />
            <tbody>
                @foreach ($items as $item)
                    <tr>
                        @foreach ($columns as $key => $value)
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($key === 'name')
                                    <a href="{{ route('admin.user.show', $item->id) }}"
                                        class="text-cyan-600 hover:text-cyan-400">{{ $item->$key }}</a>
                                @elseif ($key === 'license')
                                    {{ $item->license_label }}
                                @elseif ($key === 'created_at')
                                    {{ $item->created_at->format('Y/m/d H:i') }}
                                @elseif ($key === 'actions')
                                    <div class="flex justify-center">
                                        <a href="{{ route('admin.user.edit', $item->id) }}"
                                            class="text-cyan-600 hover:text-cyan-400">編集</a>
                                        <form method="POST" action="{{ route('admin.user.delete', $item->id) }}"
                                            class="ml-2">
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
