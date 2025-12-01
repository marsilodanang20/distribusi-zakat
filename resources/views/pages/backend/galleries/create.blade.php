@extends('layouts.backend.master')

@section('title', 'Tambah Data Galeri — Collegetivity')
@section('content')

<!-- file wrapper for better tabs start-->
<div>

    <!-- Title Section -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="card card-absolute mt-5 mt-md-4">
                <div class="card-header bg-primary">
                    <h5 class="text-white">🎨📸 • Upload Galeri Foto Baru</h5>
                </div>
                <div class="card-body">
                    <p>
                        Dibawah ini adalah halaman untuk menambah foto galeri barumu.
                        Foto yang kamu upload bisa diakses kapan saja.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Form -->
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-12">

                <div class="card">

                    <div class="card-header">
                        <h5>Upload Foto Galeri</h5>
                    </div>

                    <form method="POST" action="{{ route('galleries.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="card-body">

                            {{-- Error Validation --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            {{-- Alert merah aturan upload --}}
                            <div class="alert alert-danger py-2 mb-3">
                                ⚠ • Maksimal ukuran file 5MB dan hanya menerima gambar (JPG, JPEG, PNG).
                            </div>

                            {{-- Input File + Preview --}}
                            <div class="form-group mb-3">
                                <label><strong>Pilih Foto Galeri</strong></label>

                                <div class="input-group mb-2">
                                    <div class="custom-file">
                                        <input 
                                            type="file" 
                                            name="foto" 
                                            class="custom-file-input" 
                                            id="fotoInput"
                                            accept="image/*"
                                            required
                                        >
                                        <label class="custom-file-label" for="fotoInput" id="fotoLabel">
                                            Pilih file gambar...
                                        </label>
                                    </div>
                                </div>
                            {{-- Caption --}}
                            <div class="form-group">
                                <label for="caption">Caption (Opsional)</label>
                                <input type="text" name="caption" class="form-control" placeholder="Masukkan caption foto">
                            </div>


                                {{-- Notifikasi setelah memilih gambar --}}
                                <div id="notif" class="alert alert-success py-2 d-none">
                                    ✔ Gambar berhasil dipilih.
                                </div>

                                {{-- Preview Gambar --}}
                                <div class="position-relative d-inline-block mt-3">

                                    <button 
                                        type="button"
                                        id="btnRemoveImage"
                                        class="btn btn-danger btn-sm position-absolute d-none"
                                        style="top:-10px; right:-10px; border-radius:50%; width:28px; height:28px; padding:0;"
                                    >
                                        ×
                                    </button>

                                    <img 
                                        id="previewImage"
                                        src=""
                                        class="img-thumbnail d-none"
                                        style="max-height: 250px; border-radius: 10px; object-fit: cover;"
                                    >

                                </div>
                            </div>

                        </div>

                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary px-4">Upload</button>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>

</div>

{{-- SCRIPT PREVIEW & REMOVE --}}
<script>
document.addEventListener("DOMContentLoaded", function() {

    const input = document.getElementById("fotoInput");
    const label = document.getElementById("fotoLabel");
    const preview = document.getElementById("previewImage");
    const notif = document.getElementById("notif");
    const removeBtn = document.getElementById("btnRemoveImage");

    // Jika user memilih gambar
    input.addEventListener("change", function(event) {
        const file = event.target.files[0];

        if (file) {
            label.innerText = file.name;

            notif.classList.remove("d-none");
            notif.innerText = "✔ Gambar '" + file.name + "' berhasil dipilih.";

            removeBtn.classList.remove("d-none");

            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(file);
        }
    });

    // Jika user klik tombol X (hapus foto)
    removeBtn.addEventListener("click", function () {
        input.value = "";
        label.innerText = "Pilih file gambar...";
        preview.src = "";
        preview.classList.add("d-none");
        notif.classList.add("d-none");
        removeBtn.classList.add("d-none");
    });

});
</script>

@endsection
