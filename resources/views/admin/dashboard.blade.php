@extends('admin.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@section('content')
    <div class="owl-carousel counter-carousel owl-theme">
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-category-2 mb-3 text-warning" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-warning mb-1"> Jenis Usaha </p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $count_video ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-category-2 mb-3 text-warning" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-warning mb-1"> Klasifikasi Usaha </p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $count_information ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-warning shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-category-2 mb-3 text-warning" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M14 4h6v6h-6z"></path>
                            <path d="M4 14h6v6h-6z"></path>
                            <path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                            <path d="M7 7m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-warning mb-1"> Kategori Artikel </p>
                        <h5 class="fw-semibold text-warning mb-0">{{ $count_kategori ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-secondary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-news mb-3 text-secondary" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                            </path>
                            <path d="M8 8l4 0"></path>
                            <path d="M8 12l4 0"></path>
                            <path d="M8 16l4 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-secondary mb-1"> UMKM </p>
                        <h5 class="fw-semibold text-secondary mb-0">{{ $count_category ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="item">
            <div class="card border-0 zoom-in bg-light-secondary shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-news mb-3 text-secondary" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path
                                d="M16 6h3a1 1 0 0 1 1 1v11a2 2 0 0 1 -4 0v-13a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1v12a3 3 0 0 0 3 3h11">
                            </path>
                            <path d="M8 8l4 0"></path>
                            <path d="M8 12l4 0"></path>
                            <path d="M8 16l4 0"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-secondary mb-1"> Artikel </p>
                        <h5 class="fw-semibold text-secondary mb-0">{{ $count_catalog ?? 0 }}</h5>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="item">
            <div class="card border-0 zoom-in bg-light-success shadow-none">
                <div class="card-body">
                    <div class="text-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="icon icon-tabler icon-tabler-users-group mb-3 text-success" width="50" height="50"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M10 13a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M8 21v-1a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v1"></path>
                            <path d="M15 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M17 10h2a2 2 0 0 1 2 2v1"></path>
                            <path d="M5 5a2 2 0 1 0 4 0a2 2 0 0 0 -4 0"></path>
                            <path d="M3 13v-1a2 2 0 0 1 2 -2h2"></path>
                        </svg>
                        <p class="fw-semibold fs-3 text-success mb-1"> Visitor </p>
                        <h5 class="fw-semibold text-success mb-0">0</h5>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="mb-3" style="height: 600px" id="map"></div>

    @if (auth()->user()->role == 'dinas')
        <div class="card-body">
            <div class="text-center">
                <h1>Data UMKM Di Terima</h1>
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

        <div class="card-body">
            <div class="text-center">
                <h1>Data UMKM Di Proses</h1>
            </div>
        </div>

        <div class="single-property section">
            <div class="container">
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $pendapatanChart_->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $totalUMKMChart_->container() !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $tenagaKerjaChart_->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $bantuanChart_->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $tenagaKerjaChart_->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $bantuanChart_->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $jenisUsahaChart_->container() !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                {!! $klasifikasiUsahaChart_->container() !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {!! $kecamatanChart_->container() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(function() {
            $(".counter-carousel").owlCarousel({
                loop: true,
                margin: 30,
                mouseDrag: true,
                autoplay: true,
                autoplayTimeout: 4000,
                autoplaySpeed: 2000,
                nav: false,
                responsive: {
                    0: {
                        items: 2,
                    },
                    576: {
                        items: 2,
                    },
                    768: {
                        items: 3,
                    },
                    1200: {
                        items: 4,
                    }
                },
            });
        });
        var map = L.map('map').setView([0.556174, 123.058548], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var markers = []; // Create an array to store markers

        @foreach ($umkms as $umkm)
            @php
                $coordinates = DB::select("SELECT X(kordinat) AS lat, Y(kordinat) AS lng FROM u_m_k_m_s WHERE id = $umkm->id")[0];
                $latitude = $coordinates->lat;
                $longitude = $coordinates->lng;
            @endphp

            var lat = {{ $latitude }};
            var lng = {{ $longitude }};
            var marker = L.marker([lat, lng]);
            marker.bindPopup(
                '{{ $umkm->nama_pemilik . ', jenis usaha : ' . $umkm->JenisUsaha->name . ', Klasifikasi Usaha : ' . $umkm->KlasifikasiUsaha->name }}'
            );

            markers.push(marker);
        @endforeach

        for (var i = 0; i < markers.length; i++) {
            markers[i].addTo(map);
        }
    </script>

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


    <script src="{{ $pendapatanChart_->cdn() }}"></script>
    {{ $pendapatanChart_->script() }}
    <script src="{{ $totalUMKMChart_->cdn() }}"></script>
    {{ $totalUMKMChart_->script() }}
    <script src="{{ $tenagaKerjaChart_->cdn() }}"></script>
    {{ $tenagaKerjaChart_->script() }}
    <script src="{{ $bantuanChart_->cdn() }}"></script>
    {{ $bantuanChart_->script() }}
    <script src="{{ $jenisUsahaChart_->cdn() }}"></script>
    {{ $jenisUsahaChart_->script() }}
    <script src="{{ $klasifikasiUsahaChart_->cdn() }}"></script>
    {{ $klasifikasiUsahaChart_->script() }}
    <script src="{{ $kecamatanChart_->cdn() }}"></script>
    {{ $kecamatanChart_->script() }}
@endpush
