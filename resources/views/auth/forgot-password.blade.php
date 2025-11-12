<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lupa Kata Sandi</title>

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
</head>

<body>
    <div class="auth-card">
        <img src="{{ asset('images/icon/NavIcon.png') }}" alt="Logo" class="img-fluid mb-4"
            style="width: 350px; display: block; margin: 0 auto;">
        <h5>Lupa Kata Sandi</h5>
        <p>Masukkan email admin yang terdaftar. Kami akan mengirim tautan reset ke email tersebut.</p>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3 text-start">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>

            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">Kirim Link Reset</button>
                <p class="mb-0" style="font-size: 14px; color: #6c757d;">
                    Sudah ingat password?
                    <a href="{{ route('login') }}" class="auth-link fw-semibold">Masuk di sini</a>
                </p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('status'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: @json(session('status')) });
        @endif
        @if (session('failed'))
            Swal.fire({ icon: 'error', title: 'Gagal', text: @json(session('failed')) });
        @endif
    </script>
</body>

</html>