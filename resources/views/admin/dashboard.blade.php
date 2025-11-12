@extends('components.admNavbar')

@section('title', 'Admin | Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    {{-- Konten utama --}}
    <div class="p-3">
        {{-- Header --}}
        <div class="container-fluid">
            <div class="row align-items-center mb-3">
                <div class="col-lg-8 col-sm-6">
                    <h2 class="mb-1" style="font-family:'Poppins',sans-serif; font-weight:700;">Dashboard</h2>
                    <small id="todayText" class="text-muted"></small>
                    <div>
                        <small id="today"></small>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stat Cards --}}
        <div class="container-fluid">
            <div class="row g-3">
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0 shadow-sm h-100 dashboard-card" data-card-type="lunas"
                        style="cursor: pointer;">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small">Tagihan Lunas</div>
                                <h4 class="mt-1 mb-0">{{ $tagihanLunas }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background:#E7F8EF;">
                                <iconify-icon icon="mdi:check-decagram"
                                    style="font-size:24px; color:#16A34A;"></iconify-icon>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('admin.history') }}" class="text-decoration-none"
                                style="display:inline-flex; align-items:center; gap: 6px;">
                                Selengkapnya <iconify-icon icon="mdi:arrow-right-circle-outline"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0 shadow-sm h-100 dashboard-card" data-card-type="dibatalkan"
                        style="cursor: pointer;">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small">Tagihan Dibatalkan</div>
                                <h4 class="mt-1 mb-0">{{ $tagihanDibatalkan }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background:#FDE8E8;">
                                <iconify-icon icon="mdi:close-octagon-outline"
                                    style="font-size:24px; color:#DC2626;"></iconify-icon>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('admin.history') }}" class="text-decoration-none"
                                style="display:inline-flex; align-items:center; gap: 6px;">
                                Selengkapnya <iconify-icon icon="mdi:arrow-right-circle-outline"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0 shadow-sm h-100 dashboard-card" data-card-type="belum-lunas"
                        style="cursor: pointer;">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small">Tagihan Belum Lunas</div>
                                <h4 class="mt-1 mb-0">{{ $totalTagihanAktif }}</h4>
                            </div>
                            <div class="rounded-3 p-2" style="background:#E8F1FF;">
                                <iconify-icon icon="mdi:clipboard-list-outline"
                                    style="font-size:24px; color:#2563EB;"></iconify-icon>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('admin.reminder') }}" class="text-decoration-none"
                                style="display:inline-flex; align-items:center; gap: 6px;">
                                Selengkapnya <iconify-icon icon="mdi:arrow-right-circle-outline"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card border-0 shadow-sm h-100 dashboard-card" data-card-type="nominal-tinggi"
                        style="cursor: pointer;">
                        <div class="card-body d-flex justify-content-between align-items-start">
                            <div>
                                <div class="text-muted small">Total Nominal Tagihan Belum Lunas</div>
                                <h5 class="mt-1 mb-0">Rp. {{ number_format($totalNominalTagihan, 0, ',', '.') }}</h5>
                            </div>
                            <div class="rounded-3 p-2" style="background:#FFF7E6;">
                                <iconify-icon icon="mdi:cash-multiple"
                                    style="font-size:24px; color:#D97706;"></iconify-icon>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('admin.reminder') }}" class="text-decoration-none"
                                style="display:inline-flex; align-items:center; gap: 6px;">
                                Selengkapnya <iconify-icon icon="mdi:arrow-right-circle-outline"></iconify-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="container-fluid mt-4">
            <div class="card border-0 shadow-sm">
                <div
                    class="card-header d-flex align-items-center justify-content-between bg-white flex flex-wrap items-center gap-2 sm:gap-3">
                    <h5 class="mb-0" style="font-weight:600;">
                        <iconify-icon icon="mdi:chart-line" class="me-1"></iconify-icon>
                        Statistik Tagihan Perbulan
                    </h5>

                    {{-- Dropdown Tahun --}}
                    <div
                        class="flex items-center gap-2 w-full sm:w-auto justify-between sm:justify-end order-2 sm:order-none mb-2">
                        <span class="text-muted text-sm">Tahun</span>
                        <select id="yearSelect" class="form-select form-select-sm"
                            style="width: 120px; box-shadow: none; outline: none;">
                            @foreach ($years as $y)
                                <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>{{ $y }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body chart-card-body">
                    <canvas id="statChart" style="width:100%; height:100%;"></canvas>
                    <div id="noDataMessage" class="no-data-message">Belum ada data untuk tahun ini.</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Include Modal --}}
    @include('components.dashboardModal')

@endsection

@include('components.admFooter')

@push('scripts')
    <!-- === Chart.js === -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1"></script>

    <script>
        // Routes untuk dashboard modal
        const dashboardRoutes = {
            history: "{{ route('admin.history') }}",
            reminder: "{{ route('admin.reminder') }}",
            quickStats: "{{ route('admin.dashboard.quick-stats') }}"
        };
    </script>

    <script src="{{ asset('js/dashboard-modal.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const NAVY = '#1a3b6b';
            const RED = '#dc2626';

            // data dari controller
            const months = @json($months);
            const dataLunas = @json($totals);
            const dataCancel = @json($totalsDibatalkan);

            const canvas = document.getElementById('statChart');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');

            // no data overlay
            const noDataEl = document.getElementById('noDataMessage');
            const isAllZero = Array.isArray(dataLunas) && Array.isArray(dataCancel)
                && dataLunas.every(v => v === 0) && dataCancel.every(v => v === 0);
            if (isAllZero) {
                noDataEl?.classList.add('show');
                canvas.style.display = 'none';
                return;
            } else {
                noDataEl?.classList.remove('show');
                canvas.style.display = 'block';
            }

            const currencyID = new Intl.NumberFormat('id-ID');
            const isSmall = () => window.matchMedia('(max-width: 576px)').matches;
            const isTablet = () => window.matchMedia('(max-width: 768px)').matches;

            function buildOptions() {
                // ukuran tipografi/titik dinamis
                const tickFont = isSmall() ? 10 : isTablet() ? 11 : 12;
                const legendFont = isSmall() ? 11 : 12;
                const pRadius = isSmall() ? 2 : 3;
                const pHover = isSmall() ? 4 : 5;
                const bWidth = isSmall() ? 2 : 3;

                return {
                    responsive: true,
                    maintainAspectRatio: false,
                    interaction: { mode: 'index', intersect: false },
                    plugins: {
                        legend: {
                            position: isSmall() ? 'bottom' : 'top',
                            labels: { boxWidth: 14, font: { size: legendFont } }
                        },
                        tooltip: {
                            callbacks: {
                                title: (items) => 'Bulan: ' + (items[0]?.label ?? ''),
                                label: (ctx) => `${ctx.dataset.label}: Rp ${currencyID.format(ctx.parsed.y ?? 0)}`
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: { display: false },
                            ticks: { font: { size: tickFont } }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                font: { size: tickFont },
                                callback: (v) => 'Rp ' + currencyID.format(v)
                            }
                        }
                    },
                    animations: {
                        tension: { duration: 800, easing: 'easeInOutQuad', from: 0.3, to: 0.45 }
                    },
                    // taruh config dataset yang dinamis di sini via scriptable
                    datasets: {
                        line: {
                            borderWidth: bWidth,
                            pointRadius: pRadius,
                            pointHoverRadius: pHover
                        }
                    }
                };
            }

            const chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: months,
                    datasets: [
                        {
                            label: 'Tagihan Lunas',
                            data: dataLunas,
                            borderColor: NAVY,
                            backgroundColor: NAVY + '20',
                            tension: 0.35
                        },
                        {
                            label: 'Tagihan Dibatalkan',
                            data: dataCancel,
                            borderColor: RED,
                            backgroundColor: RED + '20',
                            tension: 0.35
                        }
                    ]
                },
                options: buildOptions()
            });

            // update opsi saat layar di-resize (debounced)
            const debounce = (fn, ms = 150) => {
                let t; return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), ms); };
            };
            window.addEventListener('resize', debounce(() => {
                chart.options = buildOptions();
                chart.update('none');
            }));

            // Dropdown tahun → reload dengan query ?year=
            document.getElementById('yearSelect')?.addEventListener('change', (e) => {
                const url = new URL(location.href);
                url.searchParams.set('year', e.target.value);
                location.assign(url.toString());
            });
        });
    </script>
@endpush