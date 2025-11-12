  @include('components.navbar')
  <!--  Main Banner  -->
  <div class="banner-service">
      <div class="container"></div>
  </div>
  <!--  Main Banner  -->

  <div class="service-detail container p-2">
      <nav id="serviceDetail" class="navbar navbar-light bg-white">
          <a class="navbar-brand mx-auto" href="#">OUR SERVICE</a>
      </nav>

      <div class="row my-4 d-flex">
          <div class="col-lg-4 col-md-6 col-sm-2 ">
              <nav id="serviceDetail" class="h-100 flex-column align-items-stretch px-4 vborder">
                  <nav class="nav nav-pills flex-column">
                      <div class="accordion mb-5" id="accordionExample">
                          <div class="accordion-item">
                              <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                      data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                      Layanan Notaris
                                  </button>
                              </h2>
                              <div id="collapseOne" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body text-center">
                                      <nav class="nav nav-pills flex-column">
                                          <a class="nav-link ms-3 my-1" href="#item-1-1"
                                              onclick="showDetails('aktaPendirian', 'collapseOne')">AKTA PENDIRIAN
                                              PT</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaPerseroan', 'collapseOne')">AKTA PERSEROAN
                                              KOMANDITER (CV)</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaYayasan', 'collapseOne')">AKTA YAYASAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaPerkumpulan', 'collapseOne')">AKTA
                                              PERKUMPULAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaPerjanjianPerorangan', 'collapseOne')">AKTA
                                              PERJANJIAN KERJASAMA PERORANGAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaPerjanjianPerusahaan', 'collapseOne')">AKTA
                                              PERJANJIAN KERJASAMA PERUSAHAAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('perjanjianKawin', 'collapseOne')">PERJANJIAN
                                              KAWIN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('aktaPengakuanHutang', 'collapseOne')">AKTA PENGAKUAN
                                              HUTANG / PEMBIAYAAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('cessie', 'collapseOne')">CESSIE</a>
                                          <a class="nav-link ms-3 my-1" href="#item-1-2"
                                              onclick="showDetails('fidusia', 'collapseOne')">FIDUSIA</a>
                                      </nav>
                                  </div>
                              </div>

                          </div>
                          <div class="accordion-item">
                              <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                      data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                      Layanan PPAT
                                  </button>
                              </h2>
                              <div id="collapseTwo" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body text-center">
                                      <nav class="nav nav-pills flex-column">
                                          <a class="nav-link ms-3 my-1" href="#item-2-1"
                                              onclick="showDetails('akteJualBeli', 'collapseTwo')">AKTA JUAL BELI</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-2"
                                              onclick="showDetails('akteHibah', 'collapseTwo')">AKTA HIBAH</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-3"
                                              onclick="showDetails('akteHakBersama', 'collapseTwo')">AKTA PEMBAGIAN HAK
                                              BERSAMA</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-4"
                                              onclick="showDetails('akteWaris', 'collapseTwo')">AKTA WARIS</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-5"
                                              onclick="showDetails('akteBalikNamaWaris', 'collapseTwo')">AKTA BALIK NAMA
                                              WARIS</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-6"
                                              onclick="showDetails('akteSKMHT', 'collapseTwo')">AKTA SKMHT</a>
                                          <a class="nav-link ms-3 my-1" href="#item-2-7"
                                              onclick="showDetails('akteAPHT', 'collapseTwo')">AKTA APHT</a>
                                      </nav>
                                  </div>
                              </div>
                          </div>
                          <div class="accordion-item">
                              <h2 class="accordion-header">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                      data-bs-target="#collapseThree" aria-expanded="false"
                                      aria-controls="collapseThree">
                                      Layanan Lainnya
                                  </button>
                              </h2>
                              <div id="collapseThree" class="accordion-collapse collapse"
                                  data-bs-parent="#accordionExample">
                                  <div class="accordion-body text-center">
                                      <nav class="nav nav-pills flex-column">
                                          <a class="nav-link ms-3 my-1" href="#item-3-1"
                                              onclick="showDetails('pengecekanSertifikat', 'collapseThree')">PENGECEKAN
                                              SERTIFIKAT</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-2"
                                              onclick="showDetails('roya', 'collapseThree')">ROYA</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-3"
                                              onclick="showDetails('peningkatanHakMilik', 'collapseThree')">PENINGKATAN
                                              HAK MILIK RUMAH / RUKO</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-4"
                                              onclick="showDetails('legalisasi', 'collapseThree')">LEGALISASI</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-5"
                                              onclick="showDetails('warmerking', 'collapseThree')">WARMERKING</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-6"
                                              onclick="showDetails('fotocopyAsli', 'collapseThree')">FOTOCOPY SESUAI
                                              ASLI</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-7"
                                              onclick="showDetails('sertifikasi', 'collapseThree')">SERTIFIKASI</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-8"
                                              onclick="showDetails('penerbitanSertifikat', 'collapseThree')">PENERRBITAN
                                              SERTIFIKAT PENGGANTI</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-9"
                                              onclick="showDetails('penurunanHak', 'collapseThree')">PENURUNAN HAK</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-10"
                                              onclick="showDetails('perijinanPertanahan', 'collapseThree')">PERIJINAN
                                              PERTANAHAN</a>
                                          <a class="nav-link ms-3 my-1" href="#item-3-1"
                                              onclick="showDetails('pengurusanPerpajakan', 'collapseThree')">PENGURUSAN
                                              PERPAJAKAN</a>
                                      </nav>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </nav>
              </nav>
          </div>

          <div class="col-lg-8 col-md-6 col-sm-2 text-center py-3 ">
              <div class="content">
                  <div id="aktaPendirian" class="details-service">
                      <h4>AKTA PENDIRIAN PT</h4>
                      <p>Akta Pendirian PT (Perseroan Terbatas) adalah dokumen resmi yang dibuat oleh notaris dan berisi
                          anggaran dasar serta informasi penting mengenai pendirian suatu perusahaan berbentuk perseroan
                          terbatas. Akta ini mencakup nama dan alamat perusahaan, tujuan dan kegiatan usaha, modal
                          dasar, modal disetor, pembagian saham, serta hak dan kewajiban para pemegang saham. Akta
                          Pendirian PT menjadi dasar hukum bagi pendirian perusahaan dan diperlukan untuk mendapatkan
                          status badan hukum dari pemerintah.</p>
                  </div>
                  <div id="aktaPerseroan" class="details-service">
                      <h4>AKTA PERSEROAN KOMANDITER (CV)</h4>
                      <p>Akta Perseroan Komanditer (CV) adalah dokumen resmi yang dibuat oleh notaris yang berisi
                          perjanjian antara para pendiri untuk membentuk suatu perusahaan berbentuk Commanditaire
                          Vennootschap (CV). Akta ini mencakup informasi penting seperti nama dan alamat CV, tujuan dan
                          kegiatan usaha, modal yang disetor oleh para sekutu, serta hak dan kewajiban para sekutu, baik
                          sekutu aktif yang mengelola perusahaan maupun sekutu pasif yang hanya menanamkan modal. Akta
                          ini berfungsi sebagai dasar hukum pendirian CV dan diperlukan untuk pendaftaran dan pengakuan
                          resmi oleh pemerintah.
                      </p>
                  </div>
                  <div id="aktaYayasan" class="details-service">
                      <h4>AKTA YAYASAN</h4>
                      <p>Akta Yayasan adalah dokumen resmi yang dibuat oleh notaris yang berisi anggaran dasar dan
                          informasi penting mengenai pendirian suatu yayasan. Akta ini mencakup nama dan alamat yayasan,
                          tujuan dan kegiatan sosial atau kemanusiaan yang akan dilakukan, struktur organisasi, peran
                          dan tanggung jawab para pendiri dan pengurus, serta ketentuan mengenai pengelolaan aset dan
                          keuangan yayasan. Akta Yayasan menjadi dasar hukum bagi pendirian yayasan dan diperlukan untuk
                          mendapatkan status badan hukum dari pemerintah. </p>
                  </div>
                  <div id="aktaPerkumpulan" class="details-service">
                      <h4>AKTA PERKUMPULAN</h4>
                      <p>Akta Perkumpulan adalah dokumen resmi yang dibuat oleh notaris yang berisi anggaran dasar dan
                          informasi penting mengenai pendirian suatu perkumpulan atau asosiasi. Akta ini mencakup nama
                          dan alamat perkumpulan, tujuan dan kegiatan yang akan dilakukan, struktur organisasi, hak dan
                          kewajiban anggota, serta ketentuan mengenai pengelolaan keuangan dan aset perkumpulan. Akta
                          Perkumpulan menjadi dasar hukum bagi pendirian perkumpulan dan diperlukan untuk mendapatkan
                          status badan hukum dari pemerintah.</p>
                  </div>
                  <div id="aktaPerjanjianPerorangan" class="details-service">
                      <h4>AKTA PERJANJIAN KERJASAMA PERORANGAN</h4>
                      <p>Akta Perjanjian Kerjasama Perorangan adalah dokumen resmi yang dibuat oleh notaris yang berisi
                          kesepakatan antara dua atau lebih pihak perorangan untuk bekerja sama dalam suatu usaha atau
                          proyek. Akta ini mencakup rincian tentang tujuan kerjasama, hak dan kewajiban masing-masing
                          pihak, kontribusi modal atau sumber daya, pembagian keuntungan dan kerugian, serta ketentuan
                          mengenai pengelolaan dan penyelesaian perselisihan. Akta ini berfungsi sebagai dasar hukum
                          yang mengatur hubungan dan tanggung jawab para pihak yang terlibat dalam kerjasama tersebut.
                      </p>
                  </div>
                  <div id="aktaPerjanjianPerusahaan" class="details-service">
                      <h4>AKTA PERJANJIAN KERJASAMA PERUSAHAAN</h4>
                      <p>Akta Perjanjian Kerjasama Perusahaan adalah dokumen resmi yang dibuat oleh notaris yang berisi
                          kesepakatan antara dua atau lebih perusahaan untuk bekerja sama dalam suatu proyek atau usaha
                          bersama. Akta ini mencakup rincian tentang tujuan kerjasama, hak dan kewajiban masing-masing
                          perusahaan, kontribusi modal atau sumber daya, pembagian keuntungan dan kerugian, serta
                          ketentuan mengenai pengelolaan, pengawasan, dan penyelesaian perselisihan. Akta ini berfungsi
                          sebagai dasar hukum yang mengatur hubungan dan tanggung jawab para perusahaan yang terlibat
                          dalam kerjasama tersebut.</p>
                  </div>
                  <div id="perjanjianKawin" class="details-service">
                      <h4>PERJANJIAN KAWIN</h4>
                      <p>Surat Perjanjian Kawin adalah dokumen resmi yang dibuat oleh notaris sebelum atau selama
                          pernikahan, yang mengatur mengenai pemisahan atau penggabungan harta kekayaan antara suami dan
                          istri. Dokumen ini mencakup kesepakatan tentang hak dan kewajiban masing-masing pihak terkait
                          harta benda yang dimiliki sebelum dan selama pernikahan, serta pengelolaan dan pembagian harta
                          jika terjadi perceraian atau kematian salah satu pihak. Surat Perjanjian Kawin bertujuan untuk
                          melindungi hak-hak masing-masing pasangan dan memberikan kejelasan hukum mengenai harta
                          kekayaan dalam pernikahan. </p>
                  </div>
                  <div id="aktaPengakuanHutang" class="details-service">
                      <h4>AKTA PENGAKUAN HUTANG / PEMBIAYAAN</h4>
                      <p>Akta Pengakuan Hutang / Pembiayaan adalah dokumen resmi yang dibuat oleh notaris yang mencatat
                          pengakuan seseorang atau pihak (debitur) terhadap hutang atau pembiayaan yang diterima dari
                          pihak lain (kreditur). Dokumen ini mencakup rincian jumlah hutang atau pembiayaan, syarat dan
                          ketentuan pelunasan, jaminan yang diberikan, serta hak dan kewajiban kedua belah pihak. Akta
                          ini berfungsi sebagai bukti sah adanya hutang atau pembiayaan dan memberikan perlindungan
                          hukum bagi kreditur serta kepastian hukum bagi debitur dalam transaksi tersebut. </p>
                  </div>
                  <div id="cessie" class="details-service">
                      <h4>CESSIE</h4>
                      <p>Cessie adalah pengalihan hak atas piutang dari kreditur asal (cedent) kepada pihak ketiga
                          (cessionaris) berdasarkan perjanjian tertulis. Dalam proses cessie, cedent menyerahkan hak
                          tagihnya terhadap debitur kepada cessionaris, sehingga cessionaris menjadi pihak yang berhak
                          menagih piutang tersebut kepada debitur. Cessie sering digunakan dalam transaksi komersial
                          untuk menjual atau memindahkan hak piutang kepada pihak lain, dan harus dilakukan dengan
                          pemberitahuan resmi kepada debitur untuk sah dan memiliki kekuatan hukum.</p>
                  </div>
                  <div id="fidusia" class="details-service">
                      <h4>FIDUSIA</h4>
                      <p>Fidusia adalah suatu bentuk jaminan kebendaan di mana kepemilikan atas suatu aset dialihkan
                          dari debitur kepada kreditur sebagai jaminan untuk pelunasan utang, tetapi aset tersebut tetap
                          berada dalam penguasaan debitur. Dalam fidusia, debitur tetap dapat menggunakan aset yang
                          dijaminkan selama memenuhi kewajiban pembayaran utangnya. Jika debitur gagal memenuhi
                          kewajibannya, kreditur memiliki hak untuk mengeksekusi aset tersebut. Fidusia diatur dalam
                          Undang-Undang Jaminan Fidusia di Indonesia dan biasanya digunakan untuk jaminan aset bergerak
                          seperti kendaraan, inventaris, atau piutang.</p>
                  </div>
                  <div id="akteJualBeli" class="details-service">
                      <h4>AKTA JUAL BELI</h4>
                      <p>Akta Jual Beli adalah dokumen resmi yang dibuat oleh notaris atau pejabat yang berwenang
                          lainnya yang mencatat perjanjian jual beli antara penjual dan pembeli. Dokumen ini mencakup
                          rincian tentang pihak-pihak yang terlibat, deskripsi barang atau properti yang dijual, harga
                          jual, syarat-syarat pembayaran, tanggal penyerahan, serta hak dan kewajiban masing-masing
                          pihak. Akta Jual Beli berfungsi sebagai bukti sah transaksi jual beli dan memberikan kepastian
                          hukum bagi kedua belah pihak terkait kepemilikan dan pengalihan hak atas barang atau properti
                          yang dibeli.</p>
                  </div>
                  <div id="akteHibah" class="details-service">
                      <h4>AKTA HIBAH</h4>
                      <p>Akta Hibah adalah dokumen resmi yang dibuat oleh notaris yang mencatat perbuatan hukum yang
                          dilakukan oleh pemberi hibah (donatur) untuk menyerahkan sebagian dari hak miliknya kepada
                          penerima hibah (ahli waris yang masih hidup).</p>
                  </div>
                  <div id="akteHakBersama" class="details-service">
                      <h4>AKTA PEMBAGIAN HAK BERSAMA</h4>
                      <p>Akta Pembagian Hak Bersama adalah dokumen resmi yang digunakan untuk membagi atau membagikan
                          hak-hak bersama atas suatu properti atau aset, seperti tanah atau rumah, di antara beberapa
                          pihak yang memiliki kepemilikan bersama. Dokumen ini memastikan bahwa pembagian hak dilakukan
                          secara sah sesuai dengan ketentuan hukum yang berlaku, termasuk pengaturan atas kepemilikan,
                          penggunaan, atau manfaat dari properti yang bersama-sama dimiliki oleh para pihak terkait.</p>
                  </div>
                  <div id="akteWaris" class="details-service">
                      <h4>AKTA WARIS</h4>
                      <p>Akta waris adalah dokumen hukum yang digunakan untuk mentransfer atau menetapkan kepemilikan
                          atas harta atau harta warisan dari seorang yang meninggal (pewaris) kepada ahli warisnya.
                          Dokumen ini memperinci distribusi harta warisan sesuai dengan ketentuan yang ditetapkan dalam
                          wasiat atau berdasarkan hukum waris yang berlaku. Akta waris dikeluarkan oleh notaris atau
                          lembaga yang berwenang dan merupakan bukti sah yang mengatur pembagian harta warisan serta
                          hak-hak ahli waris yang terlibat.</p>
                  </div>
                  <div id="akteBalikNamaWaris" class="details-service">
                      <h4>BALIK NAMA WARIS</h4>
                      <p>Balik nama waris adalah proses hukum untuk mengubah kepemilikan atau nama pemilik atas suatu
                          harta atau properti yang didapat dari warisan. Proses ini melibatkan transfer resmi dari nama
                          almarhum atau pewaris kepada ahli warisnya yang sah, sesuai dengan ketentuan hukum yang
                          berlaku. Balik nama waris sering kali melibatkan pembuatan dokumen hukum seperti akta waris
                          dan proses administratif untuk merekam perubahan kepemilikan properti tersebut.</p>
                  </div>
                  <div id="akteSKMHT" class="details-service">
                      <h4>AKTA SKMHT</h4>
                      <p>Akta SKMHT (Surat Kuasa Membebankan Hak Tanggungan) adalah dokumen hukum yang digunakan untuk
                          memberikan kuasa kepada pihak lain untuk melakukan pemberian hak tanggungan atas suatu
                          properti. Dokumen ini umumnya digunakan dalam transaksi atau pengajuan kredit perumahan atau
                          properti lainnya di Indonesia. SKMHT memberikan kuasa kepada pihak tertentu (biasanya bank
                          atau lembaga keuangan) untuk menarik sebagian atau seluruh hak atas properti sebagai jaminan
                          atas pinjaman yang diberikan. SKMHT harus disahkan oleh notaris agar sah secara hukum dan
                          biasanya menjadi bagian penting dalam transaksi properti yang melibatkan pemberian hak
                          tanggungan.</p>
                  </div>
                  <div id="akteAPHT" class="details-service">
                      <h4>AKTA APHT</h4>
                      <p>Balik nama waris adalah proses hukum untuk mengubah kepemilikan atau nama pemilik atas suatu
                          harta atau properti yang didapat dari warisan. Proses ini melibatkan transfer resmi dari nama
                          almarhum atau pewaris kepada ahli warisnya yang sah, sesuai dengan ketentuan hukum yang
                          berlaku. Balik nama waris sering kali melibatkan pembuatan dokumen hukum seperti akta waris
                          dan proses administratif untuk merekam perubahan kepemilikan properti tersebut.</p>
                  </div>
                  <div id="pengecekanSertifikat" class="details-service">
                      <h4>PENGECEKAN SERTIFIKAT</h4>
                      <p>Pengecekan sertifikat merujuk pada proses verifikasi atau validasi keaslian dan keabsahan
                          sertifikat yang dikeluarkan oleh lembaga tertentu. Sertifikat ini bisa berupa sertifikat
                          akademik, sertifikat kompetensi, sertifikat pelatihan, atau sertifikat keahlian lainnya.</p>
                  </div>
                  <div id="roya" class="details-service">
                      <h4>ROYA</h4>
                      <p>ROYA adalah layanan yang disediakan oleh kantor pertanahan atau badan yang berwenang untuk
                          memproses penghapusan hak tanggungan atas suatu aset atau properti setelah utang atau pinjaman
                          yang dijamin telah dilunasi. Layanan ini penting untuk memastikan bahwa hak tanggungan yang
                          melekat pada sertifikat tanah atau properti dihapus secara resmi dan tercatat dalam sistem
                          pertanahan.</p>
                  </div>
                  <div id="peningkatanHakMilik" class="details-service">
                      <h4>PENINGKATAN HAK MILIK RUMAH / RUKO</h4>
                      <p>Layanan Peningkatan Hak Milik Rumah atau Ruko adalah layanan yang disediakan oleh kantor
                          pertanahan untuk mengubah status atau jenis hak atas tanah dari hak yang lebih rendah menjadi
                          hak milik, yang merupakan hak atas tanah yang tertinggi di Indonesia. Proses ini biasanya
                          dilakukan untuk meningkatkan kepastian hukum dan nilai ekonomis dari properti tersebut.</p>
                  </div>
                  <div id="legalisasi" class="details-service">
                      <h4>LEGALISASI</h4>
                      <p>Layanan legalisasi adalah proses pengesahan dokumen yang dilakukan oleh notaris untuk
                          memastikan bahwa dokumen tersebut telah ditandatangani dengan benar oleh pihak yang berwenang
                          dan keasliannya dapat dipercaya. Layanan ini sering kali diperlukan untuk berbagai dokumen
                          hukum, komersial, dan pribadi yang memerlukan bukti tambahan keaslian dan validitas.</p>
                  </div>
                  <div id="warmerking" class="details-service">
                      <h4>WARMERKING</h4>
                      <p>Layanan Warmerking adalah layanan yang disediakan oleh notaris untuk menandai atau memberikan
                          tanda pengesahan pada salinan dokumen, yang menunjukkan bahwa salinan tersebut benar-benar
                          sesuai dengan aslinya. Layanan ini sering disebut juga sebagai "waarmerken" dalam bahasa
                          Belanda, yang berarti "memberi tanda" atau "memberi cap pengesahan".</p>
                  </div>
                  <div id="fotocopyAsli" class="details-service">
                      <h4>FOTOCOPY SESUAI ASLI</h4>
                      <p>Layanan fotocopy sesuai asli adalah layanan untuk membuat salinan dokumen yang dinyatakan
                          sebagai salinan yang benar-benar sesuai dengan dokumen aslinya. Proses ini melibatkan
                          verifikasi dan pengesahan bahwa fotokopi tersebut adalah reproduksi yang akurat dari dokumen
                          aslinya.</p>
                  </div>
                  <div id="sertifikasi" class="details-service">
                      <h4>SERTIFIKASI</h4>
                      <p>Layanan sertifikasi adalah layanan yang disediakan oleh lembaga atau organisasi yang berwenang
                          untuk memberikan pengakuan resmi bahwa seseorang, produk, sistem, atau proses telah memenuhi
                          standar tertentu yang telah ditetapkan. Proses sertifikasi melibatkan penilaian, verifikasi,
                          dan pengujian untuk memastikan kepatuhan terhadap standar yang relevan.</p>
                  </div>
                  <div id="penerbitanSertifikat" class="details-service">
                      <h4>PENERRBITAN SERTIFIKAT PENGGANTI</h4>
                      <p>Layanan penerbitan sertifikat pengganti adalah layanan untuk menerbitkan sertifikat baru
                          sebagai pengganti sertifikat yang asli karena sertifikat asli tersebut hilang, rusak, atau
                          musnah.</p>
                  </div>
                  <div id="penurunanHak" class="details-service">
                      <h4>PENURUNAN HAK</h4>
                      <p>Layanan penurunan hak adalah layanan untuk melakukan pengurangan atau penghapusan hak-hak
                          tertentu yang terdapat pada sertifikat tanah atau properti. Proses ini umumnya dilakukan atas
                          permintaan pemilik tanah atau properti untuk mengurangi atau menghapus hak-hak yang tercatat
                          atas properti mereka, seperti hak tanggungan atau hak pakai, yang mungkin membatasi atau
                          mempengaruhi penggunaan atau pemanfaatan properti tersebut.</p>
                  </div>
                  <div id="perijinanPertanahan" class="details-service">
                      <h4>PERIJINAN PERTANAHAN</h4>
                      <p>Layanan perijinan pertanahan merujuk pada proses atau layanan yang disediakan untuk memberikan
                          izin atau persetujuan resmi terkait dengan penggunaan atau pemanfaatan lahan atau properti
                          tertentu. Prosedur ini biasanya dilakukan untuk memastikan bahwa penggunaan lahan atau
                          properti tersebut sesuai dengan peraturan dan ketentuan yang berlaku, baik dari segi
                          lingkungan, tata ruang, maupun keamanan.</p>
                  </div>
                  <div id="pengurusanPerpajakan" class="details-service">
                      <h4>PENGURUSAN PERPAJAKAN</h4>
                      <p>Layanan pengurusan perpajakan merujuk pada berbagai proses dan kegiatan yang dilakukan untuk
                          memastikan bahwa kewajiban perpajakan sebuah entitas atau individu dipenuhi dengan benar dan
                          tepat waktu. Ini mencakup pengelolaan administrasi perpajakan, penyusunan laporan pajak,
                          pengajuan dokumen, serta pemenuhan semua kewajiban yang terkait dengan peraturan perpajakan
                          yang berlaku..</p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  @include('components.footer')
