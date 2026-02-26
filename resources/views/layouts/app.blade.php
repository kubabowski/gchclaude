<!DOCTYPE html>
<html lang="en">
<head>
    @vite(['resources/css/app.scss', 'resources/js/app.tsx'])
    @include('partials.head')
</head>
<body>

@include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer')

</body>
</html>
