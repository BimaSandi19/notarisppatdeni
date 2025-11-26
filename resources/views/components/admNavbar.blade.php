<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>@yield('title', 'Admin | Dashboard')</title>
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/icon/garuda-32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/icon/garuda-16.png') }}" />
    <link rel="shortcut icon" href="{{ asset('images/icon/favicon.ico') }}" />
    {{-- Bootstrap 5 + Poppins --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- ([resources/css/app.css, resources/js/app.js -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Iconify is loaded in the footer (components.admFooter) to avoid duplicate loads --}}
    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/print-styles.css') }}" />
</head>

<body>
    <div class="app-shell"><!-- grid: 260px | 1fr -->

        {{-- SIDEBAR --}}
        <aside id="sidebar" class="sidebar">
            <a class="brand text-decoration-none">
                <iconify-icon icon="mdi:shield-account" style="font-size:22px;color:#fff;"></iconify-icon>
                <span class="title">Admin</span>
            </a>
            <nav class="p-3">
                <ul class="list-unstyled nav-sidebar d-grid gap-1">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}"
                            data-label="Dashboard">
                            <iconify-icon icon="mdi:view-dashboard-outline"></iconify-icon>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.reminder') }}"
                            class="nav-link {{ request()->is('admin/reminder') ? 'active' : '' }}"
                            data-label="Pengingat">
                            <iconify-icon icon="mdi:bell-outline"></iconify-icon>
                            <span>Pengingat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.history') }}"
                            class="nav-link {{ request()->is('admin/history') ? 'active' : '' }}" data-label="Riwayat">
                            <iconify-icon icon="mdi:history"></iconify-icon>
                            <span>Riwayat</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <a href="{{ route('logout-proses') }}"
                    class="nav-link d-flex align-items-center gap-2 text-decoration-none" data-label="Log Out">
                    <iconify-icon icon="mdi:logout"></iconify-icon>
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

        {{-- NAVBAR + MAIN AREA --}}
        <main class="bg-light">
            {{-- topbar (SEKARANG DI DALAM MAIN) --}}
            <header class="app-header bg-navy position-sticky top-0" style="z-index:1030; background-color: #1a3b6b !important;">
                <div class="container-fluid py-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2">
                        {{-- Burger (mobile) --}}
                        <button class="btn btn-light btn-sm d-lg-none" id="btnSidebarMobile"
                            aria-label="Toggle sidebar" style="box-shadow: none; outline:none;">
                            <iconify-icon icon="mdi:menu"></iconify-icon>
                        </button>
                        {{-- Collapse (desktop) --}}
                        <button class="btn btn-light btn-sm d-none d-lg-inline-flex" id="btnSidebarCollapse"
                            aria-label="Collapse sidebar" style="box-shadow: none; outline:none; font-size:large;">
                            <iconify-icon icon="mdi:menu-open"></iconify-icon>
                        </button>
                    </div>
                </div>
            </header>

            {{-- Konten halaman --}}
            <div class="container-fluid p-4">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- backdrop untuk sidebar mobile --}}
    <div id="backdrop" class="backdrop"></div>


    {{-- Slot script tambahan tiap halaman --}}
    @stack('scripts')
</body>

</html>