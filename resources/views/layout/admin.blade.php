@extends('layout.app')

@section('body')

    <body class="min-h-screen">
        <x-admin-nav />

        <div class="ml-56 relative">
            <main class="l-main">
                <div class="mb-5">
                    @yield('content_header')
                </div>

                @yield('content')

            </main>
        </div>
    </body>
@endsection
