// Reminder page scripts (page-specific)
// This file is loaded globally but will early-return if not on the reminder page.
document.addEventListener("DOMContentLoaded", function () {
    const tbody = document.getElementById("tbodyReminder");
    if (!tbody) return; // not the reminder page

    // Search sudah server-side (via form GET), client-side search dihapus
    // Sort & Filter sudah server-side (via link GET), client-side sort dihapus

    // Isi modal Edit saat akan ditampilkan (Bootstrap modal)
    const editModal = document.getElementById("editReminder");
    if (editModal) {
        editModal.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;
            if (!button) return;

            const id = button.getAttribute("data-id");
            const nama = button.getAttribute("data-nama") || "";
            const kwitansi = button.getAttribute("data-kwitansi") || "";
            const nominal = button.getAttribute("data-nominal") || "";
            const status = button.getAttribute("data-status") || "Pending";
            const ket = button.getAttribute("data-keterangan") || "";
            const tanggal = button.getAttribute("data-tanggal") || "";

            const form = editModal.querySelector("form#editReminderForm");
            const baseAction = form?.getAttribute("data-action-base") || "";
            if (form && baseAction)
                form.setAttribute("action", baseAction.replace(":id", id));

            editModal.querySelector("#edit_id").value = id || "";
            editModal.querySelector("#nama_nasabah_edit").value = nama;

            // Set nomor kwitansi - readonly visible + hidden for submit
            editModal.querySelector("#nomor_kwitansi_edit").value = kwitansi;
            editModal.querySelector("#nomor_kwitansi_edit_hidden").value =
                kwitansi;

            // format and set nominal (visible + hidden)
            const nomVis = editModal.querySelector("#nominal_tagihan_edit");
            const nomHidden = editModal.querySelector(
                "#nominal_tagihan_edit_hidden",
            );
            const digits = (nominal || "").toString().replace(/\D/g, "");
            if (nomHidden) nomHidden.value = digits;
            if (nomVis)
                nomVis.value = digits
                    ? "Rp " + digits.replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                    : "";
            // set select visible status for edit modal
            const visStatus = editModal.querySelector(
                "#status_pembayaran_edit",
            );
            if (visStatus) visStatus.value = status;
            editModal.querySelector("#keterangan_edit").value = ket;
            // Set date value. If flatpickr instance exists, use setDate so altInput updates correctly.
            const tanggalInput = editModal.querySelector(
                "#tanggal_tagihan_edit",
            );
            if (tanggalInput) {
                if (tanggal && tanggalInput._flatpickr) {
                    try {
                        tanggalInput._flatpickr.setDate(tanggal, true);
                    } catch (e) {
                        // fallback to setting raw value
                        tanggalInput.value = tanggal;
                    }
                } else {
                    tanggalInput.value = tanggal;
                }
            }
        });
    }

    // === Nominal input formatting and hidden value sync ===
    function formatRupiahFromDigits(digits) {
        if (!digits) return "";
        return "Rp " + digits.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    const createNom = document.getElementById("nominal_tagihan_create");
    const createNomHidden = document.getElementById(
        "nominal_tagihan_create_hidden",
    );
    if (createNom) {
        createNom.addEventListener("input", (e) => {
            let digits = e.target.value.replace(/\D/g, "");
            if (digits.startsWith("-")) digits = digits.replace(/-/g, "");
            if (createNomHidden) createNomHidden.value = digits;
            e.target.value = formatRupiahFromDigits(digits);
        });
        // ensure proper formatting on focus out
        createNom.addEventListener("blur", (e) => {
            const digits = e.target.value.replace(/\D/g, "");
            e.target.value = formatRupiahFromDigits(digits);
        });
    }

    const editNom = document.getElementById("nominal_tagihan_edit");
    const editNomHidden = document.getElementById(
        "nominal_tagihan_edit_hidden",
    );
    if (editNom) {
        editNom.addEventListener("input", (e) => {
            let digits = e.target.value.replace(/\D/g, "");
            if (digits.startsWith("-")) digits = digits.replace(/-/g, "");
            if (editNomHidden) editNomHidden.value = digits;
            e.target.value = formatRupiahFromDigits(digits);
        });
        editNom.addEventListener("blur", (e) => {
            const digits = e.target.value.replace(/\D/g, "");
            e.target.value = formatRupiahFromDigits(digits);
        });
    }

    // Initialize flatpickr on date fields to avoid flicker and provide smooth calendar
    try {
        if (typeof flatpickr !== "undefined") {
            document.querySelectorAll(".date-picker").forEach((el) => {
                // prevent double-init
                if (el._flatpickr) return;
                const inst = flatpickr(el, {
                    // store ISO value (for backend) but show alt in DD-MM-YYYY
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: "d-m-Y",
                    allowInput: true,
                    clickOpens: true,
                    locale: "id",
                    // ensure calendar appears above modal/backdrop
                    onOpen: function (selectedDates, dateStr, instance) {
                        if (instance.calendarContainer)
                            instance.calendarContainer.style.zIndex = 2000;
                    },
                });
                // keep instance reference on element for toggle via button
                if (inst) el._flatpickr = inst;
            });
        }
    } catch (e) {
        // if flatpickr not available or error occurs, fail silently
        console.warn("flatpickr init error", e);
    }

    // Attach calendar toggle handlers (unobtrusive) for buttons with .btn-toggle-calendar
    document.querySelectorAll(".btn-toggle-calendar").forEach((btn) => {
        btn.addEventListener("click", (ev) => {
            const target = btn.getAttribute("data-target");
            if (!target) return;
            const input = document.querySelector(target);
            if (!input) return;
            // toggle flatpickr instance if available, otherwise focus
            if (input._flatpickr) input._flatpickr.toggle();
            else input.focus();
        });
    });

    // Form validation for nominal on submit (create & edit)
    function validateNominal(visibleEl, hiddenEl) {
        const digits = hiddenEl?.value || visibleEl?.value.replace(/\D/g, "");
        return digits && Number(digits) > 0;
    }

    const tambahForm = document.getElementById("tambahReminderForm");
    const btnTambahSubmit = document.getElementById("btnTambahSubmit");

    if (tambahForm) {
        // Validation
        tambahForm.addEventListener("submit", function (e) {
            // ========== PREVENT DOUBLE SUBMIT FIRST ==========
            if (btnTambahSubmit && btnTambahSubmit.disabled) {
                e.preventDefault();
                return false; // Already submitting, block duplicate
            }

            const vis = document.getElementById("nominal_tagihan_create");
            const hid = document.getElementById(
                "nominal_tagihan_create_hidden",
            );
            if (!validateNominal(vis, hid)) {
                e.preventDefault();
                vis.classList.add("is-invalid");
                vis.focus();
                return; // Stop here if validation fails
            }

            // Disable button IMMEDIATELY
            if (btnTambahSubmit) {
                // Disable button
                btnTambahSubmit.disabled = true;

                // Show spinner, hide text
                const btnText = btnTambahSubmit.querySelector(".btn-text");
                const spinner =
                    btnTambahSubmit.querySelector(".spinner-border");
                if (btnText) btnText.classList.add("d-none");
                if (spinner) spinner.classList.remove("d-none");

                // Optional: Re-enable setelah 5 detik jika ada error (fallback)
                setTimeout(() => {
                    btnTambahSubmit.disabled = false;
                    if (btnText) btnText.classList.remove("d-none");
                    if (spinner) spinner.classList.add("d-none");
                }, 5000);
            }
        });

        // remove invalid state on input
        const visCreate = document.getElementById("nominal_tagihan_create");
        if (visCreate)
            visCreate.addEventListener("input", () =>
                visCreate.classList.remove("is-invalid"),
            );
    }

    const editForm = document.getElementById("editReminderForm");
    const btnEditSubmit = document.getElementById("btnEditSubmit");

    if (editForm) {
        // Validation
        editForm.addEventListener("submit", function (e) {
            // ========== PREVENT DOUBLE SUBMIT FIRST ==========
            if (btnEditSubmit && btnEditSubmit.disabled) {
                e.preventDefault();
                return false; // Already submitting, block duplicate
            }

            const vis = document.getElementById("nominal_tagihan_edit");
            const hid = document.getElementById("nominal_tagihan_edit_hidden");
            if (!validateNominal(vis, hid)) {
                e.preventDefault();
                vis.classList.add("is-invalid");
                vis.focus();
                return;
            }

            // Cek apakah status pembayaran diubah menjadi Lunas atau Dibatalkan
            const statusSelect = document.getElementById(
                "status_pembayaran_edit",
            );
            const statusBaru = statusSelect?.value;

            if (statusBaru === "Lunas" || statusBaru === "Dibatalkan") {
                const konfirmasi = confirm(
                    `Tagihan akan diubah menjadi "${statusBaru}" dan dipindahkan ke halaman Riwayat.\n\nApakah Anda yakin?`,
                );
                if (!konfirmasi) {
                    e.preventDefault();
                    return;
                }
            }

            // Disable button IMMEDIATELY
            if (btnEditSubmit) {
                // Disable button
                btnEditSubmit.disabled = true;

                // Show spinner, hide text
                const btnText = btnEditSubmit.querySelector(".btn-text");
                const spinner = btnEditSubmit.querySelector(".spinner-border");
                if (btnText) btnText.classList.add("d-none");
                if (spinner) spinner.classList.remove("d-none");

                // Optional: Re-enable setelah 5 detik jika ada error (fallback)
                setTimeout(() => {
                    btnEditSubmit.disabled = false;
                    if (btnText) btnText.classList.remove("d-none");
                    if (spinner) spinner.classList.add("d-none");
                }, 3000);
            }
        });

        const visEdit = document.getElementById("nominal_tagihan_edit");
        if (visEdit)
            visEdit.addEventListener("input", () =>
                visEdit.classList.remove("is-invalid"),
            );
    }
});
