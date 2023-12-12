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
                    <a style="margin-left:2% " href=# class="btn btn-info d-flex align-items-center" data-bs-toggle="modal"
                        data-bs-target="#staticBackdrop">
                        <i class="ti ti-plus text-white me-1 fs-5"></i> Buat Laporan
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">UMKM</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.umkm.permintaan.report') }}" method="post" enctype="multipart/form-data">
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
                                <th>Action</th>
                                @if (auth()->user()->role == 'bidang')
                                    <th>Pengajuan</th>
                                @endif
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

                                    @if (auth()->user()->role == 'bidang')
                                        <td>
                                            <div class="btn-group">
                                                <form
                                                    action="{{ route('admin.umkm.permintaan.edit', [
                                                        'id' => $result->id,
                                                        'status' => 'terima',
                                                        'message' => ' ',
                                                    ]) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('put') {{-- Use this line to override the method --}}
                                                    <button type="submit" class="btn btn-success"
                                                        onclick="return confirm('Are you sure?')">Terima</button>
                                                </form>

                                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    Tolak
                                                </a>
                                            </div>
                                        </td>
                                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pesan</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.umkm.permintaan.edit', [
                                                                'id' => $result->id,
                                                                'status' => 'tolak',
                                                                'message' => ' ',
                                                            ]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('put')
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="mb-3">
                                                                            <label
                                                                                class="control-label mb-1">Keterangan<span
                                                                                    class="text-danger">*</span></label>
                                                                            <textarea name="keterangan" class="form-control @error('keterangan') is-invalid @enderror"></textarea>
                                                                            @error('keterangan')
                                                                                <small class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </small>
                                                                            @enderror

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-actions">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-shop"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-shop">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <td>
                                        <a href="{{route('umkm.detail', ['id' => $result->id])}}" class="btn btn-sm btn-secondary">
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
