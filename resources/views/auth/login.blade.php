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
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn-submit mb-4">
            Se connecter <i class="bi bi-arrow-right-short ms-1"></i>
        </button>

        <div class="text-center">
            <div style="display: flex; align-items: center; margin: 20px 0; color: var(--text-muted); font-size: 0.8rem;">
                <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
                <span style="padding: 0 10px;">Pas encore de compte ?</span>
                <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
            </div>
            
            <a href="{{ route('register') }}" class="btn-submit" style="background: transparent; border: 1px solid var(--primary); color: var(--primary); text-decoration: none; display: flex; align-items: center; justify-content: center;">
                S'inscrire <i class="bi bi-person-plus ms-1"></i>
            </a>
        </div>
    </form>
</x-guest-layout>
