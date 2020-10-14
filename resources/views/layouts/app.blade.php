<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
</head>

<body>
    <div class="wrapper">
        @include('common.header')
        <div class="page-wrap">
            @include('common.sidebar')
            <div class="main-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <aside class="right-sidebar">
                <!-- I'm here just to avoid errors -->
            </aside>
            <div class="chat-panel hidden" hidden>
                <div class="widget-chat-activity flex-1">
                    <div class="messages">
                        <div class="message media reply">
                            <!-- I'm here just to avoid errors -->
                        </div>
                    </div>
                </div>
            </div>
            @include('common.footer')
        </div>
    </div>
    @livewireScripts
    <script src="{{ mix('js/alpine.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @stack('scripts')
    @stack('after_scripts')
</body>

</html>
