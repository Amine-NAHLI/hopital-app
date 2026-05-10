<x-guest-layout>
    <div class="auth-logo">
        <div class="logo-box">
            <i class="bi bi-hospital"></i>
        </div>
        <h1>MediCore<span style="color: var(--accent)">Pro</span></h1>
        <p style="color: rgba(255, 255, 255, 0.42); font-size: 0.875rem; margin: 0;">Portail de Gestion Hospitalière</p>
    </div>

    <div class="auth-card">
        <div class="mb-4 text-sm text-gray-600" style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.5; margin-bottom: 24px;">
            {{ __('Oublié votre mot de passe ? Pas de problème. Indiquez-nous simplement votre adresse électronique et nous vous enverrons un lien de réinitialisation.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email">Adresse Email</label>
                <input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <button type="submit" class="btn-submit">
                    {{ __('Envoyer le lien de réinitialisation') }}
                </button>
            </div>
            
            <div class="mt-4 text-center">
                <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-size: 0.84rem; font-weight: 600;">Retour à la connexion</a>
            </div>
        </form>
    </div>
</x-guest-layout>
