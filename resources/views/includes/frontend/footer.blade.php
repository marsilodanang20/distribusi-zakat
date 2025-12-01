<!-- ========================
      Footer
========================== -->
<footer class="footer">

    <div class="footer-primary py-5">
        <div class="container">
            <div class="row gy-4">

                <!-- Hubungi Kami -->
                <div class="col-sm-12 col-md-6 col-lg-4 footer-widget">
                    <h6 class="footer-widget-title">Hubungi Kami</h6>
                    <p class="mb-3">
                        Jika Anda memiliki pertanyaan atau butuh bantuan, jangan ragu untuk menghubungi tim kami.
                    </p>

                    <div class="d-flex align-items-center mb-3">
                        <i class="icon-phone me-2"></i>
                        <a href="tel:08112223136" class="color-primary fw-semibold">
                            0811-2223-136
                        </a>
                    </div>

                    <p class="mb-0">Jl Sunan Malik Ibrahim No.15, Sumber, Cirebon.</p>
                </div>

                <!-- Aplikasi -->
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 footer-widget">
                    <h6 class="footer-widget-title">Aplikasi</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ url('/') }}">Beranda</a></li>
                        <li><a href="{{ url('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ url('article') }}">Artikel</a></li>
                        <li><a href="{{ url('gallery') }}">Galeri</a></li>
                        <li><a href="{{ url('contact') }}">Hubungi Kami</a></li>
                    </ul>
                </div>

                <!-- Layanan Zakat -->
                <div class="col-6 col-sm-6 col-md-3 col-lg-2 footer-widget">
                    <h6 class="footer-widget-title">Layanan Zakat</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="https://baznascirebonkab.or.id/bayarzakat">Bayar Zakat</a></li>
                        <li><a href="https://baznascirebonkab.or.id/kalkulator_zakat">Kalkulator Zakat</a></li>
                        <li><a href="https://api.whatsapp.com/send?phone=628112223136&text=Halo%2C%20saya%20ingin%20permohonan%20zakat.%20">Konfirmasi ZIS</a></li>
                        <li><a href="https://baznascirebonkab.or.id/informasi_rekening">Informasi Rekening</a></li>
                    </ul>
                </div>

                <!-- QRIS & Bank -->
                <div class="col-sm-12 col-md-6 col-lg-2 footer-widget">
                    <h6 class="footer-widget-title">Zakat & Donasi</h6>

                    <div class="d-flex align-items-start">
                        
                        <!-- QRIS -->
                        <div class="me-3 text-center">
                            <img src="../images/qris/qris_baznas.png"
                                 alt="QRIS Baznas"
                                 class="qris-thumb"
                                 data-bs-toggle="modal"
                                 data-bs-target="#modalQRIS">

                            <span class="small d-block mt-1 text-start" style="margin-left:4px;">
                                Klik gambar untuk
                            </span>
                            <span class="small d-block mt-1 text-start" style="margin-left:15px;">
                                memperbesar
                            </span>
                        </div>

                        <!-- Transfer Bank -->
                        <div>
                            <span class="fw-semibold mb-1 d-block">Transfer Bank</span>
                            <span>BSI</span><br>
                            <span class="fw-bold fs-5">7781188818</span>
                        </div>
                    </div>
                </div>

                <!-- Sosial Media -->
                <div class="col-sm-12 col-md-6 col-lg-2 footer-widget text-lg-end">
                    <h6 class="footer-widget-title">Sosial Media</h6>

                    <ul class="social-icons list-unstyled mt-2">
                        <li><a href="https://www.facebook.com/badanamilzakat"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="https://instagram.com/baznas.cirebon"><i class="fab fa-instagram"></i></a></li>
                        <li><a href="https://wa.me/628112223136"><i class="fab fa-whatsapp"></i></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- COPYRIGHT -->
    <div class="footer-copyrights py-3">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-between align-items-center">

                    <div></div> <!-- Placeholder biar bisa right align -->

                    <p class="mb-0">
                        <a href="https://baznascirebonkab.or.id/" 
                           class="color-gray text-decoration-none"
                           target="_blank">
                            &copy; 2025 Baznas Kabupaten Cirebon, All Rights Reserved.
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>
</footer>


<!-- ========================
      MODAL PREVIEW QRIS
========================== -->
<div class="modal fade" id="modalQRIS" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" style="max-width:380px;">
    <div class="modal-content border-0 shadow" style="border-radius:14px;">

      <div class="modal-header border-0 pb-0 position-relative">
        <h5 class="modal-title fw-semibold text-black">QRIS Zakat & Donasi</h5>

        <!-- FIXED CLOSE BUTTON -->
        <button class="modal-close-btn" data-bs-dismiss="modal" aria-label="Close">&times;</button>
      </div>

      <div class="modal-body text-center pt-2">
        <img src="../images/qris/qris_baznas.png"
             alt="QRIS"
             class="img-fluid rounded">
      </div>

      <div class="modal-footer border-0 text-center d-block pb-3">
        <small class="text-muted">Scan QRIS untuk melakukan pembayaran.</small>
      </div>

    </div>
  </div>
</div>


<!-- ========================
      EXTRA CSS
=========================== -->
<style>
    .footer-widget-title {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .footer-links li a {
        display: block;
        margin-bottom: 6px;
        color: #ddd;
        text-decoration: none;
    }
    .footer-links li a:hover {
        color: #fff;
    }

    .social-icons li {
        display: inline-block;
        margin-right: 10px;
    }
    .social-icons li a {
        font-size: 18px;
        color: #fff;
    }
    .social-icons li a:hover {
        color: #ffc107;
    }

    .qris-thumb {
        width: 110px;
        border-radius: 8px;
        cursor: pointer;
        transition: 0.2s;
    }
    .qris-thumb:hover {
        transform: scale(1.03);
    }

    /* Close Button */
    .modal-close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        background: none;
        border: none;
        font-size: 28px;
        color: #000;
        cursor: pointer;
        line-height: 1;
        z-index: 999;
    }
    .modal-close-btn:hover {
        color: #555;
    }
</style>
