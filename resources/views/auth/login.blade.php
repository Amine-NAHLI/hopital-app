<x-guest-layout>
    <div class="auth-card-nova">
        <div class="text-center mb-5">
            <div class="logo-nova-guest">
                <i class="bi bi-hospital"></i>
            </div>
            <span class="brand-text-guest">MediCore Nova</span>
            <p class="text-muted fw-500">Connectez-vous à l'avenir de la santé</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success border-0 rounded-4 mb-4" style="background: var(--primary-glow); color: var(--primary);">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf
            <input type="hidden" name="magic_id" id="magic_id" value="">

            <div class="mb-4">
                <label for="email">Adresse Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="nom@hopital.com">
                @error('email')
                    <div class="error-msg mt-2"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password">Mot de passe</label>
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                @error('password')
                    <div class="error-msg mt-2"><i class="bi bi-exclamation-triangle"></i> {{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between align-items-center mb-5">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember"> <span class="ms-1">Rester connecté</span>
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-primary text-decoration-none fw-700 small">Oublié ?</a>
                @endif
            </div>

            <button type="submit" class="btn-nova-auth" id="submitBtn">
                Entrer dans le Portail <i class="bi bi-arrow-right-short ms-1"></i>
            </button>

            <div class="text-center mt-5">
                <p class="text-muted small mb-3">Pas encore de compte ?</p>
                <a href="{{ route('register') }}" class="btn w-100 border-0 fw-800 text-primary" style="background: var(--primary-glow); border-radius: 16px; padding: 14px;">
                    Demander un accès praticien
                </a>
            </div>
        </form>
    </div>

    <!-- Quick Access Overlay (Optional but nice) -->
    <div class="mt-5 text-center">
        <p class="text-muted small fw-bold text-uppercase letter-spacing-1">Accès Rapide Démo</p>
        <div class="d-flex justify-content-center gap-2 mt-3">
            @foreach($users as $user)
                <div class="cursor-pointer" onclick="magicLogin('{{ $user->email }}', '{{ $user->id }}')" title="{{ $user->name }} ({{ $user->role }})" style="width: 40px; height: 40px; border-radius: 12px; background: white; border: 1px solid rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; font-weight: 800; color: var(--primary); box-shadow: 0 4px 10px rgba(0,0,0,0.03); cursor: pointer; transition: all 0.3s ease;">
                    {{ substr($user->name, 0, 1) }}
                </div>
            @endforeach
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');
            const magicId = urlParams.get('magic_id');
            if (email && magicId) {
                magicLogin(email, magicId);
            }
        });

        function magicLogin(email, id) {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitBtn = document.getElementById('submitBtn');
            const magicIdInput = document.getElementById('magic_id');
            
            emailInput.value = email;
            passwordInput.value = 'password123';
            magicIdInput.value = id;
            
            emailInput.style.borderColor = 'var(--primary)';
            submitBtn.innerHTML = 'Synchronisation... <i class="bi bi-arrow-repeat spin"></i>';
            submitBtn.style.opacity = '0.8';
            
            setTimeout(() => {
                document.getElementById('loginForm').submit();
            }, 300);
        }
    </script>

    <style>
        .spin { animation: spin 1s linear infinite; }
        @keyframes spin { 100% { transform: rotate(360deg); } }
        .cursor-pointer:hover { transform: translateY(-3px); box-shadow: 0 8px 15px rgba(99, 102, 241, 0.1) !important; border-color: var(--primary) !important; }
    </style>
</x-guest-layout>
