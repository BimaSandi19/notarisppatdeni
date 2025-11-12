    @include('components.navbar')
    <!-- *** Carousel Start *** -->
    <div class="mb-5">
        <div id="mainBanner" class="carousel carousel-dark slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#mainBanner" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#mainBanner" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#mainBanner" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <div class="carousel-item homecarousel-item active" data-bs-interval="5000">
                    <img src="{{ asset('images/kantor1.jpg') }}" style="height: 700px;" alt="..." />
                </div>
                <div class="carousel-item homecarousel-item" data-bs-interval="5000">
                    <img src="{{ asset('images/akad15.jpg') }}" style="height: 700px;" alt="..." />
                </div>
                <div class="carousel-item homecarousel-item" data-bs-interval="5000">
                    <img src="{{ asset('images/akad16.jpg') }}" style="height: 700px;" alt="..." />
                </div>
                <div
                    class="carousel-caption homecarousel-caption d-flex flex-column justify-content-center align-items-center text-white">
                    <h5>Gedung Notaris</h5>
                    <h5>DENI NUGRAHA SE., SH., M.Kn</h5>
                    <p>Profesionalisme dan Kepercayaan dalam Setiap Layanan Notaris</p>
                </div>
            </div>
        </div>
    </div>
    <!-- *** Carousel End *** -->

    <!-- *** Our Service Start *** -->
    <div class="service container">
        <div class="row d-flex">
            <div class="col-lg-6 col-sm-12 mb-4">
                <div class="mb-4">
                    <h1>
                        <span class="iconify" data-icon="mdi:customer-service" data-inline="true"></span>
                        | Our Services
                    </h1>
                </div>
                <div style="text-align: justify;">
                    <p class="">
                        Kantor Notaris Deni Nugraha, SE., SH., M.Kn menyediakan berbagai
                        layanan notaris yang meliputi pembuatan akta, pengesahan dokumen,
                        perjanjian dan kontrak, layanan wasiat dan waris, layanan
                        perbankan, konsultasi hukum, pengurusan izin usaha, dan perubahan
                        status kewarganegaraan. Dengan profesionalisme dan pengalaman yang
                        kami miliki, kami siap membantu Anda dalam setiap aspek hukum
                        dengan cepat dan efisien, memastikan semua kebutuhan legal Anda
                        terpenuhi dengan baik dan tepat waktu.
                    </p>
                </div>
                <div class="d-flex align-items-center gap-2 mt-4">
                    <span class="iconify" data-icon="mdi:shield-check" data-inline="true"
                        style="font-size: 32px"></span>
                    <span class="fw-bold small">Terpercaya</span>
                    <span class="iconify" data-icon="mdi:certificate" data-inline="true" style="font-size: 32px"></span>
                    <span class="fw-bold small">Legalitas</span>
                </div>
            </div>
            <!-- card -->
            <div class="col-lg-6 col-12">
                <div class="row justify-content-center align-items-start">
                    <div class="col-lg-5 col-md-6 col-sm-12 mb-4 me-lg-3">
                        <div class="card cardour d-flex align-items-center">
                            <img src="{{ asset('images/icon/logonotaris.png') }}" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="layananAccordion">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="acc1Head">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#acc1" aria-expanded="false"
                                                aria-controls="acc1">
                                                Layanan Notaris
                                            </button>
                                        </h2>
                                        <div id="acc1" class="accordion-collapse collapse"
                                            aria-labelledby="acc1Head" data-bs-parent="#layananAccordion">
                                            <div class="accordion-body" style="text-align: center">
                                                Layanan Notaris adalah jasa yang diberikan oleh notaris, pejabat yang
                                                diangkat oleh pemerintah untuk membuat Akta Otentik untuk berbagai
                                                perbuatan, perjanjian, dan ketetapan hukum seperti akta kelahiran,
                                                pernikahan, pendirian perusahaan, dan jual beli.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12 mb-lg-4 ms-lg-2">
                        <div class="card cardour d-flex align-items-center">
                            <img src="{{ asset('images/icon/logoippat.png') }}" class="card-img-top" alt="..." />
                            <div class="card-body">
                                <div class="accordion accordion-flush" id="layananAccordion2">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="acc2Head">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#acc2" aria-expanded="false"
                                                aria-controls="acc2">
                                                Layanan PPAT
                                            </button>
                                        </h2>
                                        <div id="acc2" class="accordion-collapse collapse"
                                            aria-labelledby="acc2Head" data-bs-parent="#layananAccordion2">
                                            <div class="accordion-body" style="text-align: center">
                                                Layanan PPAT (Pejabat Pembuat Akta Tanah) adalah jasa yang diberikan
                                                oleh PPAT untuk membuat Akta Otentik terkait peralihan hak atas tanah
                                                dan Hak Milik Atas Satuan Rumah Susun, seperti akta jual beli, tukar
                                                menukar, dan hibah tanah.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /card -->
            </div>
        </div>
    </div>
    </div>
    <!-- *** Our Service End *** -->

    <!-- *** Team Start *** -->
    <div class="container-xxl py-5">
        <div class="container align-items-center ms-auto">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="text-info text-uppercase">
                    owner
                </h6>
                <h1 class="mb-5 text-uppercase">
                    Kantor Notaris Deni Nugraha
                </h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-content">
                        <div class="position-relative overflow-hidden">
                            <img class="img-fluid" src="{{ asset('images/PakDN.jpg') }}" alt="">
                        </div>
                        <div class="team-text">
                            <div class="bg-light">
                                <h5 class="fw-bold text-center mb-0 text-uppercase">DENI NUGRAHA SE., SH., M.Kn
                                </h5>
                            </div>
                            <div class="bg-primary">
                                <a type="button" class="btn btn-square mx-1" href="" data-bs-toggle="modal"
                                    data-bs-target="#dnInfo">
                                    <span class="iconify" data-icon="ic:baseline-info" data-inline="true"></span>
                                    info
                                </a>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="dnInfo" tabindex="-1" aria-labelledby="dnInfoLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="dnInfoLabel">Tentang Deni Nugraha</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p style="text-align:justify;">
                                                Lulusan dari Universitas Sangga Buana dalam bidang Sarjana Ekonomi,
                                                Universitas Islam Syekh Yusuf dalam bidang Sarjana Hukum, dan
                                                Universitas Diponegoro dengan gelar Magister Kenotariatan. Bertempat
                                                kedudukan di Kabupaten Tangerang, Provinsi Banten. Siap memberikan
                                                pelayanan notaris yang profesional dan terpercaya untuk memenuhi
                                                berbagai kebutuhan hukum dan kenotariatan Anda dan telah menangani
                                                berbagai kasus hukum perusahaan dan perorangan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /Modal -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *** Team Start *** -->

    <!-- *** Form Start *** -->
    <div class="bg-form mb-5" id="sendMail">
        <div class="container p-5">
            <div class="row justify-content-center">
                <div class="d-flex col-lg-6 col-md-6 col-sm-12 ">
                    <div class="container mt-3 py-5" style="color: #ffffff;">
                        <h1 class="consultant">
                            Get answers and advice from Professional Consultants.
                        </h1>
                        <hr class="thick-hr my-4" />
                        <div class="icon-with-text mb-3">
                            <span class="iconify large-icon" style="color: #ffffff"
                                data-icon="hugeicons:maps-location-01" data-inline="true"></span>
                            <span style="color: #ffffff;">Our Location<br />Jalan Mutiara Raya Blok D1 - D2, Bencongan,
                                Tangerang, Banten 15810.</span>
                        </div>
                        <hr class="white-hr my-2" />
                        <div class="icon-with-text mb-3">
                            <span class="iconify large-icon" style="color: #ffffff"
                                data-icon="mdi:email-fast-outline" data-inline="true"></span>
                            <span style="color: #ffffff;">Our Email<br />infonotdeninugraha@gmail.com</span>
                        </div>
                        <hr class="white-hr my-2" />
                    </div>
                </div>
                <div class="d-flex col-lg-6 col-md-6 col-sm-12 ">
                    <div class="form-container mt-4 mb-4 py-4 w-100">
                        <form action="{{ route('send-proses') }}#form-container" method="POST">
                            @csrf
                            <h5 class="mb-2 mt-3 fw-bold text-center">
                                Let's talk about your Business.
                            </h5>
                            <div class="mb-2 px-4">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control colored-input"
                                    id="name" required />
                            </div>
                            <div class="mb-2 px-4">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control colored-input"
                                    id="email" required />
                            </div>
                            <div class="mb-2 px-4">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" name="subject" class="form-control colored-input"
                                    id="subject" required />
                            </div>
                            <div class="mb-3 px-4">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control colored-input" name="message" id="message" rows="3" required></textarea>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    Send
                                </button>
                            </div>
                        </form>
                        @if (session()->has('success'))
                            <script>
                                Swal.fire({
                                    title: "Pesan Berhasil Terkirim!",
                                    icon: "success"
                                });
                            </script>
                        @endif
                        @if (session()->has('error'))
                            <script>
                                Swal.fire({
                                    title: "Gagal Mengirim Pesan!",
                                    text: "{{ session('error') }}",
                                    icon: "error"
                                });
                            </script>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- *** Form End *** -->

    <!-- Our Schedule Start -->
    <div class="schedule container-fluid mb-5 p-5 d-flex justify-content-center">
        <div class="container row align-items-center">
            <div class="col-lg-4 d-md-flex justify-content-center col-sm-12">
                <img src="images/background3.jpg" class="img-fluid" alt="Schedule Image" />
            </div>
            <div class="col-lg-8 d-md-flex justify-content-center col-sm-12">
                <div class="container">
                    <div class="flex-sm-row">
                        <div class="col-lg-12 d-sm-flex  justify-content-sm-center mb-4 ">
                            <h1 class="text-center fw-bold d-sm-flex " style="color: #414141;">Our Schedule</h1>
                        </div>
                        <div class="row fw-bold" style="color: #414141; font-size: large;">
                            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column mb-4 text-center text-sm-start">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <span>&middot; Monday</span>
                                    <span>: 08.00 - 17.00</span>
                                </div>
                                <br>
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <span>&middot; Tuesday</span>
                                    <span>: 08.00 - 17.00</span>
                                </div>
                                <br>
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <span>&middot; Wednesday</span>
                                    <span>: 08.00 - 17.00</span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 d-flex flex-column text-center text-sm-start">
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <span>&middot; Thursday</span>
                                    <span>: 08.00 - 17.00</span>
                                </div>
                                <br>
                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center">
                                    <span>&middot; Friday</span>
                                    <span>: 08.00 - 17.00</span>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Our Schedule End -->

    <!-- *** Partner Start *** -->
    <div class="mitra p-5">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="text-primary text-uppercase">
                our partners
            </h6>
            <h1 class="mb-5 text-uppercase">
                Mitra Kerja Notaris DN
            </h1>
        </div>
        <div class="container-fluid">
            <div class="slider">
                <div class="slider-track" id="sliderTrack">
                    <!-- slider -->
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bprCakrawala.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bprSyariah.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bri.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bsi.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/btn.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/dki.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/KB-Bukopin.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/mandiri.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/pnm.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/pnmVenture.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/ragasakti.jpg') }}" alt="">
                    </div>

                    <!-- slider (double) -->
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bprCakrawala.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bprSyariah.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bri.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bsi.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/btn.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/dki.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/KB-Bukopin.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/mandiri.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/pnm.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/pnmVenture.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/ragasakti.jpg') }}" alt="">
                    </div>
                    <div class="slider-item p-4">
                        <img src="{{ asset('images/gallery/bni.png') }}" alt="">
                    </div>
                    <!-- /slider -->
                </div>
            </div>
        </div>
    </div>
    <!-- *** Partner End *** -->
    @include('components.footer')
