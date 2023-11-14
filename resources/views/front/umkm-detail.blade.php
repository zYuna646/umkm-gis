@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBjEFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        .toast-success {
            background-color: #000 !important;
            /* Set your custom background color here */
        }

        .product-detail {
            margin: 40px 0;
        }

        .product-detail .card .card-body {
            padding: 60px !important;
        }

        .carousel-item img {
            width: 100%;
            height: 400px !important;
            object-fit: cover;
        }

        .header-slider .carousel .carousel-item .carousel-caption {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            text-align: left;
            color: white;
            padding: 20px;
        }

        .header-slider .carousel .carousel-item .carousel-caption h1 {
            font-size: 40px;
            font-weight: 700;
        }

        .header-slider .carousel .carousel-item .carousel-caption p {
            font-size: 14px;
            font-weight: 300;
            margin-bottom: 20px;
            text-wrap: wrap;
            width: 60%;
        }

        .btn-custom-transparent {
            background-color: transparent;
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 6px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--light-color);
            transition: all 0.3s;
        }

        .btn-custom-transparent:hover {
            background-color: var(--light-color);
            border: 2px solid var(--light-color);
            color: var(--dark-color);
        }

        @media (max-width: 991.98px) {
            .carousel-item img {
                height: 350px !important;
            }
        }

        @media (max-width: 767.98px) {
            .carousel-item img {
                width: 100%;
                height: 250px !important;
                object-fit: cover;
            }
        }

        #sync1 .btn-nav-dark {
            width: 20px;
            height: 20px;
            padding: 2px;
            background-color: rgba(0, 0, 0, .6);
            color: #fff;
            font-size: 12px;
        }

        #sync1 .owl-nav {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        #sync1 .item {
            border-radius: 0 !important;
        }

        #sync1 .item img {
            height: fit-content;
            object-fit: cover;
        }

        table tr td {
            padding: 5px;
        }

        .category span {
            font-size: 14px !important;
        }

        .btn-copy {
            background-color: transparent;
            color: var(--dark-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-copy:hover {
            background-color: var(--dark-color);
            border: 2px solid var(--dark-color);
            color: var(--light-color);
        }

        .btn-shop {
            background-color: var(--dark-color);
            color: var(--light-color);
            border: none;
            border-radius: 0;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border: 2px solid var(--dark-color);
            transition: all 0.3s;
        }

        .btn-shop:hover {
            background-color: var(--light-color);
            border: 2px solid var(--dark-color);
            color: var(--dark-color);
        }

        .related-product {
            margin-bottom: 50px;
        }

        .btn-see-more {
            text-decoration: none;
            color: var(--dark-color);
            font-size: 14px;
        }

        .btn-see-more:hover {
            text-decoration: underline;
        }
    </style>
@endpush

@section('content')
    <!-- Start Header Slider-->
    <header class="header-slider">
        <div class="container">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach ($mainSliders as $key => $mainSlider)
                        <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                            <img src="{{ asset('uploads/main-slider/' . $mainSlider->image) }}" class="d-block w-100"
                                alt="Slider Image">
                            <div class="carousel-caption">
                                <h1>{{ $mainSlider->title ?? '' }}</h1>
                                <p class="text-wrap slider-subtitle">{{ $mainSlider->sub_title ?? '' }}</p>
                                <a href="{{ $mainSlider->link ?? '' }}" class="btn btn-custom-transparent">Shop Now</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
    <!-- End Header Slider -->

    <section class="product-detail">
        <div class="container">
            <div class="card bg-transparent border-0 rounded-0">
                <div class="card-body p-0">
                    <div class="row g-4">
                        <div class="col-lg-5">
                            <div class="mb-3" style="height: 450px" id="map"></div>
                        </div>
                        <div class="col-lg-7">
                            <h3 class="fw-semibold">{{ $umkm->nama_pemilik ?? '' }}</h3>
                          
                            <table id="table_config" class="table align-middle text-nowrap">
                                <thead class="header-item">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <tr>
                                            <td>alamat : </td>
                                            <td>{{ $umkm->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>desa - kelurahan : </td>
                                            <td>{{ $umkm->desa }}</td>
                                        </tr>
                                        <tr>
                                            <td>kecamatan : </td>
                                            <td>{{ $umkm->kecamatan }}</td>
                                        </tr>
                                        <tr>
                                            <td>kota - kabupaten : </td>
                                            <td>{{ $umkm->kabupaten }}</td>
                                        </tr>
                                        <tr>
                                            <td>jenis usaha : </td>
                                            <td>{{ App\Models\JenisUsaha::find($umkm->jenis_usaha_id)->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>klasifikasi usaha : </td>
                                            <td>{{ App\Models\KlasifikasiUsaha::find($umkm->klasifikasi_usaha_id)->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Keterangan Jenis Usaha : </td>
                                            <td>  {!! $umkm->keterangan_jenis_usaha !!}</td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        // product detail
        $(function() {
            var sync1 = $("#sync1");

            sync1.owlCarousel({
                items: 1,
                slideSpeed: 2000,
                nav: true,
                autoplay: false,
                dots: false,
                loop: true,
                responsiveRefreshRate: 200,
                navText: [
                    '<span class="position-absolute top-50 start-0 ms-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-left"></i></span>',
                    '<span class="position-absolute top-50 end-0 me-2 translate-middle-y btn-nav-dark rounded-circle"><i class="fa fa-chevron-right"></i></span>'
                ],
            });

            // Initialize Clipboard.js
            new ClipboardJS('.copy-link-button', {
                text: function(trigger) {
                    return $(trigger).attr('data-link');
                }
            });

            // Add a success event listener to show a Toastr toast notification
            $('.copy-link-button').on('click', function(e) {
                showCopySuccessNotification();
            });

            function showCopySuccessNotification() {
                // Show a Toastr toast notification
                toastr.success('Link Copied!', null, {
                    timeOut: 1500,
                    positionClass: 'toast-bottom-left',
                    progressBar: true,
                });
            }
        })
    </script>
    <script>
        var map = L.map('map').setView([0.556174, 123.058548], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        @php
            $coordinates = DB::select("SELECT X(kordinat) AS lat, Y(kordinat) AS lng FROM u_m_k_m_s WHERE id = $umkm->id")[0];
            $latitude = $coordinates->lat;
            $longitude = $coordinates->lng;
        @endphp

        var lat = {{ $latitude }};
        var lng = {{ $longitude }};
        var marker = L.marker([lat, lng]).addTo(map);
        marker.bindPopup('{{ $umkm->nama_pemilik . ', jenis usaha : ' . $umkm->JenisUsaha->name . ', Klasifikasi Usaha : ' . $umkm->KlasifikasiUsaha->name }}');
    </script>
@endpush
