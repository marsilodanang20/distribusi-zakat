@extends('layouts.backend.master')

@section('title', 'Tambah Data Distribusi Zakat — Collegetivity')
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
                        Tambah Data Distribusi Zakat
                    </h5>
                </div>
                <div class="card-body">
                    <p>
                        Dibawah ini adalah form untuk tambah data distribusi zakat.
                        <span class="d-none d-md-inline">
                            Data dibawah pastikan anda isi dengan benar dan lengkap ya, nanti datanya masuk menjadi laporan
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
                        <h5>Tambah Data Distribusi Zakat</h5>
                    </div>
                    <form method="POST" action="{{ route('distribusi_zakat.store') }}" enctype="multipart/form-data"
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
                                        <select class="form-control select2" name="nama_mustahik" required>
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
                                    <label for="gender">Jenis Zakat <span class="text-danger">*</span></label>
                                    <div class="input-group mb-3">
                                        <select class="custom-select" id="jenis_zakat" name="jenis_zakat">
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
                                    <label for="beras">Distribusi Beras <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="beras" type="number" step="0.01" value="{{ old('jumlah_beras') }}"
                                            class="form-control" name="jumlah_beras" placeholder="Masukkan jumlah beras" disabled>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Kilogram</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-6 mb-2">
                                    <label for="uang">Distribusi Uang <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input id="uang" type="text" value="{{ old('jumlah_uang') }}"
                                            class="form-control" name="jumlah_uang" placeholder="Masukkan nominal" disabled>
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

                // Logic for Type of Distribution
                const jenis = document.getElementById('jenis_zakat');
                const beras = document.getElementById('beras');
                const uang = document.getElementById('uang');
                const form = document.querySelector('form');

                function toggleDistribusi() {
                    if (jenis.value === 'Beras') {
                        beras.disabled = false;
                        uang.disabled = true;
                        uang.value = '';
                    } else if (jenis.value === 'Uang') {
                        uang.disabled = false;
                        beras.disabled = true;
                        beras.value = '';
                    } else {
                        beras.disabled = true;
                        uang.disabled = true;
                    }
                }

                if (jenis) {
                    jenis.addEventListener('change', toggleDistribusi);
                    // Initial check
                    toggleDistribusi();
                }

                // Rupiah Formatter
                if (uang) {
                    uang.addEventListener('input', function(e) {
                        let value = this.value.replace(/[^0-9]/g, '');
                        if (value) {
                            this.value = new Intl.NumberFormat('id-ID').format(value);
                        } else {
                            this.value = '';
                        }
                    });
                }

                // Strip non-numeric characters from 'uang' on submit
                if (form) {
                    form.addEventListener('submit', function() {
                        if (uang && !uang.disabled) {
                            uang.value = uang.value.replace(/\./g, '');
                        }
                    });
                }
            });
        </script>
    @endpush

@endsection
