{{-- Modal untuk Quick View Dashboard --}}
<div class="modal fade" id="quickStatsModal" tabindex="-1" aria-labelledby="quickStatsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title d-flex align-items-center" id="quickStatsModalLabel">
                    <iconify-icon id="modalIcon" icon="mdi:view-list" class="me-2"
                        style="font-size: 24px;"></iconify-icon>
                    <span id="modalTitle">Preview Data</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalLoading" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-3 text-muted">Memuat data...</p>
                </div>
                <div id="modalContent" style="display: none;">
                    <div class="alert alert-info d-flex align-items-center mb-3" role="alert">
                        <iconify-icon icon="mdi:information" class="me-2" style="font-size: 20px;"></iconify-icon>
                        <div>
                            Menampilkan <strong id="dataCount">0</strong> data teratas.
                            <span id="dataDescription"></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="modalTable">
                            <thead class="table-light">
                                <tr id="tableHeader"></tr>
                            </thead>
                            <tbody id="tableBody"></tbody>
                        </table>
                    </div>
                    <div id="emptyState" class="text-center py-5" style="display: none;">
                        <iconify-icon icon="mdi:database-off" style="font-size: 48px; color: #ccc;"></iconify-icon>
                        <p class="mt-3 text-muted">Tidak ada data yang tersedia</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-gold" data-bs-dismiss="modal">Tutup</button>
                <a href="#" id="modalViewAll" class="btn btn-navy d-inline-flex align-items-center gap-2">
                    Lihat Semua
                    <iconify-icon icon="mdi:arrow-right"></iconify-icon>
                </a>
            </div>
        </div>
    </div>
</div>