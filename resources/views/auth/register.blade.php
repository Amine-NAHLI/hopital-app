<x-guest-layout>
    <div class="mb-4 text-center">
        <h2 style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--secondary); margin-bottom: 8px;">Créer un compte</h2>
        <p style="color: var(--text-muted); font-size: 0.9rem;">Rejoignez la plateforme MediCore Pro.</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-4">
            <label for="name">Nom complet</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Ex: Jean Dupont">
            @error('name')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-4">
            <label for="email">Adresse Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="exemple@mail.com">
            @error('email')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Min. 8 caractères">
            @error('password')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Répétez le mot de passe">
            @error('password_confirmation')
                <div class="error-msg">{{ $message }}</div>
            @enderror
        </div>

        <div class="mt-2 text-center mb-4">
            <a href="{{ route('login') }}">Déjà inscrit ? Connectez-vous</a>
        </div>

        <button type="submit" class="btn-submit">
            Créer mon compte <i class="bi bi-person-plus-fill ms-1"></i>
        </button>
    </form>
</x-guest-layout>
