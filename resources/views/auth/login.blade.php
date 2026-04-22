<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--secondary); margin-bottom: 8px;">Bienvenue</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Connectez-vous pour accéder à votre espace.</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600" style="color: #16a34a; background: #f0fdf4; padding: 12px; border-radius: 8px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email">Adresse Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-1">
                <label for="password" style="margin-bottom: 0;">Mot de passe</label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="font-size: 0.75rem;">Oublié ?</a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <label for="remember_me" class="checkbox-label">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Se souvenir de moi</span>
            </label>
        </div>

        <button type="submit" class="btn-submit">
            Se connecter <i class="bi bi-arrow-right-short ms-1"></i>
        </button>
    </form>
</x-guest-layout>
