<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }} - {{ config('app.name') }}</title>

        <!-- Fonts -->
        @googlefonts(['nonce' => csp_nonce()])

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @if (app()->isProduction())
        <script
            src="https://cdn.usefathom.com/script.js"
            data-site="{{ config('services.fathom.site_id') }}"
            defer>
        </script>
        @endif
    </head>
    <body class="font-sans antialiased">
        {{ $slot }}
    </body>
</html>
