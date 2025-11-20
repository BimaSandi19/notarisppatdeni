@extends('components.admNavbar')

@section('title', 'Admin | Pengingat')
@section('page_title', 'Pengingat Tagihan')

@section('content')
    <div class="container-fluid py-3">
        {{-- Header --}}
        <div class="row align-items-center mb-3">
            <h2 class="mb-1 fw-semibold">Pengingat Tagihan</h2>
            <div class="col-lg-12 col-md-12 col-sm-6 py-2 px-3">
                <div class="card card-total-tagihan shadow-sm border-0">
                    <div class="card-body py-2">
                        <small class="text-muted fw-semibold d-block">Total Tagihan Aktif (Belum Lunas):</small>
                        <p class="fs-5 fw-semibold mb-0">Rp. {{ number_format($totalTagihan ?? 0, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Card: Actions + Table --}}
        <div class="card shadow-sm">
            <div
                class="card-header d-flex flex-column flex-md-row flex-sm-row align-items-md-center align-items-sm-center justify-content-between gap-2">
                <h5 class="card-title mb-0 fw-semibold">Informasi Tagihan</h5>

                <div
                    class="toolbar d-flex flex-column flex-md-row flex-sm-row align-items-md-center align-items-sm-center gap-2">

                    {{-- Sort & Filter --}}
                    <div class="dropdown">
                        <button class="btn btn-outline-soft dropdown-toggle" type="button" id="sortDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false" style="box-shadow:none; outline: none;">
                            Urutkan & Saring
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sortDropdown">
                            <li><a class="dropdown-item {{ !request('sort') ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.reminder') }}">
                                    <iconify-icon icon="mdi:clock-outline" width="16" height="16"
                                        class="me-1 align-middle"></iconify-icon>
                                    Data Terbaru Ditambahkan
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item {{ request('sort') === 'tanggal-desc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.reminder', ['sort' => 'tanggal-desc', 'q' => request('q')]) }}">Tanggal
                                    Jatuh Tempo (Terjauh)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'tanggal-asc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.reminder', ['sort' => 'tanggal-asc', 'q' => request('q')]) }}">Tanggal
                                    Jatuh Tempo (Terdekat)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'nominal-desc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.reminder', ['sort' => 'nominal-desc', 'q' => request('q')]) }}">Nominal
                                    Tagihan (Tertinggi)</a></li>
                            <li><a class="dropdown-item {{ request('sort') === 'nominal-asc' ? 'active fw-bold' : '' }}"
                                    href="{{ route('admin.reminder', ['sort' => 'nominal-asc', 'q' => request('q')]) }}">Nominal
                                    Tagihan (Terendah)</a></li>
                        </ul>
                    </div>

                    {{-- Search (server-side) --}}
                    <form action="{{ route('admin.reminder') }}" method="GET" class="d-flex">
                        <div class="input-group" style="width: 220px;">
                            <input name="q" value="{{ request('q') }}" type="text" id="searchInput"
                                class="form-control input-search" placeholder="Cari">

                            @if(request('q'))
                                <a href="{{ route('admin.reminder', ['sort' => request('sort')]) }}"
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

                    {{-- Tambah Reminder --}}
                    <button class="btn btn-gold fw-semibold d-flex align-items-center" type="button" data-bs-toggle="modal"
                        data-bs-target="#tambahReminder">
                        <iconify-icon icon="mdi:plus-box" width="22" height="22" class="me-1"
                            aria-hidden="true"></iconify-icon>
                        Tambah Tagihan
                    </button>
                </div>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered table-hover align-middle" id="tableReminder"
                    aria-describedby="table1-info">
                    <thead class="table-light text-center align-middle">
                        <tr>
                            <th style="width:50px">No</th>
                            <th>Nama Nasabah</th>
                            <th>Nomor Kwitansi</th>
                            <th>Nominal Tagihan</th>
                            <th>Status Pembayaran</th>
                            <th>Keterangan</th>
                            <th style="width: 120px">Tanggal Jatuh Tempo Tagihan</th>
                            <th style="width:160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyReminder">
                        @forelse ($data as $d)
                            <tr>
                                <td data-label="No" class="text-center">
                                    {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                                </td>
                                <td data-label="Nama">{{ $d->nama_nasabah }}</td>
                                <td data-label="No. Kwitansi">{{ $d->nomor_kwitansi }}</td>
                                <td data-label="Nominal" class="nominal"><span
                                        class="money">Rp.&nbsp;{{ number_format($d->nominal_tagihan, 0, ',', '.') }}</span></td>
                                <td data-label="Status" class="text-center">
                                    <span class="badge bg-warning text-dark">{{ $d->status_pembayaran }}</span>
                                </td>
                                <td data-label="Keterangan">{{ $d->keterangan }}</td>
                                <td data-label="Jatuh Tempo" class="text-center">
                                    @php
                                        $tanggalTagihan = \Carbon\Carbon::parse($d->tanggal_tagihan);
                                        $isOverdue = $tanggalTagihan->lt(\Carbon\Carbon::now()->startOfDay());
                                    @endphp

                                    @if($isOverdue)
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <span class="fw-bold"
                                                style="color: #721c24;">{{ $tanggalTagihan->format('d-m-Y') }}</span>
                                            <span class="badge bg-danger">(Jatuh Tempo)</span>
                                        </div>
                                    @else
                                        {{ $tanggalTagihan->format('d-m-Y') }}
                                    @endif
                                </td>
                                <td data-label="Aksi">
                                    <div class="d-flex gap-2 align-items-center justify-content-center">
                                        {{-- Edit button -> buka modal & kirim data-* --}}
                                        <button type="button" class="btn btn-primary btn-icon" data-bs-toggle="modal"
                                            data-bs-target="#editReminder" data-id="{{ $d->id }}"
                                            data-nama="{{ $d->nama_nasabah }}" data-kwitansi="{{ $d->nomor_kwitansi }}"
                                            data-nominal="{{ $d->nominal_tagihan }}" data-status="{{ $d->status_pembayaran }}"
                                            data-keterangan="{{ $d->keterangan }}"
                                            data-tanggal="{{ \Carbon\Carbon::parse($d->tanggal_tagihan)->format('Y-m-d') }}"
                                            title="Edit" aria-label="Edit">
                                            <iconify-icon icon="mdi:pencil" width="18" height="18"
                                                aria-hidden="true"></iconify-icon>
                                        </button>

                                        {{-- Cancel --}}
                                        <form action="{{ route('admin.reminder-delete', $d->id) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin membatalkan tagihan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                            <input type="hidden" name="q" value="{{ request('q') }}">
                                            <button type="submit" class="btn btn-danger btn-icon" title="Dibatalkan"
                                                aria-label="Dibatalkan">
                                                <iconify-icon icon="mdi:close-circle" width="18" height="18"
                                                    aria-hidden="true"></iconify-icon>
                                            </button>
                                        </form>

                                        {{-- Approve --}}
                                        <form
                                            action="{{ route('admin.reminder-approve', ['id' => $d->id, 'page' => request()->get('page')]) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menyetujui tagihan ini?');">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="page" value="{{ request('page') }}">
                                            <input type="hidden" name="q" value="{{ request('q') }}">
                                            <button type="submit" class="btn btn-success btn-icon" title="Lunas"
                                                aria-label="Lunas">
                                                <iconify-icon icon="mdi:check-circle" width="18" height="18"
                                                    aria-hidden="true"></iconify-icon>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted">Belum ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination (uses custom pagination template) --}}
                <div class="mt-3">
                    {{ $data->links('pagination::custom-bootstrap-5') }}
                </div>
            </div>
        </div>

        {{-- Modals --}}
        @include('components.modalReminder')
    </div>

    {{-- SweetAlert --}}
    @include('sweetalert::alert')

    {{-- Manual Success Toast --}}
    @if(session('success'))
        <script>
            // Fire immediately without waiting for DOMContentLoaded
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true
            });
        </script>
    @endif

    @if(session('error'))
        <script>
            // Fire immediately without waiting for DOMContentLoaded
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                timerProgressBar: true
            });
        </script>
    @endif
@endsection

@include('components.admFooter')