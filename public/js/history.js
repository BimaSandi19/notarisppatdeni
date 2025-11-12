// === History page scripts ===
document.addEventListener("DOMContentLoaded", function () {
    const tbody2 = document.querySelector("#table2 tbody");
    if (!tbody2) return; // not on history page

    // === Print Direct (Opens new window with ALL filtered data) ===
    const btnPrint = document.getElementById("printDirect");
    if (btnPrint) {
        btnPrint.addEventListener("click", (e) => {
            e.preventDefault();

            // Get the print URL with current query parameters
            const printUrl = btnPrint.getAttribute("href");

            // Open in new window/tab
            window.open(printUrl, "_blank", "width=1200,height=800");
        });
    }

    // === Export PDF & Excel now handled by server-side routes ===
    // PDF dan Excel akan generate semua data sesuai filter dari server

    // === Search sudah server-side (via form GET), tidak perlu client-side search ===
    // === Sort & Filter sudah server-side (via link GET), tidak perlu client-side sort ===
});
