@include('components.navbar')
<!-- *** main banner start *** -->
<div class="page-heading">
    <div class="container">
        <div class="row">
            <div class="col-lg header-text text-center">
                <h1>Galeri Kegiatan<br>Kantor Notaris Deni Nugraha</h1>
                <p>Mengabadikan Momen Berharga Serta Menyatu dalam Setiap Langkah dan Proses Penting.</p>
            </div>
        </div>
    </div>
</div>
<div class="top-categories">
    <div class="container d-flex justify-content-center">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <div class="card card-categories">
                    <div class="card-body">
                        <span class="iconify" data-icon="flat-color-icons:edit-image" style="font-size: 48px;"
                            data-inline="true"></span>
                        <h5 class="card-title">Kegiatan Notaris & PPAT</h5>
                        <hr>
                        <div class="border-button">
                            <a href="#activ1" class="btn btn-outline-primary rounded-pill">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 ">
                <div class="card card-categories">
                    <div class="card-body">
                        <span class="iconify" data-icon="logos:imagemin" style="font-size: 48px;"
                            data-inline="true"></span>
                        <h5 class="card-title">Kegiatan Lainnya</h5>
                        <hr class="setara">
                        <a href="#activ2" class="btn btn-outline-primary rounded-pill">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- *** main banner end *** -->

{{-- Highlight Start --}}
<section class="featured-highlight mb-5">
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h6 class="mb-2" style="color: #0874a7"><em>Highlight</em></h6>
                    <h2 class="mb-2 fw-bold">Dokumentasi Kegiatan</h2>
                    <h2 class="mb-5 fw-bold" style="color: #0874a7">Kantor Notaris Deni Nugraha</h2>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/akad10.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Akad Jual Beli Tanah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/penyerahan1.jpeg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Penyerahan Website</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/kegiatan1.JPG') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p style="text-align: center">Wisata ke Pulau Pari<br>Keluarga Besar Kantor DN
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/kegiatan2.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p style="text-align: center">Pembagian Hadiah<br>Lomba 17 Agustusan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/kegiatan3.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p style="text-align: center">Penghargaan Kepada<br>Bapak Deni Nugraha, SE., SH., M.Kn
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Highlight End --}}

<div class="border my-5"></div>

{{-- Kegiatan Notaris & PPAT --}}
<section class="featured-highlight mb-5" id="activ1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h5 class="mb-2" style="color: #0874a7">Kegiatan Notaris & PPAT</h5>
                    <h2 class="mb-2 fw-bold">Dokumentasi Kegiatan</h2>
                    <h2 class="mb-5 fw-bold" style="color: #0874a7">Kantor Notaris Deni Nugraha</h2>
                </div>
            </div>
            {{-- carousel --}}
            <div class="container py-5 mb-2">
                <div id="carouselExampleInterval" class="carousel slide rousel-container" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Notaris & PPAT</h5>
                                    <h3 class="mb-3">Pembuatan Akta Otentik</h3>
                                    <p class="fs-10 fw-medium mb-3">Membuat dokumen hukum resmi seperti akta jual beli,
                                        akta pendirian perusahaan, dan akta hibah.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="{{ asset('images/akad11.jpg') }}" class="d-block w-100 carousel-gallery"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Notaris & PPAT</h5>
                                    <h3 class="mb-3">Pembuatan Akta Jual Beli Tanah</h3>
                                    <p class="fs-10 fw-medium mb-3">Membuat akta yang mengesahkan peralihan hak atas
                                        tanah dari penjual ke pembeli.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="{{ asset('images/akad12.jpg') }}" class="d-block w-100 carousel-gallery"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Notaris & PPAT</h5>
                                    <h3 class="mb-3">Pelaksanaan Akad Kredit Perumahan</h3>
                                    <p class="fs-10 fw-medium mb-3" style="text-align: justify">Memastikan bahwa
                                        seluruh proses akad kredit perumahan dilakukan secara sah, transparan, dan
                                        sesuai dengan peraturan perundang-undangan yang berlaku. Dengan demikian,
                                        notaris membantu melindungi hak-hak semua pihak dan mencegah potensi sengketa di
                                        kemudian hari.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="{{ asset('images/akad9.jpg') }}" class="d-block w-100 carousel-gallery"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            {{-- carousel --}}
        </div>
        <div class="row mt-5">
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/akad10.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Akad Jual Beli Tanah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/akad16.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Akad Kredit (Perbankan)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/akad5.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Akad Jual Beli</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/kegiatan3.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p style="text-align: center">Penghargaan Kepada<br>Bapak Deni Nugraha, SE., SH., M.Kn
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card card-highlight w-auto">
                    <img src="{{ asset('images/kegiatan4.jpg') }}" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Notaris & PPAT</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="emojione:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p style="text-align: center">Penghargaan Kepada<br>Bapak Deni Nugraha, SE., SH., M.Kn
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Kegiatan Notaris & PPAT --}}

<div class="border my-5"></div>

{{-- Kegiatan Lainnya --}}
<section class="featured-highlight" id="activ2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h5 class="mb-2" style="color: #0874a7">Kegiatan Lainnya</h5>
                    <h2 class="mb-2 fw-bold">Dokumentasi Kegiatan</h2>
                    <h2 class="mb-5 fw-bold" style="color: #0874a7">Kantor Notaris Deni Nugraha</h2>
                </div>
            </div>
            {{-- carousel --}}
            <div class="container py-5 mb-2">
                <div id="carouselExampleInterval1" class="carousel slide rousel-container" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Kegiatan Lainnya</h5>
                                    <h3 class="mb-3">Penyerahan Website kepada Kantor Notaris & PPAT Deni Nugraha,
                                        S.E., S.H., M.Kn.</h3>
                                    <p class="fs-10 fw-medium mb-3">Website resmi Kantor Notaris & PPAT Deni Nugraha,
                                        S.E., S.H., M.Kn. kini telah diserahkan dan siap digunakan. Website ini
                                        dirancang untuk mempermudah akses informasi dan layanan hukum bagi para klien,
                                        dengan fitur-fitur yang responsif dan user-friendly.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="../images/penyerahan1.jpeg" class="d-block w-100 carousel-gallery"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Kegiatan Lainnya</h5>
                                    <h3 class="mb-3">Wisata ke Pulau Pari Keluarga Besar Kantor Notaris & PPAT Deni
                                        Nugraha</h3>
                                    <p class="fs-10 fw-medium mb-3">Wisata ke Pulau Pari bersama Keluarga Besar Kantor
                                        Notaris & PPAT Deni Nugraha, S.E., S.H., M.Kn., menikmati keindahan alam dan
                                        kebersamaan dalam momen yang tak terlupakan.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="{{ asset('images/kegiatan1.JPG') }}"
                                        class="d-block w-100 carousel-gallery" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" data-bs-interval="4000">
                            <div class="row row-gallery">
                                <div class="col-lg-5 col-sm-12 text-container">
                                    <h5 class="text uppercase mb-3" style="color: #0874a7">Kegiatan Lainnya</h5>
                                    <h3 class="mb-3">Pembagian Hadiah & Door Prize Lomba 17 Agustusan</h3>
                                    <p class="fs-10 fw-medium mb-3">Pembagian Hadiah & Door Prize Lomba 17 Agustusan,
                                        meriahkan perayaan dengan semangat kebersamaan dan kegembiraan.</p>
                                </div>
                                <div class="col-lg-7 col-sm-12">
                                    <img src="../images/kegiatan2.jpg" class="d-block w-100 carousel-gallery"
                                        alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval1"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval1"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            {{-- carousel --}}
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya1.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Banana Boat Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya8.jpeg" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Grand Opening BSI Palem Semi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/penyerahan.jpeg" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Penyerahan Website</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya3.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Malam Puncak Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya4.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Volly Balon Air</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- border --}}
            <div class="container border mt-3 mb-5"></div>
            {{-- border --}}
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya6.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Tarik Tambang Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya2.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Malam Puncak Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya9.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Makan Bersama Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya5.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Tarik Tambang Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya7.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Cerdas Cermat Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya10.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Mobilisasi Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya11.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Keberangkatan Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 mb-3">
                <div class="card card-highlight w-auto">
                    <img src="../images/lainnya12.JPG" class="cardistry img-fluid">
                    <div class="hover-effect">
                        <div class="konten">
                            <span class="award">Dokumentasi</span>
                            <h6 class="mb-2 fw-bold text-center">Kegiatan Lainnya</h6>
                            <div class="icon-container">
                                <span class="iconify" data-icon="noto-v1:notebook" style="font-size: 48px;"
                                    data-inline="false"></span>
                                <p>Briefing Lomba Pulau Pari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
{{-- Kegiatan Lainnya --}}

@include('components.footer')
