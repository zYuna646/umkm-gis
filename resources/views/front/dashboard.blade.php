@extends('front.layouts.app')

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">DATA UMKM</a> / DASHBOARD</span>
                    <h3>DASHBOARD</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="single-property section">
        <div class="container">
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $pendapatanChart->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $totalUMKMChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $tenagaKerjaChart->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $bantuanChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $tenagaKerjaChart->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $bantuanChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $jenisUsahaChart->container() !!}
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            {!! $klasifikasiUsahaChart->container() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    {!! $kecamatanChart->container() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ $pendapatanChart->cdn() }}"></script>
    {{ $pendapatanChart->script() }}
    <script src="{{ $totalUMKMChart->cdn() }}"></script>
    {{ $totalUMKMChart->script() }}
    <script src="{{ $tenagaKerjaChart->cdn() }}"></script>
    {{ $tenagaKerjaChart->script() }}
    <script src="{{ $bantuanChart->cdn() }}"></script>
    {{ $bantuanChart->script() }}
    <script src="{{ $jenisUsahaChart->cdn() }}"></script>
    {{ $jenisUsahaChart->script() }}
    <script src="{{ $klasifikasiUsahaChart->cdn() }}"></script>
    {{ $klasifikasiUsahaChart->script() }}
    <script src="{{ $kecamatanChart->cdn() }}"></script>
    {{ $kecamatanChart->script() }}
@endpush
