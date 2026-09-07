<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('partials.seo.head')

    {{-- Public pages do not need the admin interaction bundle. --}}
    @vite(['resources/css/app.css'])

    @stack('head')
</head>

<body>
    @yield('content')
    @stack('scripts')
</body>

</html>
