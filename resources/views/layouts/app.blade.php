<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ Str::replace('_',' ',config('app.name', 'Laravel')) }}</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">        
        <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">        
        <link rel="icon" href="{{ asset('storage/favicon/favicon3.ico')}}" />


        <!-- Scripts -->

        <script src="https://kit.fontawesome.com/23527384bb.js" crossorigin="anonymous"></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <div name="header">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Dashboard') }}
                        </h2>
                    <div>
                </div>
            </header>
            <!-- Page Content -->
            <main>
                @include('admin.sidebar')
                <div class='content w-3/4'>
                    @include('include.errors')
                    {{ $slot }}                        
                </div>
            </main>
            @include('include.foot')
        </div>
        @stack('scripts')
    </body>
</html>
