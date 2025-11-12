<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Login | Kantor Deni Nugraha</title>
    <link rel="icon" href="{{ asset('images/icon/garuda.png') }}" type="image/png" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- ([resources/css/app.css, resources/js/app.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font & Custom CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}" />

</head>

<body class="box d-flex justify-content-center align-items-center">
    <div class="container">
        <div class="card shadow-lg" style="border-radius: 10px; overflow: hidden;">
            <div class="row no-gutters">
                <!-- Kolom kiri (form login) -->
                <div class="col-md-6 d-flex flex-column justify-content-center align-items-center p-4">
                    <div class="w-100">
                        <img src="{{ asset('images/icon/NavIcon.png') }}" alt="Logo" class="img-fluid mb-5"
                            style="width: 350px; display: block; margin: 0 auto;">
                        <h1 class="text-center mb-2 fw-bold heading">Selamat datang
                            kembali!</h1>
                        <h2 class="text-center mb-4 subheading">Kelola tagihan Anda
                            dengan
                            lebih cepat dan efisien.
                        </h2>
                        <div class="form-container mx-auto">
                            <form action="{{ route('login-proses') }}" method="POST" novalidate>
                                @csrf
                                <!-- Username -->
                                <div class="form-group mb-3">
                                    <div class="field-wrap">
                                        <span class="field-left text-navy">
                                            <iconify-icon icon="mingcute:user-4-fill"
                                                style="font-size:24px;"></iconify-icon>
                                        </span>
                                        <input type="text" class="form-control field-input" name="username"
                                            id="username" placeholder="Username" required value="{{ old('username') }}">
                                    </div>
                                    @error('username') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>

                                <!-- Password -->
                                <div class="form-group mb-2">
                                    <div class="field-wrap">
                                        <span class="field-left text-navy">
                                            <iconify-icon icon="mingcute:lock-fill"
                                                style="font-size:24px"></iconify-icon>
                                        </span>

                                        <input id="password" name="password" type="password"
                                            class="form-control field-input" placeholder="Password" required>

                                        <button type="button" id="togglePassword" class="field-right text-navy"
                                            aria-label="Tampilkan/sembunyikan password">
                                            <iconify-icon id="eyeIcon" icon="mdi:eye-off"
                                                style="font-size:22px;"></iconify-icon>
                                        </button>
                                    </div>
                                    @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="d-flex align-items-center justify-content-end ps-3">
                                    <a href="{{ route('password.request') }}" class="link-navy fw-bold small">
                                        Lupa kata sandi?
                                    </a>
                                </div>

                                <div id="message" class="text-center mb-3" style="font-size: 16px;"></div>

                                <!-- Tombol -->
                                <div class="d-flex justify-content-center gap-5 mt-5">
                                    <button type="button" class="btn btn-gold"
                                        onclick="window.location.href='{{ route('landing.index') }}'"
                                        style="width: 124px; height: 50px; border-radius: 16px; box-shadow: none; outline:none;">
                                        Kembali
                                    </button>

                                    <button type="submit" class="btn btn-navy"
                                        style="width: 124px; height: 50px; border-radius: 16px; box-shadow: none; outline:none;">
                                        Login
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Kolom kanan (gambar ilustrasi) -->
                <div class="login-img col-md-6 d-none d-md-flex justify-content-center align-items-center"
                    style="background-color: #f7e7e2;">
                    <img src="{{ asset('images/loginimage.svg') }}" alt="Design Image" class="img-fluid"
                        style="width: 516px; padding-right: 12px;">
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- sweetalert password --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session('failed'))
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: @json(session('failed')),
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('status'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: @json(session('status')),
                    confirmButtonText: 'OK'
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal',
                    html: `{!! implode('<br>', $errors->all()) !!}`
                });
            @endif
});
    </script>


    <!-- Iconify v3 -->
    <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

    <!-- Toggle Password -->
    <script>
        const pwd = document.getElementById('password');
        const btn = document.getElementById('togglePassword');
        const icon = document.getElementById('eyeIcon');

        btn.addEventListener('click', () => {
            const hidden = pwd.type === 'password';
            pwd.type = hidden ? 'text' : 'password';
            icon.setAttribute('icon', hidden ? 'mdi:eye' : 'mdi:eye-off');
            btn.setAttribute('aria-pressed', hidden ? 'true' : 'false');
        });
    </script>
</body>

</html>