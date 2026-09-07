<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('partials.seo.head')

    {{-- Public pages use a dedicated lightweight CSS bundle instead of the full admin stylesheet. --}}
    @vite(['resources/css/public.css'])

    @stack('head')
</head>

<body>
    @yield('content')
    @stack('scripts')
</body>

</html>
