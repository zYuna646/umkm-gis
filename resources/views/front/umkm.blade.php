@extends('front.layouts.app')

@push('styles')
@endpush

@section('content')
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="breadcrumb"><a href="#">Landing Page</a> / DATA UMKM</span>
                    <h3>DATA UMKM</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section properties">
        <div class="container">
            <ul class="properties-filter">
                <li>
                    <a class="is_active" href="#!" data-filter="*">Show All</a>
                </li>
                @foreach ($klasifikasiUsahas as $klasifikasiUsaha)
                    <li>
                        <a href="#!"
                            data-filter=".{{ strtolower($klasifikasiUsaha->name) }}">{{ $klasifikasiUsaha->name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="row properties-box">
                @foreach ($umkms as $item)
                    <div
                        class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6 {{ strtolower($item->JenisUsaha->name) }}">
                        <div class="item">
                            <a href="{{ route('umkm.detail', $item->id) }}"><img
                                    src="{{ asset('temp/assets/images/property-01.jpg') }}" alt=""></a>
                            <span class="category">{{ $item->KlasifikasiUsaha->name }}</span>
                            <h6>{{ $item->nama_pemilik }}</h6>
                            <h4><a href="{{ route('umkm.detail', $item->id) }}"></a></h4>
                            <ul>
                                <li>Desa/Kel: <span>{{ $item->desa }}</span></li>
                                <li>Jenis Usaha: <span>{{ $item->JenisUsaha->name }}</span></li>
                            </ul>
                            <div class="main-button">
                                <a href="{{ route('umkm.detail', $item->id) }}">Lihat</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <ul class="pagination">
                        {{-- <li><a class="is_active"href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#">>></a></li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End Catalog -->
@endsection
