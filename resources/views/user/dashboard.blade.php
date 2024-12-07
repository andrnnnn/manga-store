<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-light min-h-screen flex items-center justify-center font-[Poppins]">
    <div class="max-w-md w-full mx-4">
        <div class="bg-surface-light rounded-xl shadow-lg p-8 text-center">
            <h1 class="text-2xl font-bold text-primary-dark mb-4">Selamat Datang, {{ auth()->user()->name }}!</h1>
            <p class="text-primary mb-6">Ini adalah halaman dashboard pengguna.</p>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-primary text-white rounded-lg px-4 py-2 font-medium hover:bg-primary-dark transition-colors">
                    Logout
                </button>
            </form>
        </div>
    </div>
</body>
</html>
