// ===== DASHBOARD MODAL QUICK STATS =====
document.addEventListener("DOMContentLoaded", () => {
    const modal = new bootstrap.Modal(
        document.getElementById("quickStatsModal"),
    );
    const modalElement = document.getElementById("quickStatsModal");

    const modalTitle = document.getElementById("modalTitle");
    const modalIcon = document.getElementById("modalIcon");
    const modalLoading = document.getElementById("modalLoading");
    const modalContent = document.getElementById("modalContent");
    const emptyState = document.getElementById("emptyState");
    const dataCount = document.getElementById("dataCount");
    const dataDescription = document.getElementById("dataDescription");
    const tableHeader = document.getElementById("tableHeader");
    const tableBody = document.getElementById("tableBody");
    const modalViewAll = document.getElementById("modalViewAll");

    // Config untuk setiap card type
    const cardConfig = {
        lunas: {
            title: "Tagihan Lunas Terbaru",
            icon: "mdi:check-decagram",
            description: "Diurutkan berdasarkan tanggal terbaru",
            viewAllLink: dashboardRoutes.history,
            headers: [
                "No",
                "Nama Nasabah",
                "No. Kwitansi",
                "Nominal",
                "Tanggal",
            ],
            columns: ["nama", "kwitansi", "nominal", "tanggal"],
        },
        dibatalkan: {
            title: "Tagihan Dibatalkan Terbaru",
            icon: "mdi:close-octagon-outline",
            description: "Diurutkan berdasarkan tanggal terbaru",
            viewAllLink: dashboardRoutes.history,
            headers: [
                "No",
                "Nama Nasabah",
                "No. Kwitansi",
                "Nominal",
                "Tanggal",
            ],
            columns: ["nama", "kwitansi", "nominal", "tanggal"],
        },
        "belum-lunas": {
            title: "Mendekati Jatuh Tempo",
            icon: "mdi:alert-circle-outline",
            description: "Diurutkan berdasarkan tagihan terlama",
            viewAllLink: dashboardRoutes.reminder,
            headers: [
                "No",
                "Nama Nasabah",
                "No. Kwitansi",
                "Nominal",
                "Tanggal Tagihan",
            ],
            columns: ["nama", "kwitansi", "nominal", "tanggal"],
        },
        "nominal-tinggi": {
            title: "Tagihan Nominal Tertinggi",
            icon: "mdi:cash-multiple",
            description: "Diurutkan berdasarkan nominal terbesar",
            viewAllLink: dashboardRoutes.reminder,
            headers: [
                "No",
                "Nama Nasabah",
                "No. Kwitansi",
                "Nominal",
                "Tanggal",
            ],
            columns: ["nama", "kwitansi", "nominal", "tanggal"],
        },
    };

    // Click handler untuk card
    document.querySelectorAll(".dashboard-card").forEach((card) => {
        card.addEventListener("click", function (e) {
            // Jangan trigger jika klik pada link footer
            if (e.target.closest(".card-footer a")) {
                return;
            }

            e.preventDefault();
            const cardType = this.getAttribute("data-card-type");
            loadQuickStats(cardType);
        });

        // Hover handlers untuk remove border dan shadow saat hover footer
        const cardBody = card.querySelector(".card-body");
        const cardFooter = card.querySelector(".card-footer");

        if (cardBody && cardFooter) {
            cardBody.addEventListener("mouseenter", function () {
                card.classList.add("body-hovered");
            });

            cardBody.addEventListener("mouseleave", function () {
                card.classList.remove("body-hovered");
            });

            cardFooter.addEventListener("mouseenter", function () {
                card.classList.remove("body-hovered");
            });
        }
    });

    function loadQuickStats(type) {
        const config = cardConfig[type];
        if (!config) return;

        // Setup modal
        modalTitle.textContent = config.title;
        modalIcon.setAttribute("icon", config.icon);
        modalViewAll.href = config.viewAllLink;
        dataDescription.textContent = config.description;

        // Show modal with loading
        modalLoading.style.display = "block";
        modalContent.style.display = "none";
        modal.show();

        // Fetch data
        fetch(`${dashboardRoutes.quickStats}?type=${type}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.success && data.data.length > 0) {
                    dataCount.textContent = data.count;

                    // Build table header
                    tableHeader.innerHTML = config.headers
                        .map((h) => `<th>${h}</th>`)
                        .join("");

                    // Build table body
                    tableBody.innerHTML = data.data
                        .map((item, index) => {
                            const cells = config.columns
                                .map((col) => {
                                    let value = item[col];
                                    let cellClass = "";

                                    // Highlight tagihan yang sudah jatuh tempo (overdue)
                                    if (col === "tanggal" && item.is_overdue) {
                                        value = `<span class="badge bg-danger">${value} (Jatuh Tempo)</span>`;
                                    }

                                    return `<td ${cellClass}>${value}</td>`;
                                })
                                .join("");

                            return `<tr>
                            <td>${index + 1}</td>
                            ${cells}
                        </tr>`;
                        })
                        .join("");

                    emptyState.style.display = "none";
                    document.getElementById("modalTable").style.display =
                        "table";
                } else {
                    emptyState.style.display = "block";
                    document.getElementById("modalTable").style.display =
                        "none";
                }

                // Hide loading, show content
                modalLoading.style.display = "none";
                modalContent.style.display = "block";
            })
            .catch((error) => {
                console.error("Error:", error);
                modalLoading.innerHTML = `
                    <div class="alert alert-danger">
                        <iconify-icon icon="mdi:alert-circle" class="me-2"></iconify-icon>
                        Gagal memuat data. Silakan coba lagi.
                    </div>
                `;
            });
    }
});
