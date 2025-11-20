@extends('components.admNavbar')

@section('title', 'Admin | Riwayat')
@section('page_title', 'Riwayat Tagihan')

@section('content')
    <div class="container-fluid py-3">
        {{-- Header --}}
        <div class="row align-items-center mb-3">
            <h2 class="mb-1 fw-semibold">Riwayat Tagihan</h2>
            <div class="col-lg-12 col-md-12 col-sm-6 py-2 px-3">
                <div class="card card-total-tagihan shadow-sm border-0">
                    <div class="card-body py-2">
                        <small class="text-muted fw-semibold d-block">Total Tagihan Lunas:</small>
                        <p class="fs-5 fw-semibold mb-0">Rp. {{ number_format($totalTagihanLunas ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Actions + Table --}}
        <div class="card shadow-sm">
            <div
                class="card-header d-flex flex-column flex-md-row flex-sm-row align-items-md-center align-items-sm-center justify-content-between gap-2">
                <h5 class="card-title mb-0 fw-semibold">Riwayat Tagihan</h5>

                <div
                    class="toolbar d-flex flex-column flex-md-row flex-sm-row align-items-md-center align-items-sm-center gap-2">

                    {{-- Sort & Filter --}}
                    <div class="dropdown">
                        <button class="btn btn-outline-soft dropdown-toggle" type="button" id="sortDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow:none; outline: none;">
                            Urutkan & Saring
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item {{ !request('status') && !request('sort') ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history') }}">
                                    <iconify-icon icon="mdi:refresh" width="16" height="16" class="me-1"></iconify-icon>
                                    Tampilkan Semua (Reset)
                                </a></li>
                            <li><a class="dropdown-item {{ request('status') === 'Lunas' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['status' => 'Lunas', 'q' => request('q'), 'sort' => request('sort')]) }}">Lunas</a>
                            </li>
                            <li><a class="dropdown-item {{ request('status') === 'Dibatalkan' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['status' => 'Dibatalkan', 'q' => request('q'), 'sort' => request('sort')]) }}">Dibatalkan</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item {{ request('sort') === 'tanggal-desc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['sort' => 'tanggal-desc', 'status' => request('status'), 'q' => request('q')]) }}">Tanggal
                                    (Terbaru - Terlama)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'tanggal-asc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['sort' => 'tanggal-asc', 'status' => request('status'), 'q' => request('q')]) }}">Tanggal
                                    (Terlama - Terbaru)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'nominal-desc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['sort' => 'nominal-desc', 'status' => request('status'), 'q' => request('q')]) }}">Nominal
                                    Tagihan (Tertinggi)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'nominal-asc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.history', ['sort' => 'nominal-asc', 'status' => request('status'), 'q' => request('q')]) }}">Nominal
                                    Tagihan (Terendah)</a></li>
                        </ul>
                    </div>

                    {{-- Search (server-side) --}}
                    <form action="{{ route('admin.history') }}" method="GET" class="d-flex">
                        <div class="input-group" style="width: 220px;">
                            <input name="q" value="{{ request('q') }}" type="text" id="searchInput"
                                class="form-control input-search" placeholder="Cari">

                            @if(request('q'))
                                <a href="{{ route('admin.history', ['status' => request('status'), 'sort' => request('sort')]) }}"
                                    class="btn btn-outline-soft d-flex align-items-center justify-content-center"
                                    style="border-left: 0; padding: 0.375rem 0.75rem;" title="Hapus pencarian">
                                    <iconify-icon icon="mdi:close" width="20" height="20"></iconify-icon>
                                </a>
                            @endif

                            <button class="btn btn-outline-soft btn-search d-flex align-items-center justify-content-center"
                                type="submit" aria-label="Cari">
                                <iconify-icon icon="mdi:magnify" width="20" height="20" aria-hidden="true"></iconify-icon>
                            </button>
                        </div>
                    </form>

                    {{-- Cetak Laporan Dropdown --}}
                    <div class="dropdown">
                        <button class="btn btn-gold fw-semibold d-flex align-items-center dropdown-toggle" type="button"
                            id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                            style="box-shadow:none; outline: none;">
                            <iconify-icon icon="mdi:printer" width="20" height="20" class="me-1"
                                aria-hidden="true"></iconify-icon>
                            Cetak Laporan
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="exportDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.history.print', request()->query()) }}"
                                    id="printDirect">
                                    <iconify-icon icon="mdi:printer-outline" width="18" height="18"
                                        class="me-2"></iconify-icon>
                                    Cetak Langsung
                                </a>
                            </li>
                            </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                    href="{{ route('admin.history.export.excel', request()->query()) }}">
                                    <iconify-icon icon="vscode-icons:file-type-excel" width="18" height="18"
                                        class="me-2"></iconify-icon>
                                    Export ke Excel
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.history.export.pdf', request()->query()) }}">
                                    <iconify-icon icon="vscode-icons:file-type-pdf2" width="18" height="18"
                                        class="me-2"></iconify-icon>
                                    Export ke PDF
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle" id="table2" aria-describedby="table2-info">
                    <thead class="table-light text-center align-middle">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Nasabah</th>
                            <th>Nomor Kwitansi</th>
                            <th>Nominal Tagihan</th>
                            <th style="width: 110px">Tanggal Tagihan</th>
                            <th>Status Pembayaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $d)
                            <tr>
                                <td data-label="No" class="text-center">
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </td>
                                <td data-label="Nama">{{ $d->nama_nasabah }}</td>
                                <td data-label="No. Kwitansi">{{ $d->nomor_kwitansi }}</td>
                                <td data-label="Nominal" class="nominal"><span
                                        class="money">Rp.&nbsp;{{ number_format($d->nominal_tagihan, 0, ',', '.') }}</span>
                                </td>
                                <td data-label="Tanggal">{{ \Carbon\Carbon::parse($d->tanggal_tagihan)->format('d-m-Y') }}
                                </td>
                                <td data-label="Status" class="text-center">
                                    @if($d->status_pembayaran === 'Lunas')
                                        <span class="badge bg-success">{{ $d->status_pembayaran }}</span>
                                    @elseif($d->status_pembayaran === 'Dibatalkan')
                                        <span class="badge bg-danger">{{ $d->status_pembayaran }}</span>
                                    @else
                                        <span class="badge bg-secondary">{{ $d->status_pembayaran }}</span>
                                    @endif
                                </td>
                                <td data-label="Keterangan">{{ $d->keterangan }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination (uses pagination template) --}}
                <div class="mt-3">
                    {{ $data->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    {{-- SweetAlert (jika dipakai) --}}
    @include('sweetalert::alert')
@endsection

@include('components.admFooter')