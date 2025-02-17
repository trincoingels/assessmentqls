<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Order Overzicht')</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Navbar -->
<nav class="bg-gray-800 text-white py-4">
    <div class="max-w-7xl mx-auto px-4 flex justify-between items-center">
        <a href="#" class="text-lg font-bold">Mijn Webshop</a>
    </div>
</nav>

<!-- Content Container -->
<div class="max-w-7xl mx-auto mt-6 px-4">
    @yield('content')
</div>

<!-- Footer -->
<footer class="text-center mt-6 py-4 bg-gray-200 text-gray-700">
    <p>&copy; {{ date('Y') }} Mijn Webshop</p>
</footer>

<script src="{{ asset('vendor/wire-elements-pro/js/overlay-component.js') }}"></script>
@livewire('wire-elements-modal')
@livewireScripts

</body>
</html>
