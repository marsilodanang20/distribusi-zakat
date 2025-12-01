@extends('layouts.backend.master')

@section('title', 'Upload Artikel — Baznas Kabupaten Cirebon')
@section('content')

@push('create-article-styles')
<link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/dropzone.css') }}">
@endpush

<div>
    <!-- PAGE TITLE -->
    <div class="container-fluid">
        <div class="page-title">
            <div class="card card-absolute">
                <div class="card-header bg-primary">
                    <h5 class="text-white">Upload Artikel</h5>
                </div>
                <div class="card-body">
                    <p>
                        Dihalaman ini anda dapat mengupload artikel yang nantinya akan muncul di menu artikel di halaman depan.
                        Pastikan semua data telah terisi dan isi dengan data yang valid. Jika terjadi error atau bug anda dapat
                        menghubungi developer [Rayhan Biruni].
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Upload Artikel</h5>
                    </div>

                    <div class="card-body add-post">
                        <form class="row needs-validation" method="POST" action="{{ route('articles.store') }}"
                              enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="col-sm-12">

                                {{-- JUDUL --}}
                                <div class="form-group">
                                    <label for="judul">Judul: <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="icon icon-tabler icon-tabler-news"
                                                    width="20" height="20" viewBox="0 0 24 24"
                                                    stroke-width="2" stroke="currentColor"
                                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path
                                                        d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                                                    </path>
                                                    <line x1="8" y1="8" x2="12" y2="8"></line>
                                                    <line x1="8" y1="12" x2="12" y2="12"></line>
                                                    <line x1="8" y1="16" x2="12" y2="16"></line>
                                                </svg>
                                            </span>
                                        </div>
                                        <input class="form-control" id="judul" name="judul"
                                               value="{{ old('judul') }}" type="text" required>
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                                </div>

                                {{-- THUMBNAIL --}}
                                <div class="form-group">
                                    <label for="thumbnail">Thumbnail: <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="thumbnail"
                                               id="thumbnail" accept="image/*" required>
                                        <label class="custom-file-label" for="thumbnail">Pilih file thumbnail</label>
                                    </div>

                                    <!-- Preview Thumbnail -->
                                    <div class="mt-3">
                                        <img id="preview-thumbnail" src="#" alt="Preview Thumbnail"
                                             class="img-fluid d-none rounded"
                                             style="max-height: 200px;">
                                    </div>
                                </div>

                                {{-- HIDDEN FIELD --}}
                                <input type="hidden" name="kategori" value="Artikel">
                                <input type="hidden" name="author" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="tanggal" value="{{ now()->toDateString() }}">

                                {{-- CONTENT --}}
                                <div class="email-wrapper">
                                    <div class="theme-form">
                                        <div class="form-group">
                                            <label>Content: <span class="text-danger">*</span></label>
                                            <textarea id="text-box" name="content" cols="10" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- BUTTONS --}}
                            <div class="col-sm-12">
                                <div class="btn-showcase">
                                    <button class="btn btn-primary" type="submit">Upload</button>
                                    <input class="btn btn-light" type="reset" value="Reset">
                                </div>
                            </div>
                        </form>
                    </div> <!-- end card-body -->
                </div>
            </div>
        </div>
    </div>
    <!-- main content end-->
</div>
<!-- file wrapper for better tabs start-->

{{-- SCRIPTS --}}
@push('ckeditor-scripts')

<script>
    // =============================
    // PREVIEW + LABEL FILE IMAGE
    // =============================
    document.getElementById('thumbnail').addEventListener('change', function (e) {
        const fileInput = e.target;
        const fileName = fileInput.files[0].name;
        fileInput.nextElementSibling.innerText = fileName;

        // Preview thumbnail
        const preview = document.getElementById('preview-thumbnail');
        preview.src = URL.createObjectURL(fileInput.files[0]);
        preview.classList.remove('d-none');
    });
</script>

<script src="{{ url('cuba/assets/js/editor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ url('cuba/assets/js/editor/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ url('cuba/assets/js/dropzone/dropzone.js') }}"></script>
<script src="{{ url('cuba/assets/js/dropzone/dropzone-script.js') }}"></script>
<script src="{{ url('cuba/assets/js/select2/select2.full.min.js') }}"></script>
<script src="{{ url('cuba/assets/js/select2/select2-custom.js') }}"></script>
<script src="{{ url('cuba/assets/js/email-app.js') }}"></script>
<script src="{{ url('cuba/assets/js/form-validation-custom.js') }}"></script>
<script src="{{ url('cuba/assets/js/tooltip-init.js') }}"></script>

@endpush

@endsection
