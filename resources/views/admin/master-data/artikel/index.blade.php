@extends('admin.layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <h4 class="fw-semibold mb-8">{{ $title ?? '' }}</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.dashboard') }}" class="text-muted">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 col-xl-3">
                    <div id="table_config_filter" class="position-relative">
                        <input type="search" id="search-box" class="form-control ps-5" aria-controls="table_config"
                            placeholder="Nama pemilik, desa, kecamatan" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <a  style="margin-right: 2.5%" href="{{ route('admin.artikel.create') }}" class="btn btn-info d-flex align-items-center">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah {{ $title ?? '' }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert" id="success-alert">
            <div class="d-flex gap-2 align-items-center">
                <div>
                    <span class="d-inline-flex p-1 rounded-circle border border-2 border-white mb-0">
                        <i class="fs-5 ti ti-check"></i> 
                    </span>
                </div> 
                <div>
                    {{ $message ?? '' }}
                </div>
            </div>
        </div>
    @endif

    @if (count($datas) > 0)
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="table_config" class="table align-middle text-nowrap">
                    <thead class="header-item">
                        <tr>
                            <th>No</th>
                            <th>Nama Pemilik</th>
                            <th>Desa - Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Kota - Kabupaten</th>
                            <th>Jenis Usaha</th>
                            <th>Klasifikasi Usaha</th>
                            <th>Pendapatan Aset</th>
                            <th>Pendapatan Omset</th>
                            <th>Tenaga Kerja (Laki-Laki)</th>
                            <th>Tenaga Kerja (Perempuan)</th>
                            <th>Jumlah Tenaga Kerja</th>
                            <th>Keterangan Jenis Usaha</th>
                            <th>Keterangan</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $result)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $result->nama_pemilik }}</td>
                                <td>{{ $result->desa }}</td>
                                <td>{{ $result->kecamatan }}</td>
                                <td>{{ $result->kabupaten }}</td>
                                <td>{{ \App\Models\JenisUsaha::find($result->jenis_usaha_id)->name }}</td>
                                <td>{{ \App\Models\KlasifikasiUsaha::find($result->klasifikasi_usaha_id)->name }}</td>
                                <td>{{ $result->pendapatan_aset }}</td>
                                <td>{{ $result->pendapatan_omset }}</td>
                                <td>{{ $result->tenaga_kerja_l }}</td>
                                <td>{{ $result->tenaga_kerja_p }}</td>
                                <td>{{ $result->jumlah_tenaga_kerja }}</td>
                                <td>{{ $result->keterangan_jenis_usaha }}</td>
                                <td>{{ $result->keterangan   }}</td>
                                

                                <td>
                                    <a href="{{ route('admin.' . $active . '.edit', $result->id) }}"
                                        class="btn btn-sm btn-warning">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.' . $active . '.delete', $result->id) }}"
                                        method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                            onclick="return confirm('Are you sure?')">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="card">
        <div class="card-body">
            <div class="alert alert-warning mb-0" role="alert">
                <div class="d-flex gap-2 align-items-center">
                    <span class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block" style="font-size: 16px;">
                        <i class="ti ti-alert-circle"></i>
                    </span>
                    <p class="mb-0">
                        No {{ $title ?? " "}} data yet. <a href="{{ route('admin.'. $active . '.create') }}">Add</a> now.
                    </p>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/v/bs5/dt-1.13.6/datatables.min.js"></script>

    <script>
        dTable = $("#table_config").DataTable({
            "dom": "lrtip"
        });

        $("#search-box").keyup(function() {
            dTable.search($(this).val()).draw();
        }); 
    </script>
@endpush