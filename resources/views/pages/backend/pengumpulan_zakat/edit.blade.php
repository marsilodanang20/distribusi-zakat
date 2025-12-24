@extends('layouts.backend.master')

@section('title', 'Update Data Pengumpulan Zakat — Baznas Kabupaten Cirebon')
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
                        Update Data Pengumpulan Zakat
                    </h5>
                </div>
                <div class="card-body">
                    <p>
                        Dibawah ini adalah form untuk update data pengumpulan zakat.
                        <span class="d-none d-md-inline">
                            Data dibawah pastikan anda isi dengan benar dan lengkap ya, nantinya akan masuk ke laporan
                            pengumpulan zakat.
                        </span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Update Data Pengumpulan Zakat</h5>
                    </div>
                    <form method="POST" action="{{ route('pengumpulan_zakat.update', $item->id) }}" enctype="multipart/form-data"
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
                                    <label for="muzakki_select">Nama Lengkap Muzakki <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" id="muzakki_select" name="muzakki_id" required>
                                            <option value="">Pilih Muzakki (NIK - Nama)</option>
                                            @foreach ($muzakkis as $muzakki)
                                                <option value="{{ $muzakki->id }}" 
                                                        data-tanggungan="{{ $muzakki->jumlah_tanggungan }}"
                                                        {{ old('muzakki_id', $item->muzakki_id) == $muzakki->id ? 'selected' : '' }}>
                                                    {{ $muzakki->nik ?? $muzakki->nomor_kk ?? '-' }} - {{ $muzakki->nama_muzakki }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-4">
                                <div class="form-group col-md-4 mb-2">
                                    <label for="jumlah_tanggungan">Jumlah Tanggungan <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="jumlah_tanggungan" type="text"
                                            value="{{ old('jumlah_tanggungan', $item->jumlah_tanggungan) }}" class="form-control"
                                            name="jumlah_tanggungan" 
                                            placeholder="Pilih muzakki terlebih dahulu"
                                            style="background-color: #f5f5f5;"
                                            readonly>
                                    </div>
                                    <small class="text-muted">⚠️ Field ini terisi otomatis saat Anda memilih muzakki</small>
                                </div>

                                <div class="form-group col-md-4 mb-2">
                                    <label for="jumlah_tanggungandibayar">Jumlah Tanggungan yang Dibayar <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="jumlah_tanggungandibayar" type="text"
                                            value="{{ old('jumlah_tanggungandibayar', $item->jumlah_tanggungandibayar) }}" class="form-control"
                                            name="jumlah_tanggungandibayar">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 mb-2">
                                    <label for="jenis_bayar">Jenis Bayar <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_bayar" name="jenis_bayar">
                                            <option value="" disabled>Pilih ...</option>
                                            <option value="Beras" {{ old('jenis_bayar', $item->jenis_bayar) == 'Beras' ? 'selected' : '' }}>Beras</option>
                                            <option value="Uang" {{ old('jenis_bayar', $item->jenis_bayar) == 'Uang' ? 'selected' : '' }}>Uang</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="alert alert-primary py-2" role="alert">
                                        Isi salah satu dari 2 form dibawah ini, jika memilih beras sebelumnya maka isi
                                        dengan
                                        satuan KG dan jika uang maka isi dengan nominal angka tanpa RP
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="bayar_beras">Bayar Beras <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="bayar_beras" type="number" step="0.01" value="{{ old('bayar_beras', $item->bayar_beras) }}"
                                            class="form-control" name="bayar_beras" placeholder="Masukkan jumlah beras" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kilogram</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="bayar_uang">Bayar Uang <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="bayar_uang" type="text" value="{{ old('bayar_uang', number_format($item->bayar_uang, 0, ',', '.')) }}"
                                            class="form-control" name="bayar_uang" placeholder="Masukkan nominal" disabled>
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
                // ✅ INISIALISASI SELECT2
                $('#muzakki_select').select2({
                    placeholder: "Pilih Muzakki (NIK - Nama)",
                    allowClear: true
                });

                // ✅ AUTO-FILL JUMLAH TANGGUNGAN SAAT MUZAKKI DIPILIH
                $('#muzakki_select').on('select2:select', function(e) {
                    const selectedOption = e.params.data.element;
                    const tanggungan = $(selectedOption).data('tanggungan');
                    
                    if (tanggungan && tanggungan !== 'null' && tanggungan !== '') {
                        $('#jumlah_tanggungan').val(tanggungan);
                    } else {
                        $('#jumlah_tanggungan').val('');
                    }
                });

                // ✅ CLEAR JUMLAH TANGGUNGAN
                $('#muzakki_select').on('select2:clear', function(e) {
                    $('#jumlah_tanggungan').val('');
                });

                // ✅ LOGIC FOR TYPE OF PAYMENT
                const jenisBayar = $('#jenis_bayar');
                const bayarBeras = $('#bayar_beras');
                const bayarUang = $('#bayar_uang');
                const form = $('form');

                function toggleBayar() {
                    const val = jenisBayar.val();
                    if (val === 'Beras') {
                        bayarBeras.prop('disabled', false);
                        bayarUang.prop('disabled', true);
                        // Prevent clearing on load if it's already set from DB, but clear if user switches?
                        // For simplicity and to avoid losing existing data on accidental switch, we can just disable.
                        // However, to match create behavior of cleanup, we usually clear invalid one.
                        // But in edit, clearing might be annoying if they misclicked.
                        // Let's stick to simple enabling/disabling for now, but ensure empty if invalid type on submit.
                        if (bayarUang.val() !== '') bayarUang.val(''); 
                    } else if (val === 'Uang') {
                        bayarUang.prop('disabled', false);
                        bayarBeras.prop('disabled', true);
                        if (bayarBeras.val() !== '') bayarBeras.val('');
                    } else {
                        bayarBeras.prop('disabled', true);
                        bayarUang.prop('disabled', true);
                    }
                }

                // Initial toggle based on loaded data
                // We need to bypass the "clearing" logic on initial load, only clear on change.
                toggleBayar(); 

                jenisBayar.on('change', function() {
                     // Re-run toggle logic
                     toggleBayar();
                });

                // ✅ RUPIAH FORMATTER
                function formatRupiah(value) {
                     return new Intl.NumberFormat('id-ID').format(value);
                }

                bayarUang.on('input', function(e) {
                    let value = this.value.replace(/[^0-9]/g, '');
                    if (value) {
                        this.value = formatRupiah(value);
                    } else {
                        this.value = '';
                    }
                });

                // ✅ Ensure pre-filled money is formatted (if handled by blade usually raw, so we might need js init)
                // Actually handled by blade number_format above, but good to ensure stripping on submit.

                // ✅ STRIP NON-NUMERIC CHARACTERS FROM 'bayar_uang' ON SUBMIT
                form.on('submit', function() {
                    if (bayarUang.prop('disabled') === false) {
                        const cleanValue = bayarUang.val().replace(/\./g, '');
                        bayarUang.val(cleanValue);
                    }
                });
            });
        </script>
    @endpush

@endsection
