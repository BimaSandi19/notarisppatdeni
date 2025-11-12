<!-- *** Footer Start *** -->
<footer class="bg-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="fw-bold mb-4 text-center" style="color: #414141;">Address</h5>
                <p class="mb-2">
                <div class="med-icon-with-text">
                    <span class="iconify" data-icon="clarity:home-line" data-inline="true"></span>
                    <span>Jalan Mutiara Raya Blok D1-D2, Bencongan, Kec. Klp. Dua, Kabupaten Tangerang, Banten
                        15810</span>
                </div>
                </p>
                <p>
                <div class="med-icon-with-text">
                    <span class="iconify" data-icon="clarity:email-line" data-inline="true"></span>
                    <span>infonotdeninugraha@gmail.com</span>
                </div>
                </p>
            </div>
            <div class="col-lg-4 col-md-6 mb-4 d-flex flex-column text-center">
                <h5 class="fw-bold mb-4" style="color: #414141;">Opening Hours</h5>
                <div class="d-flex justify-content-between">
                    <span>Senin - Jumat</span>
                    <span>: 08.00 - 17.00</span>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mb-4 text-center">
                <h5 class="fw-bold mb-4" style="color: #414141;">Location</h5>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3284525492686!2d106.59376967399004!3d-6.2203476937676685!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ffcc0c386025%3A0x59ab1441c4847ea1!2sGedung%20DN%20Notaris%20%26%20PPAT!5e0!3m2!1sid!2sid!4v1721077603496!5m2!1sid!2sid"
                    width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">"
                </iframe>
            </div>
        </div>
        <hr style="border-top: 5px solid #CDD1D4; width: auto;" />
        <div class="row">
            <div class="col text-center">
                <p class=" fw-bold">©2024 DeniNugraha</p>
            </div>
        </div>
    </div>
</footer>
<!-- *** Footer End *** -->



<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- Carousel JS -->
<script src="assets\vendor\node_modules\owl-carousel\js\owl.carousel.min.js"></script>
<!-- jquery -->
<script src="assets\vendor\node_modules\jquery\dist\jquery.js"></script>
<script src="assets\vendor\node_modules\jquery\dist\jquery.min.js"></script>
<script src="assets\vendor\node_modules\jquery\src\jquery.js"></script>
<script src="js/custom.js"></script>
<script src="js/loader.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if (Session::has('success'))
            document.getElementById('preloader').style.display = 'none';
        @endif
    });

    document.addEventListener("DOMContentLoaded", function() {
        // Cek jika ada posisi scroll yang tersimpan
        if (sessionStorage.getItem("scrollPos")) {
            window.scrollTo(0, sessionStorage.getItem("scrollPos"));
            sessionStorage.removeItem("scrollPos");
        }

        document.querySelector("form").addEventListener("submit", function() {
            sessionStorage.setItem("scrollPos", window.scrollY);
        });
    });
</script>



</body>

</html>
