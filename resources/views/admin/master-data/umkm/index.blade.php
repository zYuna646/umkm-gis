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
                    @if (auth()->user()->role == 'admin')
                        <a style="margin-right: 2.5%" href="{{ route('admin.umkm.create') }}"
                            class="btn btn-info d-flex align-items-center">
                            <i class="ti ti-plus text-white me-1 fs-5"></i> Tambah {{ $title ?? '' }}
                        </a>
                        <a href="#" class="btn btn-success d-flex align-items-center" data-bs-toggle="modal"
                            data-bs-target="#staticBackdrop">
                            <!-- Perubahan di sini -->
                            <i class="ti ti-plus text-white me-1 fs-5"></i> Import Excel
                        </a>
                    @endif


                    @if (auth()->user()->role != 'admin')
                        <a style="margin-left:2% " href=# class="btn btn-info d-flex align-items-center"
                            data-bs-toggle="modal" data-bs-target="#staticBackdropUmkm">
                            <i class="ti ti-plus text-white me-1 fs-5"></i> Buat Laporan
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdropUmkm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">UMKM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.umkm.report') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="control-label mb-1">Start Date</label>
                                <input type="date" name="start_date" class="form-control" />

                            </div>
                            <div class="mb-3">
                                <label class="control-label mb-1">End Date</label>
                                <input type="date" name="end_date" class="form-control" />

                            </div>
                        </div>

                        <div class="form-actions">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-shop" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-shop">Buat Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">

                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Import UMKM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.umkm.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <h5>Jenis Usaha</h5>
                                        <div class="table-responsive">
                                            <table class="table align-middle text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Kode</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jenisUsaha as $item)
                                                        <tr>
                                                            <td>
                                                                {{ $item->name }}
                                                            </td>
                                                            <td>
                                                                {{ $item->id }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <h5>Klasifikasi Usaha</h5>
                                        <div class="table-responsive">
                                            <table class="table align-middle text-nowrap">
                                                <thead>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <th>Kode</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($klasifikasiUsaha as $item)
                                                        <tr>
                                                            <td>
                                                                {{ $item->name }}
                                                            </td>
                                                            <td>
                                                                {{ $item->id }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <label class="control-label mb-1">Upload Excel<span
                                                class="text-danger">*</span></label>
                                        <input type="file" name="excel"
                                            class="form-control @error('excel') is-invalid @enderror"
                                            accept=".xlsx, .xls" />
                                        @error('excel')
                                            <small class="invalid-feedback">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a class="btn btn-info" href="{{ route('admin.umkm.download') }}"
                            class="btn btn-primary">Download
                            Template</a>
                        <div class="form-actions">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-shop" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-shop">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert"
            id="success-alert">
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
                                <th>Kota - Kabupaten</th>
                                <th>Jenis Usaha</th>
                                <th>Klasifikasi Usaha</th>
                                <th>Status</th>
                                <th>Pesan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $result)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->nama_pemilik }}</td>
                                    <td>{{ $result->kabupaten }}</td>
                                    <td>{{ \App\Models\JenisUsaha::find($result->jenis_usaha_id)->name }}</td>
                                    <td>{{ \App\Models\KlasifikasiUsaha::find($result->klasifikasi_usaha_id)->name }}</td>
                                    <td
                                        class="font-weight-bold
                                    @if ($result->status == 'proses') bg-warning
                                    @elseif($result->status == 'terima') bg-success
                                    @elseif($result->status == 'tolak') bg-danger @endif
                                 ">

                                        {{ $result->status }}</td>
                                    <td>
                                        {{ $result->message }}
                                    </td>
                                    <td>
                                        @if (auth()->user()->role == 'admin')
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
                                        @endif
                                        <a href="{{ route('umkm.detail', ['id' => $result->id]) }}"
                                            class="btn btn-sm btn-secondary">
                                            <i class="ti ti-eye"></i>
                                        </a>
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
                        <span
                            class="rounded-circle px-1 py-0 border border-2 border-warning text-light bg-warning mb-0 d-block"
                            style="font-size: 16px;">
                            <i class="ti ti-alert-circle"></i>
                        </span>
                        <p class="mb-0">
                            No {{ $title ?? ' ' }} data yet. <a
                                href="{{ route('admin.' . $active . '.create') }}">Add</a>
                            now.
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
