<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-light min-h-screen flex items-center justify-center font-[Poppins] relative">
    <!-- Back to Home Button -->
    <div class="absolute top-4 left-4">
        <a href="{{ url('/') }}" class="flex items-center text-primary hover:text-primary-dark transition-colors">
            <i class="fas fa-arrow-left mr-2"></i>
            Balik ke Home desu~
        </a>
    </div>

    <!-- Alert Container -->
    @if ($errors->any())
        <div id="alertContainer" class="fixed top-4 right-4 z-50">
            @foreach ($errors->all() as $error)
                <div class="p-4 mb-4 rounded-lg bg-red-100 text-red-700 transition-opacity duration-500">
                    {{ $error }}
                </div>
            @endforeach
        </div>

        <script>
            setTimeout(() => {
                const alerts = document.querySelectorAll('#alertContainer div');
                alerts.forEach(alert => {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                });
            }, 3000);
        </script>
    @endif

    <div class="max-w-md w-full mx-2">
        <!-- Logo -->
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-40 mx-auto">
            <p class="text-primary-dark font-medium">Manga Store Indonesia</p>
        </div>

        @yield('content')
    </div>

    @yield('scripts')
</body>
</html> 