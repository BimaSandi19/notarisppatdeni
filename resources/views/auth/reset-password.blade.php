<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Reset Kata Sandi</title>

    <link rel="icon" href="{{ asset('images/icon/garuda.png') }}" type="image/png" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- ([resources/css/app.css, resources/js/app.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font & Custom CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* Smooth transition untuk border color validation */
        #password,
        #password_confirmation {
            transition: border-color 0.3s ease;
        }

        /* Custom validation styling tanpa icon bawaan Bootstrap */
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(26, 59, 107, 0.25);
        }

        /* Match status styling */
        #matchStatus {
            font-size: 14px;
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <img src="{{ asset('images/icon/NavIcon.png') }}" alt="Logo" class="img-fluid mb-4"
            style="width: 350px; display:block; margin:0 auto;">
        <h5>Atur Ulang Kata Sandi</h5>
        <p>Masukkan kata sandi baru Anda di bawah ini.</p>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Password Baru</label>
                <div class="field-wrap">
                    <input id="password" type="password" name="password" class="form-control" required minlength="8">
                    <button type="button" id="togglePassword" class="field-right text-navy"
                        aria-label="Tampilkan/sembunyikan password">
                        <iconify-icon id="eyeIcon" icon="mdi:eye-off" style="font-size:22px;"></iconify-icon>
                    </button>
                </div>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <small id="passwordHint" class="text-muted d-block mt-1">Minimal 8 karakter</small>
            </div>

            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Konfirmasi Password</label>
                <div class="field-wrap">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control"
                        required minlength="8">
                    <button type="button" id="toggleConfirmPassword" class="field-right text-navy"
                        aria-label="Tampilkan/sembunyikan konfirmasi password">
                        <iconify-icon id="eyeConfirmIcon" icon="mdi:eye-off" style="font-size:22px;"></iconify-icon>
                    </button>
                </div>
                <small id="matchStatus" class="d-block mt-1"></small>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" id="submitBtn" class="btn btn-primary" disabled>Konfirmasi</button>
                <p class="mb-0" style="font-size:14px; color:#6c757d;">
                    Sudah ingat password?
                    <a href="{{ route('login') }}" class="auth-link fw-semibold">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('status'))
        <script>Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('status')) });</script>
    @endif
    @if (session('failed'))
        <script>Swal.fire({ icon: 'error', title: 'Gagal', text: @json(session('failed')) });</script>
    @endif

    <!-- Iconify v3 -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Toggle Password -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const confirmInput = document.getElementById('password_confirmation');
            const submitBtn = document.getElementById('submitBtn');
            const matchStatus = document.getElementById('matchStatus');

            // Toggle password visibility
            const hookToggle = (inputId, btnId, iconId) => {
                const input = document.getElementById(inputId);
                const btn = document.getElementById(btnId);
                const icon = document.getElementById(iconId);
                if (!input || !btn || !icon) return;

                btn.addEventListener('click', () => {
                    const show = input.type === 'password';
                    input.type = show ? 'text' : 'password';
                    icon.setAttribute('icon', show ? 'mdi:eye' : 'mdi:eye-off');
                    btn.setAttribute('aria-pressed', show ? 'true' : 'false');
                });
            };

            hookToggle('password', 'togglePassword', 'eyeIcon');
            hookToggle('password_confirmation', 'toggleConfirmPassword', 'eyeConfirmIcon');

            // Real-time password match validation
            function validatePasswords() {
                const password = passwordInput.value;
                const confirm = confirmInput.value;

                // Reset styling
                passwordInput.style.borderColor = '';
                confirmInput.style.borderColor = '';

                // Cek apakah kedua field sudah diisi
                if (password.length === 0 || confirm.length === 0) {
                    matchStatus.textContent = '';
                    matchStatus.className = '';
                    submitBtn.disabled = true;
                    return;
                }

                // Cek minimal 8 karakter
                if (password.length < 8) {
                    matchStatus.textContent = '⚠️ Password minimal 8 karakter';
                    matchStatus.className = 'text-warning';
                    passwordInput.style.borderColor = '#ffc107'; // warning color
                    submitBtn.disabled = true;
                    return;
                }

                // Cek apakah password match
                if (password === confirm) {
                    matchStatus.textContent = '✓ Password cocok';
                    matchStatus.className = 'text-success fw-semibold';
                    passwordInput.style.borderColor = '#198754'; // success color
                    confirmInput.style.borderColor = '#198754'; // success color
                    submitBtn.disabled = false;
                } else {
                    matchStatus.textContent = '✗ Password tidak cocok';
                    matchStatus.className = 'text-danger fw-semibold';
                    confirmInput.style.borderColor = '#dc3545'; // danger color
                    submitBtn.disabled = true;
                }
            }

            // Listen to input events
            passwordInput.addEventListener('input', validatePasswords);
            confirmInput.addEventListener('input', validatePasswords);
            passwordInput.addEventListener('keyup', validatePasswords);
            confirmInput.addEventListener('keyup', validatePasswords);

            // Initial validation
            validatePasswords();
        });
    </script>

</body>

</html>