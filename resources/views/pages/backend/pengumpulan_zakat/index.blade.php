@extends('layouts.backend.master')

@section('title', 'Data Pengumpulan Zakat — Baznas Kabupaten Cirebon')
@section('content')

    @push('datatable-styles')
        <link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/scrollbar.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/datatables.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('cuba/assets/css/vendors/datatable-extension.css') }}">
    @endpush

    <!-- file wrapper for better tabs start-->
    <div>
        <!-- pages title header start-->
        <div class="container-fluid">
            <div class="page-title">
                <div class="card card-absolute">
                    <div class="card-header bg-primary">
                        <h5 class="text-white">Data Pengumpulan Zakat</h5>
                    </div>
                    <div class="card-body">
                        <p>Dibawah ini adalah data pengumpulan zakat yang telah anda tambahkan. Data dibawah juga bisa anda
                            lihat detailnya dengan menekan logo mata berwarna hijau, edit dengan menekan logo pencil
                            berwarna ungu dan hapus dengan menekan logo sampah berwarna merah
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- pages title header end-->
        <!-- main content start-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="dt-ext table-responsive">
                                <table class="display" id="auto-fill">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NIK</th>
                                            <th>Nama Muzakki</th>
                                            <th>Jml Tanggungan</th>
                                            <th>Jml Dibayar</th>
                                            <th>Jenis Bayar</th>
                                            <th>Bayar Beras</th>
                                            <th>Bayar Uang</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $item)
                                            <tr>
                                                <td>{{ $item->id }}</td>
                                                <td>
                                                    @if($item->muzakki)
                                                        {{ $item->muzakki->nik ?? $item->muzakki->nomor_kk ?? '-' }}
                                                    @else
                                                        <span class="text-danger">Data muzakki tidak ditemukan</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex py-1 align-items-center">
                                                        @if($item->muzakki)
                                                            <div class="avatars mr-2">
                                                                <div class="avatar ratio"><img
                                                                        style="object-fit: cover;
                                                            width: 40px;
                                                            height: 40px;"
                                                                        class="b-r-8"
                                                                        src="https://ui-avatars.com/api/?background=556B2F&color=fff&name={{ $item->muzakki->nama_muzakki }}">
                                                                </div>
                                                            </div>
                                                            <div class="flex-fill">
                                                                <div class="font-weight-bold">{{ $item->muzakki->nama_muzakki }}</div>
                                                            </div>
                                                        @else
                                                            <span class="text-danger">-</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $item->jumlah_tanggungan }}</td>
                                                <td>{{ $item->jumlah_tanggungandibayar }}</td>
                                                <td>
                                                    @if($item->jenis_bayar === 'Beras')
                                                        <span class="badge badge-success">{{ $item->jenis_bayar }}</span>
                                                    @else
                                                        <span class="badge badge-primary">{{ $item->jenis_bayar }}</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->bayar_beras && $item->bayar_beras > 0)
                                                        {{ number_format($item->bayar_beras, 2, ',', '.') }} Kg
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($item->bayar_uang && $item->bayar_uang > 0)
                                                        Rp {{ number_format($item->bayar_uang, 0, ',', '.') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('pengumpulan_zakat.edit', $item->id) }}"
                                                        class="btn btn-info px-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            class="icon icon-tabler icon-tabler-edit" width="16"
                                                            height="16" viewBox="0 0 24 24" stroke-width="2"
                                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path
                                                                d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3">
                                                            </path>
                                                            <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3">
                                                            </path>
                                                            <line x1="16" y1="5" x2="19"
                                                                y2="8"></line>
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('pengumpulan_zakat.destroy', $item->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('delete')
                                                        <button class="btn btn-danger px-2" 
                                                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="icon icon-tabler icon-tabler-trash" width="16"
                                                                height="16" viewBox="0 0 24 24" stroke-width="2"
                                                                stroke="currentColor" fill="none" stroke-linecap="round"
                                                                stroke-linejoin="round">
                                                                <path stroke="none" d="M0 0h24v24H0z" fill="none">
                                                                </path>
                                                                <line x1="4" y1="7" x2="20"
                                                                    y2="7"></line>
                                                                <line x1="10" y1="11" x2="10"
                                                                    y2="17"></line>
                                                                <line x1="14" y1="11" x2="14"
                                                                    y2="17"></line>
                                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12">
                                                                </path>
                                                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center">
                                                    <div class="py-4">
                                                        <p class="text-muted">Belum ada data pengumpulan zakat</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>NIK</th>
                                            <th>Nama Muzakki</th>
                                            <th>Jml Tanggungan</th>
                                            <th>Jml Dibayar</th>
                                            <th>Jenis Bayar</th>
                                            <th>Bayar Beras</th>
                                            <th>Bayar Uang</th>
                                            <th>Opsi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main content end-->
    </div>
    <!-- file wrapper for better tabs start-->

    @push('datatable-scripts')
        <script src="{{ url('cuba/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.buttons.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/jszip.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/buttons.colVis.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/pdfmake.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/vfs_fonts.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.select.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/buttons.html5.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/buttons.print.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.responsive.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/dataTables.scroller.min.js') }}"></script>
        <script src="{{ url('cuba/assets/js/datatable/datatable-extension/custom.js') }}"></script>
        <script src="{{ url('cuba/assets/js/tooltip-init.js') }}"></script>
    @endpush

@endsection
