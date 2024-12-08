@extends('auth.index')

@section('title', 'Login')

@section('content')
<div class="bg-surface-light rounded-xl shadow-lg p-8">
    <h1 class="text-2xl font-bold text-primary-dark mb-8 text-center">Yuk Login!</h1>

    <form method="POST" action="{{ route('login') }}" class="space-y-6" id="loginForm">
        @csrf

        <!-- Email -->
        <div>
            <label class="block text-sm font-medium text-primary mb-2" for="email">
                Email Kamu
            </label>
            <input type="email" id="email" name="email"
                class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                placeholder="wibu@email.com" value="{{ old('email') }}" autofocus>
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-medium text-primary mb-2" for="password">
                Password Rahasia
            </label>
            <input type="password" id="password" name="password"
                class="w-full px-4 py-2 border border-primary-light rounded-lg focus:ring-1 focus:ring-primary focus:border-primary focus:outline-none hover:border-primary transition-colors"
                placeholder="Ketik password kamu di sini~">
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input type="checkbox" id="showPassword" class="form-checkbox h-4 w-4 text-primary rounded border-primary-light focus:ring-primary">
                    <span class="ml-2 text-sm text-primary">Mau lihat password?</span>
                </label>
            </div>
        </div>

        <!-- Login Button -->
        <button type="submit" id="submitButton"
            class="w-full bg-primary text-white rounded-lg px-4 py-2 font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center">
            <span id="buttonText">Masuk Yuk!</span>
            <svg id="loadingIcon" class="hidden animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </form>

    <!-- Register Link -->
    <p class="mt-6 text-center text-sm text-primary">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-medium text-accent hover:text-accent/80">
            Bikin akun baru yuk!
        </a>
    </p>
</div>
@endsection

@section('scripts')
<script>
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');
    const submitButton = document.getElementById('submitButton');
    const buttonText = document.getElementById('buttonText');
    const loadingIcon = document.getElementById('loadingIcon');

    showPasswordCheckbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
    });

    document.getElementById('loginForm').addEventListener('submit', function() {
        submitButton.disabled = true;
        buttonText.textContent = 'Tunggu sebentar ya...';
        loadingIcon.classList.remove('hidden');
    });
</script>
@endsection
