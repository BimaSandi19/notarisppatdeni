var loader = document.getElementById("preloader");

window.addEventListener("load", function () {
    setTimeout(function () {
        loader.style.opacity = "0"; // Ubah opacity menjadi 0 untuk memulai transisi
        setTimeout(function () {
            loader.style.display = "none"; // Sembunyikan preloader setelah transisi selesai
        }, 750); // Waktu sesuai dengan durasi transisi CSS (1 detik)
    }, 1500); // Delay sebelum memulai transisi (2 detik)
});
