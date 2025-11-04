@extends('layout.app')

@section('body')
    <body class="min-h-screen bg-gray-50 flex flex-col">
        <x-header />

        <div class="flex-grow mt-32 sm:mt-36 lg:mt-40">
            <main>
                @yield('content')
            </main>
        </div>

        <x-footer class="mt-auto" />
    </body>
@endsection
