{{-- ================= MODAL TAMBAH ================= --}}
<div class="modal fade" id="tambahReminder" tabindex="-1" aria-labelledby="tambahReminderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahReminderLabel">Form Tambah Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.reminder-store') }}" method="POST" id="tambahReminderForm">
                @csrf
                <div class="modal-body">
                    {{-- Error Alert --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ada kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_nasabah_create" class="form-label">Nama Nasabah</label>
                                <input type="text" class="form-control @error('nama_nasabah') is-invalid @enderror" id="nama_nasabah_create" name="nama_nasabah"
                                    value="{{ old('nama_nasabah') }}" required>
                                @error('nama_nasabah')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomor_kwitansi_create" class="form-label">Nomor Kwitansi</label>
                                <input type="text" class="form-control @error('nomor_kwitansi') is-invalid @enderror" id="nomor_kwitansi_create" name="nomor_kwitansi"
                                    value="{{ old('nomor_kwitansi') }}" required>
                                @error('nomor_kwitansi')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nominal_tagihan_create" class="form-label">Nominal Tagihan</label>
                                <input type="text" inputmode="numeric" class="form-control @error('nominal_tagihan') is-invalid @enderror" id="nominal_tagihan_create"
                                    placeholder="Rp 0" value="{{ old('nominal_tagihan') }}" required>
                                <input type="hidden" name="nominal_tagihan" id="nominal_tagihan_create_hidden" value="">
                                <div class="invalid-feedback">Nominal harus diisi dan lebih besar dari 0.</div>
                                @error('nominal_tagihan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_pembayaran_create_disabled" class="form-label">Status
                                    Pembayaran</label>
                                <select id="status_pembayaran_create_disabled" class="form-select" disabled>
                                    <option value="Pending" selected>Pending</option>
                                </select>
                                <input type="hidden" name="status_pembayaran" id="status_pembayaran_create_hidden"
                                    value="Pending">
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_create" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan_create" name="keterangan"
                                    rows="3">{{ old('keterangan') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_tagihan_create" class="form-label">Tanggal Jatuh Tempo
                                    Tagihan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-picker @error('tanggal_tagihan') is-invalid @enderror" id="tanggal_tagihan_create"
                                        name="tanggal_tagihan" placeholder="dd-mm-yyyy" value="{{ old('tanggal_tagihan') }}" required>
                                    <button class="btn btn-outline-secondary btn-toggle-calendar" type="button"
                                        aria-label="Buka kalender" data-target="#tanggal_tagihan_create">
                                        <iconify-icon icon="mdi:calendar" width="18" height="18"></iconify-icon>
                                    </button>
                                </div>
                                @error('tanggal_tagihan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold" id="btnTambahSubmit">
                        <span class="btn-text">Tambah</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= MODAL EDIT ================= --}}
<div class="modal fade" id="editReminder" tabindex="-1" aria-labelledby="editReminderLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReminderLabel">Form Edit Tagihan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            {{-- Catatan: data-action-base menyimpan template URL update. Ganti :id saat show.bs.modal --}}
            <form method="POST" id="editReminderForm" data-action-base="{{ route('admin.reminder-update', ':id') }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    {{-- Error Alert --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Ada kesalahan:</strong>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <input type="hidden" name="reminder_id" id="edit_id">
                    <input type="hidden" name="page" value="{{ request('page', 1) }}">
                    <input type="hidden" name="q" value="{{ request('q', '') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_nasabah_edit" class="form-label">Nama Nasabah</label>
                                <input type="text" class="form-control @error('nama_nasabah') is-invalid @enderror" id="nama_nasabah_edit" name="nama_nasabah"
                                    value="{{ old('nama_nasabah') }}" required>
                                @error('nama_nasabah')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nomor_kwitansi_edit" class="form-label">Nomor Kwitansi</label>
                                <input type="text" class="form-control" id="nomor_kwitansi_edit"
                                    style="cursor: not-allowed" disabled
                                    title="Nomor kwitansi tidak dapat diubah setelah tagihan dibuat">
                                <!-- Hidden input untuk submit form -->
                                <input type="hidden" name="nomor_kwitansi" id="nomor_kwitansi_edit_hidden">
                            </div>

                            <div class="mb-3">
                                <label for="nominal_tagihan_edit" class="form-label">Nominal Tagihan</label>
                                <input type="text" inputmode="numeric" class="form-control @error('nominal_tagihan') is-invalid @enderror" id="nominal_tagihan_edit"
                                    placeholder="Rp 0" value="{{ old('nominal_tagihan') }}" required>
                                <input type="hidden" name="nominal_tagihan" id="nominal_tagihan_edit_hidden" value="">
                                <div class="invalid-feedback">Nominal harus diisi dan lebih besar dari 0.</div>
                                @error('nominal_tagihan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="status_pembayaran_edit" class="form-label">Status
                                    Pembayaran</label>
                                <select id="status_pembayaran_edit" name="status_pembayaran" class="form-select">
                                    <option value="Lunas" {{ old('status_pembayaran') == 'Lunas' ? 'selected' : '' }}>Lunas</option>
                                    <option value="Pending" {{ old('status_pembayaran') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Dibatalkan" {{ old('status_pembayaran') == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="keterangan_edit" class="form-label">Keterangan</label>
                                <textarea class="form-control" id="keterangan_edit" name="keterangan"
                                    rows="3">{{ old('keterangan') }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal_tagihan_edit" class="form-label">Tanggal Tagihan</label>
                                <div class="input-group">
                                    <input type="text" class="form-control date-picker @error('tanggal_tagihan') is-invalid @enderror" id="tanggal_tagihan_edit"
                                        name="tanggal_tagihan" placeholder="dd-mm-yyyy" value="{{ old('tanggal_tagihan') }}" required>
                                    <button class="btn btn-outline-secondary btn-toggle-calendar" type="button"
                                        aria-label="Buka kalender" data-target="#tanggal_tagihan_edit">
                                        <iconify-icon icon="mdi:calendar" width="18" height="18"></iconify-icon>
                                    </button>
                                </div>
                                @error('tanggal_tagihan')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-gold" id="btnEditSubmit">
                        <span class="btn-text">Simpan Perubahan</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>