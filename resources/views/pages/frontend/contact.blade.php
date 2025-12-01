@extends('layouts.frontend.master')

@section('content')
<div class="wrapper">

    <!-- ========================= Google Map =========================== -->
    <section class="google-map py-0">
        <iframe frameborder="0" height="500" width="100%"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.052484283345!2d108.4777788!3d-6.763455399999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1e52f650831b%3A0xd51e9d65febfb588!2sBAZNAS%20KAB.%20CIREBON!5e0!3m2!1sid!2sid!4v1764148863828!5m2!1sid!2sid">
        </iframe>
    </section>

    <!-- ========================= Contact Form =========================== -->
    <section class="contact-layout1 pb-90">
        <div class="container">
            <div class="row">
                <div class="col-12">

                    <div class="contact-panel p-0 box-shadow-none">

                        <!-- INFO -->
                        <div class="contact__panel-info mb-30">
                            <div class="contact-info-box">
                                <h4 class="contact__info-box-title">Lokasi Kami</h4>
                                <ul class="contact__info-list list-unstyled">
                                    <li>2307 Apartement Cibuan, Jakarta 11226 Indonesia.</li>
                                </ul>
                            </div>

                            <div class="contact-info-box">
                                <h4 class="contact__info-box-title">Hubungi Kami</h4>
                                <ul class="contact__info-list list-unstyled">
                                    <li>Email: <a href="mailto:baznaskab.cirebon@baznas.go.id">baznaskab.cirebon@baznas.go.id</a></li>
                                    <li>Support: <a href="mailto:baznaskab.cirebon@baznas.go.id">baznaskab.cirebon@baznas.go.id</a></li>
                                </ul>
                            </div>

                            <div class="contact-info-box">
                                <h4 class="contact__info-box-title">Jam Kerja</h4>
                                <ul class="contact__info-list list-unstyled">
                                    <li>Senin - Jumat</li>
                                    <li>8.00 sampai 19.00</li>
                                </ul>
                            </div>

                            <a href="https://api.whatsapp.com/send?phone=628112223136&text=Halo%2C%20saya%20ingin%20membayar%20zakat."
                                class="btn btn__primary">
                                <i class="icon-arrow-right"></i>
                                <span>Hubungi via Whatsapp</span>
                            </a>
                        </div>

                        <!-- FORM -->
                        <form id="contactForm" class="contact__panel-form mb-30">
                            <div class="row">
                                <div class="col-12">
                                    <h4 class="contact__panel-title">Hubungi Kami</h4>
                                    <p class="contact__panel-desc mb-40">
                                        Kami selalu sedia melayani dan mendengarkan pendapat anda.
                                    </p>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nama Lengkap" id="name" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" id="email" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Nomor Telepon" id="phone" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <select id="layanan" class="form-control">
                                            <option value="Umum">Pilih Jenis Layanan</option>
                                            <option value="Komplain Zakat">Komplain Zakat</option>
                                            <option value="Aduan Pungli">Aduan Pungli</option>
                                            <option value="Lainnya">Lainnya</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea class="form-control" placeholder="Deskripsi Tambahan" id="pesan" required></textarea>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" id="btnKirim" class="btn btn__secondary btn-lg"
                                        style="background:#000; border-color:#000; color:white; padding:14px 22px; font-weight:600;">
                                        Kirim Ajuan
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<!-- ========================= JAVASCRIPT =========================== -->
<script>
// ==================== HAPUS EVENT LISTENER LAMA (FIX POPUP ERROR) ====================
const oldForm = document.getElementById("contactForm");
const form = oldForm.cloneNode(true);
oldForm.parentNode.replaceChild(form, oldForm);

// ==================== VALIDASI + MAILTO ====================
form.addEventListener("submit", function(e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const phone = document.getElementById("phone").value.trim();
    const layanan = document.getElementById("layanan").value;
    const pesan = document.getElementById("pesan").value.trim();

    // VALIDASI LENGKAP
    if (!name || !email || !phone || layanan === "Umum" || !pesan) {
        alert("Harap lengkapi semua data sebelum mengirim ajuan.");
        return;
    }

    // KIRIM VIA MAILTO (langsung, tanpa loading)
    const subject = encodeURIComponent("Ajuan dari Website BAZNAS");
    const body = encodeURIComponent(
        `Nama: ${name}\nEmail: ${email}\nTelepon: ${phone}\nLayanan: ${layanan}\n\nPesan:\n${pesan}`
    );

    window.location.href =
        `mailto:baznaskab.cirebon@baznas.go.id?subject=${subject}&body=${body}`;
});
</script>

@endsection
