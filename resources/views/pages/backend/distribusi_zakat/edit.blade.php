@extends('layouts.backend.master')

@section('title', 'Update Data Distribusi Zakat — Baznas Kabupaten Cirebon')
@section('content')

    @push('timepicker-styles')
        <link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/timepicker.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            span.select2.select2-container.select2-container--classic {
                width: 100% !important;
            }

            .select2-container .select2-selection--single {
                border-color: #495057 !important;
            }
        </style>
    @endpush

    <div class="container-fluid">

        <div class="page-title">
            <div class="card card-absolute mt-5 mt-md-4">
                <div class="card-header bg-primary">
                    <h5 class="text-white">
                        Update Data Distribusi Zakat
                    </h5>
                </div>
                <div class="card-body">
                    <p>
                        Dibawah ini adalah form untuk update data distribusi zakat.
                        <span class="d-none d-md-inline">
                            Data dibawah pastikan anda isi dengan benar dan lengkap ya, nantinya akan masuk ke laporan
                            distribusi zakat.
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Data Distribusi Zakat</h5>
                    </div>
                    <form method="POST" action="{{ route('distribusi_zakat.update', $item->id) }}" enctype="multipart/form-data"
                        class="needs-validation">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>
                                            <h4>Ada error nih 😓</h4>
                                        </li>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            
                            <div class="form-row">
                                <div class="form-group col-12 mb-2">
                                    <label for="mustahik_select">Nama Lengkap Mustahik <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" id="mustahik_select" name="mustahik_id" required>
                                            <option value="">Pilih Mustahik (NIK - Nama)</option>
                                            @foreach ($mustahiks as $mustahik)
                                                <option value="{{ $mustahik->id }}" 
                                                        data-kategori="{{ $mustahik->kategori_mustahik }}"
                                                        data-jumlah-hak="{{ $mustahik->jumlah_hak }}"
                                                        {{ old('mustahik_id', $item->mustahik_id) == $mustahik->id ? 'selected' : '' }}>
                                                    {{ $mustahik->nik ?? $mustahik->nomor_kk ?? '-' }} - {{ $mustahik->nama_mustahik }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-row mt-4">
                                <div class="form-group col-md-6 mb-2">
                                    <label for="kategori_mustahik">Kategori Mustahik <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="kategori_mustahik" type="text"
                                            value="{{ old('kategori_mustahik', $item->kategori_mustahik) }}" class="form-control"
                                            name="kategori_mustahik" 
                                            placeholder="Pilih mustahik terlebih dahulu"
                                            style="background-color: #f5f5f5;"
                                            readonly
                                            onfocus="this.blur();">
                                    </div>
                                    <small class="text-muted">⚠️ Field ini terisi otomatis saat Anda memilih mustahik</small>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="jumlah_hak">Jumlah Hak <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="jumlah_hak" type="text"
                                            value="{{ old('jumlah_hak', $item->jumlah_hak) }}" class="form-control"
                                            name="jumlah_hak" 
                                            placeholder="Pilih mustahik terlebih dahulu"
                                            style="background-color: #f5f5f5;"
                                            readonly
                                            onfocus="this.blur();">
                                    </div>
                                    <small class="text-muted">⚠️ Field ini terisi otomatis saat Anda memilih mustahik</small>
                                </div>
                            </div>

<div class="form-row mt-4">
    <div class="col-12 d-none" id="limit_info">
        <div class="card border-0 shadow-sm">
            <div class="card-body px-4 py-3">

                <!-- Header -->
                <div class="mb-3">
                    <h6 class="mb-1 font-weight-bold text-dark">
                        Batas Distribusi Zakat Fitrah
                    </h6>

                    <small class="text-muted d-block">
                        Ketentuan per jiwa / hak zakat: 2,5 Kg beras atau Rp 40.000
                    </small>

                    <small class="text-muted d-block mt-1">
                        Contoh: Jika mustahik memiliki 1 hak, maka maksimal menerima 2,5 Kg beras atau Rp 40.000.
                    </small>
                </div>

                <!-- Content -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted">Maksimal Beras</span>
                            <span id="limit_max_beras" class="font-weight-bold text-dark">
                                -
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                            <span class="text-muted">Maksimal Uang</span>
                            <span id="limit_max_uang" class="font-weight-bold text-dark">
                                -
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


                            <div class="form-row mt-4">
                                <div class="form-group col-md-4 mb-2">
                                    <label for="jenis_zakat">Jenis Zakat <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_zakat" name="jenis_zakat">
                                            <option value="" disabled>Pilih ...</option>
                                            <option value="Beras" {{ old('jenis_zakat', $item->jenis_zakat) == 'Beras' ? 'selected' : '' }}>Beras</option>
                                            <option value="Uang" {{ old('jenis_zakat', $item->jenis_zakat) == 'Uang' ? 'selected' : '' }}>Uang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="alert alert-primary py-2" role="alert">
                                        Isi salah satu dari 2 form dibawah ini, jika memilih beras sebelumnya maka isi dengan
                                        satuan KG dan jika uang maka isi dengan nominal angka tanpa RP
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="distribusi_beras">Distribusi Beras <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="distribusi_beras" type="number" step="0.01" 
                                            value="{{ old('distribusi_beras', $item->distribusi_beras) }}"
                                            class="form-control" name="distribusi_beras" placeholder="Masukkan jumlah beras" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kilogram</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="distribusi_uang">Distribusi Uang <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="distribusi_uang" type="text" 
                                            value="{{ old('distribusi_uang', $item->distribusi_uang ? number_format($item->distribusi_uang, 0, ',', '.') : '') }}"
                                            class="form-control" name="distribusi_uang" placeholder="Masukkan nominal" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary m-r-15" type="submit">Update</button>
                            <button class="btn btn-light" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('timepicker-scripts')
        <script src="{{ url('cuba/assets/js/time-picker/jquery-clockpicker.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/time-picker/highlight.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/time-picker/clockpicker.js') }}"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script>
            $(document).ready(function() {
                // KONFIGURASI ZAKAT
                const RATE_BERAS = 2.5;
                const RATE_UANG = 40000;

                // ✅ INISIALISASI SELECT2
                $('#mustahik_select').select2({
                    placeholder: "Pilih Mustahik (NIK - Nama)",
                    allowClear: true
                });

                // ✅ INITIAL CHECK (Trigger update limits based on existing selection)
                function checkInitialMustahik() {
                    const selectedOption = $('#mustahik_select option:selected');
                    if(selectedOption.length && selectedOption.val()) {
                         const jumlahHak = parseInt(selectedOption.data('jumlah-hak')) || 0;
                         updateLimits(jumlahHak);
                    }
                }

                // ✅ AUTO-FILL KATEGORI & JUMLAH HAK SAAT MUSTAHIK DIPILIH
                $('#mustahik_select').on('select2:select', function(e) {
                    const selectedOption = e.params.data.element;
                    const kategori = $(selectedOption).data('kategori');
                    const jumlahHak = parseInt($(selectedOption).data('jumlah-hak')) || 0;
                    
                    if (kategori && kategori !== 'null') $('#kategori_mustahik').val(kategori);
                    if (jumlahHak) $('#jumlah_hak').val(jumlahHak);

                    updateLimits(jumlahHak);
                });

                // ✅ CLEAR FIELD SAAT SELECT2 DI-CLEAR
                $('#mustahik_select').on('select2:clear', function(e) {
                    $('#kategori_mustahik').val('');
                    $('#jumlah_hak').val('');
                    $('#limit_info').addClass('d-none');
                });

                function updateLimits(jumlahHak) {
                    if (jumlahHak > 0) {
                        const maxBeras = jumlahHak * RATE_BERAS;
                        const maxUang = jumlahHak * RATE_UANG;
                        const formattedUang = new Intl.NumberFormat('id-ID').format(maxUang);
                        
                        $('#limit_max_beras').text(maxBeras + ' Kg');
                        $('#limit_max_uang').text('Rp ' + formattedUang);
                        $('#limit_info').removeClass('d-none');
                    } else {
                        $('#limit_info').addClass('d-none');
                    }
                }

                // Run init check
                checkInitialMustahik();

                // ✅ LOGIC FOR TYPE OF DISTRIBUTION
                const jenisZakat = $('#jenis_zakat');
                const distribusiBeras = $('#distribusi_beras');
                const distribusiUang = $('#distribusi_uang');
                const form = $('form');

                function toggleDistribusi() {
                    const val = jenisZakat.val();
                    if (val === 'Beras') {
                        distribusiBeras.prop('disabled', false);
                        distribusiUang.prop('disabled', true);
                        // Don't clear value in edit if toggling to existing type on load
                    } else if (val === 'Uang') {
                        distribusiUang.prop('disabled', false);
                        distribusiBeras.prop('disabled', true);
                    } else {
                        distribusiBeras.prop('disabled', true);
                        distribusiUang.prop('disabled', true);
                    }
                }

                jenisZakat.on('change', function() {
                   // Clean other field when changing type explicitly
                   if ($(this).val() === 'Beras') {
                       distribusiUang.val('');
                   } else if ($(this).val() === 'Uang') {
                       distribusiBeras.val('');
                   }
                   toggleDistribusi();
                });
                
                // Initial check
                toggleDistribusi();

                // ✅ RUPIAH FORMATTER
                distribusiUang.on('input', function(e) {
                    let value = this.value.replace(/[^0-9]/g, '');
                    this.value = value ? new Intl.NumberFormat('id-ID').format(value) : '';
                });

                // ✅ STRIP NON-NUMERIC CHARACTERS FROM 'distribusi_uang' ON SUBMIT
                form.on('submit', function() {
                    if (distribusiUang.prop('disabled') === false) {
                        const cleanValue = distribusiUang.val().replace(/\./g, '');
                        distribusiUang.val(cleanValue);
                    }
                });
            });
        </script>
    @endpush

@endsection
