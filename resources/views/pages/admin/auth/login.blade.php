<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @livewireStyles
</head>

<body class="bg-white">
    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white justify-content-center">
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <i class="ik ik-code fa-4x"></i>
                        </div>
                        <h3>{{ config('app.name') }}</h3>
                        <p>Login with your account</p>
                        @livewire('admin.auth.login')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts
    <script src="{{ mix('js/alpine.js') }}"></script>
    <script src="{{ mix('js/login.js') }}"></script>
    @stack('scripts')
    @stack('after_scripts')
</body>

</html>
