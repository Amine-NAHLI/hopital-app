<x-guest-layout>
    <style>
        .login-page-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .login-flex-layout {
            display: flex;
            gap: 40px;
            align-items: stretch;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
        }

        .quick-access-side {
            flex: 1;
            max-width: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .quick-access-header {
            margin-bottom: 30px;
        }

        .quick-access-header h2 {
            font-family: 'Sora', sans-serif;
            color: white;
            font-weight: 800;
            font-size: 2rem;
            margin-bottom: 12px;
            letter-spacing: -0.02em;
        }

        .quick-access-header p {
            color: rgba(255, 255, 255, 0.5);
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .user-grid-login {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
            gap: 20px;
        }

        .user-card-login {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 24px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .user-card-login:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--primary);
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
        }

        .user-card-login .avatar-circle {
            width: 54px;
            height: 54px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-family: 'Sora', sans-serif;
            font-size: 1.3rem;
            color: white;
            box-shadow: 0 8px 15px rgba(0,0,0,0.2);
        }

        .user-card-login.admin .avatar-circle { background: linear-gradient(135deg, #6d28d9, #8b5cf6); }
        .user-card-login.medecin .avatar-circle { background: linear-gradient(135deg, #0891b2, #06b6d4); }

        .user-card-login .info-box {
            display: flex;
            flex-direction: column;
        }

        .user-card-login .name {
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .user-card-login .role {
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--accent);
            margin-top: 4px;
        }

        .user-card-login.admin .role { color: #a78bfa; }

        .user-card-login .email-tag {
            color: rgba(255, 255, 255, 0.35);
            font-size: 0.85rem;
        }

        .form-side {
            flex: 0 0 470px;
        }

        @media (max-width: 1024px) {
            .login-flex-layout {
                flex-direction: column;
                align-items: center;
            }
            .quick-access-side {
                order: 2;
                max-width: 470px;
                text-align: center;
            }
            .quick-access-header { margin-top: 40px; }
            .form-side {
                order: 1;
            }
            .user-grid-login {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 500px) {
            .user-grid-login {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="login-page-container">
        <div class="auth-logo">
            <div class="logo-box">
                <i class="bi bi-hospital"></i>
            </div>
            <h1>MediCore<span style="color: var(--accent)">Pro</span></h1>
            <p style="color: rgba(255, 255, 255, 0.42); font-size: 0.875rem; margin: 0;">Portail de Gestion Hospitalière</p>
        </div>

        <div class="login-flex-layout">
            <!-- Sidebar Quick Access -->
            <div class="quick-access-side">
                <div class="quick-access-header">
                    <h2>Accès Rapide</h2>
                    <p>Choisissez un compte pour une connexion instantanée sans mot de passe.</p>
                </div>

                <div class="user-grid-login">
                    @foreach($users as $user)
                        <div class="user-card-login {{ $user->role }}" onclick="magicLogin('{{ $user->email }}', '{{ $user->id }}')">
                            <div class="avatar-circle">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="info-box">
                                <span class="name">{{ $user->name }}</span>
                                <span class="role">{{ $user->role }}</span>
                            </div>
                            <div class="email-tag">
                                <i class="bi bi-person-check me-1"></i> {{ $user->email }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Main Auth Card -->
            <div class="form-side">
                <div class="auth-card">
                    <div class="mb-5 text-center">
                        <h2 style="font-family: 'Sora', sans-serif; font-weight: 700; color: var(--secondary); margin-bottom: 8px;">Authentification</h2>
                        <p style="color: var(--text-muted); font-size: 0.9rem;">Connectez-vous à votre espace MediCore.</p>
                    </div>

                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600" style="color: #16a34a; background: #f0fdf4; padding: 12px; border-radius: 8px;">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf
                        <input type="hidden" name="magic_id" id="magic_id" value="">

                        <div class="mb-4">
                            <label for="email">Adresse Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="votre@email.com">
                            @error('email')
                                <div class="error-msg"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password">Mot de passe</label>
                            <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                            @error('password')
                                <div class="error-msg"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <label class="checkbox-label">
                                <input type="checkbox" name="remember"> Se souvenir de moi
                            </label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" style="color: var(--primary); text-decoration: none; font-size: 0.84rem; font-weight: 600;">Oublié ?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn-submit mb-4" id="submitBtn">
                            Connexion au Portail <i class="bi bi-arrow-right-short ms-1"></i>
                        </button>

                        <div class="text-center">
                            <div style="display: flex; align-items: center; margin: 20px 0; color: var(--text-muted); font-size: 0.8rem;">
                                <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
                                <span style="padding: 0 10px;">Nouveau praticien ?</span>
                                <div style="flex: 1; height: 1px; background: #e2e8f0;"></div>
                            </div>
                            
                            <a href="{{ route('register') }}" class="btn-submit" style="background: transparent; border: 1px solid var(--primary); color: var(--primary); text-decoration: none;">
                                Créer un compte <i class="bi bi-person-plus ms-1"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');
            const magicId = urlParams.get('magic_id');
            if (email) {
                magicLogin(email, magicId);
            }
        });

        function magicLogin(email, id) {
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const submitBtn = document.getElementById('submitBtn');
            const magicIdInput = document.getElementById('magic_id');
            
            // Fill values
            emailInput.value = email;
            passwordInput.value = '********'; // Visual placeholder
            magicIdInput.value = id;
            
            // UI Feedback
            emailInput.style.backgroundColor = 'rgba(79, 70, 229, 0.05)';
            passwordInput.style.backgroundColor = 'rgba(79, 70, 229, 0.05)';
            
            submitBtn.style.transform = 'scale(1.02)';
            submitBtn.innerHTML = 'Connexion Magique... <i class="bi bi-stars ms-1"></i>';
            
            setTimeout(() => {
                document.getElementById('loginForm').submit();
            }, 800);
        }
    </script>
</x-guest-layout>
