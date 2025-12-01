@extends('layouts.backend.master')

@section('title', 'Galeri Foto — Baznas Kabupaten Cirebon')
@section('content')

@push('gallery-styles')
<link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/photoswipe.css') }}">

<style>
    .gallery-card {
        border-radius: 14px;
        padding: 15px;
        background: #ffffff;
        box-shadow: 0 3px 12px rgba(0,0,0,0.07);
        transition: 0.2s ease;
    }
    .gallery-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
    }

    .caption-text {
        font-size: 14px;
        color: #444;
        margin-top: 12px;
        min-height: 40px;
    }

    /* GRID TOMBOL */
    .btn-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        margin-top: 15px;
    }

    .btn-grid .btn,
    .btn-grid form button {
        width: 100%;
        display: flex;
        justify-content: center;
        gap: 6px;
        padding: 6px 0;
        font-size: 13px;
    }
</style>
@endpush


<div class="container-fluid">

    <div class="page-title">
        <div class="card card-absolute mt-5 mt-md-4">
            <div class="card-header bg-primary">
                <h5 class="text-white">Data Galeri Foto & Dokumentasi</h5>
            </div>
            <div class="card-body">
                <p>
                    Dibawah ini adalah foto yang telah kamu upload.
                    <span class="d-none d-md-inline">
                        Kamu bisa melihat foto, mendownload, menghapus, serta mengedit caption langsung di sini.
                        Ingin upload foto baru? <a href="{{ route('galleries.create') }}">klik disini ⇾</a>
                    </span>
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row mt-4">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Semua Foto</h5>
                </div>

                <div class="card-body row">

                    @forelse ($items as $item)
                    <div class="col-xl-3 col-md-4 col-6 mb-4">

                        <div class="gallery-card">

                            <!-- Foto -->
                            <a href="{{ url('storage/images/' . $item->foto) }}" data-size="1600x950">
                                <img src="{{ url('storage/images/' . $item->foto) }}" class="img-fluid rounded" alt="Foto">
                            </a>

                            <!-- Caption -->
                            <div class="caption-text">
                                {{ $item->caption ?? 'Tidak ada caption.' }}
                            </div>

                            <!-- Buttons -->
                            <div class="btn-grid">

                                <a href="{{ url('storage/images/' . $item->foto) }}" 
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-eye"></i> Lihat
                                </a>

                                <a href="{{ url('storage/images/' . $item->foto) }}" 
                                   download class="btn btn-primary btn-sm">
                                    <i class="fa fa-download"></i> Download
                                </a>

                                <button 
                                    class="btn btn-warning btn-sm text-white"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editCaptionModal{{ $item->id }}">
                                    <i class="fa fa-edit"></i> Edit
                                </button>

                                <form action="{{ route('galleries.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                </form>

                            </div>

                        </div>
                    </div>

                    <!-- Modal Edit Caption -->
                    <div class="modal fade" id="editCaptionModal{{ $item->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <form action="{{ route('galleries.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="modal-content">
                                    <div class="modal-header bg-warning">
                                        <h5 class="modal-title text-white">Edit Caption</h5>
                                        <button class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <label>Caption</label>
                                        <textarea name="caption" rows="4" class="form-control">{{ $item->caption }}</textarea>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-warning text-white">Simpan</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    @empty
                    <div class="col-md-7 mx-auto text-center mt-5">
                        <img src="{{ url('images/illustrations/galeri.png') }}" width="450" class="img-fluid">
                        <h6 class="text-muted mt-3">Belum ada foto yang diupload.</h6>
                    </div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
</div>


@push('gallery-scripts')
<script src="{{ url('cuba/assets/js/isotope.pkgd.js') }}"></script>
<script src="{{ url('cuba/assets/js/photoswipe/photoswipe.min.js') }}"></script>
<script src="{{ url('cuba/assets/js/photoswipe/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ url('cuba/assets/js/photoswipe/photoswipe.js') }}"></script>
<script src="{{ url('cuba/assets/js/masonry-gallery.js') }}"></script>
<script src="{{ url('cuba/assets/js/tooltip-init.js') }}"></script>
@endpush

@endsection
