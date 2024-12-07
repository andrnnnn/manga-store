<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - {{ config('app.name') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-primary-light min-h-screen flex items-center justify-center font-[Poppins]">
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
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
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

        <!-- Card Register -->
        <div class="bg-surface-light rounded-xl shadow-lg p-8">
            <h1 class="text-2xl font-bold text-primary-dark mb-8 text-center">Yuk Daftar!</h1>

            <form method="POST" action="{{ route('register') }}" class="space-y-6" id="registerForm">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2" for="name">
                        Nama Kamu
                    </label>
                    <input type="text" id="name" name="name"
                        class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                        placeholder="Ketik nama lengkap kamu~" value="{{ old('name') }}" autofocus>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2" for="email">
                        Email Kamu
                    </label>
                    <input type="email" id="email" name="email"
                        class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                        placeholder="wibu@email.com" value="{{ old('email') }}">
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2" for="password">
                        Password Rahasia
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                        placeholder="Minimal 8 karakter ya~">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-medium text-primary mb-2" for="password_confirmation">
                        Ketik Ulang Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                        placeholder="Ketik ulang password kamu~">
                    <div class="mt-2">
                        <label class="inline-flex items-center">
                            <input type="checkbox" id="showPassword" class="form-checkbox h-4 w-4 text-primary rounded border-primary-light focus:ring-primary">
                            <span class="ml-2 text-sm text-primary">Mau lihat password?</span>
                        </label>
                    </div>
                </div>

                <!-- Register Button -->
                <button type="submit" id="submitButton"
                    class="w-full bg-primary text-white rounded-lg px-4 py-2 font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
                    <span id="buttonText">Daftar Yuk!</span>
                    <svg id="loadingIcon" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </form>

            <!-- Login Link -->
            <p class="mt-6 text-center text-sm text-primary">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-medium text-accent hover:text-accent/80">
                    Masuk di sini yuk!
                </a>
            </p>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('password_confirmation');
        const showPasswordCheckbox = document.getElementById('showPassword');
        const submitButton = document.getElementById('submitButton');
        const buttonText = document.getElementById('buttonText');
        const loadingIcon = document.getElementById('loadingIcon');

        showPasswordCheckbox.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
            confirmPasswordInput.type = this.checked ? 'text' : 'password';
        });

        // Fungsi untuk menampilkan loading
        function showLoading() {
            submitButton.disabled = true;
            buttonText.textContent = 'Tunggu sebentar ya...';
            loadingIcon.classList.remove('hidden');
        }

        // Fungsi untuk menyembunyikan loading
        function hideLoading() {
            submitButton.disabled = false;
            buttonText.textContent = 'Daftar Yuk!';
            loadingIcon.classList.add('hidden');
        }

        // Form submission handler
        document.getElementById('registerForm').addEventListener('submit', function() {
            showLoading();
        });
    </script>
</body>
</html>
