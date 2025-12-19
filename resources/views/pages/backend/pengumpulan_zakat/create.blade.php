@extends('layouts.backend.master')

@section('title', 'Tambah Data Pengumpulan Zakat — Baznas Kabupaten Cirebon')
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
                        Tambah Data Pengumpulan Zakat
                    </h5>
                </div>
                <div class="card-body">
                    <p>
                        Dibawah ini adalah form untuk tambah data penguumpulan zakat.
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
                        <h5>Tambah Data Pengumpulan Zakat</h5>
                    </div>
                    <form method="POST" action="{{ route('pengumpulan_zakat.store') }}" enctype="multipart/form-data"
                        class="needs-validation">
                        @csrf
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
                                    <label for="nama_matkul">Nama Lengkap Muzakki <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control select2" name="nama_muzakki" required>
                                            <option value="">Pilih Muzakki (Nama & NIK)</option>
                                            @foreach ($muzakkis as $muzakki)
                                                <option value="{{ $muzakki->id }}">
                                                    {{ $muzakki->nama_muzakki }} - {{ $muzakki->nik ?? $muzakki->nomor_kk ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row mt-4">
                                <div class="form-group col-md-4 mb-2">
                                    <label for="angkatan">Jumlah Tanggungan <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="jumlah_tanggungan" type="text"
                                            value="{{ old('jumlah_tanggungan') }}" class="form-control"
                                            name="jumlah_tanggungan">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 mb-2">
                                    <label for="angkatan">Jumlah Tanggungan yang Dibayar <span
                                            class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <input required id="jumlah_tanggungandibayar" type="text"
                                            value="{{ old('jumlah_tanggungandibayar') }}" class="form-control"
                                            name="jumlah_tanggungandibayar">
                                    </div>
                                </div>

                                <div class="form-group col-md-4 mb-2">
                                    <label for="gender">Jenis Bayar <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_bayar" name="jenis_bayar">
                                            <option value="" disabled selected>Pilih ...</option>
                                            <option value="Beras">Beras</option>
                                            <option value="Uang">Uang</option>
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
                                        <input id="bayar_beras" type="number" step="0.01" value="{{ old('bayar_beras') }}"
                                            class="form-control" name="bayar_beras" placeholder="Masukkan jumlah beras" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kilogram</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="bayar_uang">Bayar Uang <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="bayar_uang" type="text" value="{{ old('bayar_uang') }}"
                                            class="form-control" name="bayar_uang" placeholder="Masukkan nominal" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Rp</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary m-r-15" type="submit">Tambah</button>
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
                $('.select2').select2({
                    placeholder: "Pilih Muzakki (Nama & NIK)",
                    allowClear: true
                });

                // Logic for Type of Payment
                const jenisBayar = document.getElementById('jenis_bayar');
                const bayarBeras = document.getElementById('bayar_beras');
                const bayarUang = document.getElementById('bayar_uang');
                const form = document.querySelector('form');

                function toggleBayar() {
                    if (jenisBayar.value === 'Beras') {
                        bayarBeras.disabled = false;
                        bayarUang.disabled = true;
                        bayarUang.value = '';
                    } else if (jenisBayar.value === 'Uang') {
                        bayarUang.disabled = false;
                        bayarBeras.disabled = true;
                        bayarBeras.value = '';
                    } else {
                        bayarBeras.disabled = true;
                        bayarUang.disabled = true;
                    }
                }

                if (jenisBayar) {
                    jenisBayar.addEventListener('change', toggleBayar);
                    // Initial check
                    toggleBayar();
                }

                // Rupiah Formatter
                if (bayarUang) {
                    bayarUang.addEventListener('input', function(e) {
                        let value = this.value.replace(/[^0-9]/g, '');
                        if (value) {
                            this.value = new Intl.NumberFormat('id-ID').format(value);
                        } else {
                            this.value = '';
                        }
                    });
                }

                // Strip non-numeric characters from 'bayar_uang' on submit
                if (form) {
                    form.addEventListener('submit', function() {
                        if (bayarUang && !bayarUang.disabled) {
                            bayarUang.value = bayarUang.value.replace(/\./g, '');
                        }
                    });
                }
            });
        </script>
    @endpush

@endsection
