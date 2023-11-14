@extends('front.layouts.app')

@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .copy-link-button {
            display: inline-block;
            width: fit-content;
            padding: 6px 10px;
            font-size: 14px;
            background-color: var(--light-color);
            color: var(--dark-color);
            outline: none;
            border: none;
        }

        .toast-success {
            background-color: #000 !important;
            /* Set your custom background color here */
        }
    </style>
@endpush

@section('content')
    <!-- Start Slider  -->
    <section class="the-slider" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($reviewSliders as $reviewSlider)
                            <div class="item">
                                <img src="{{ asset('uploads/review-slider/' . $reviewSlider->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider  -->

    <!-- Start Slider  -->
    <section class="the-slider pt-0" data-aos="fade-up">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="owl-carousel owl-theme">
                        @foreach ($reviewSliders as $reviewSlider)
                            <div class="item">
                                <img src="{{ asset('uploads/review-slider/' . $reviewSlider->image) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Slider  -->

   
    <!-- Start Gallery -->
    <section class="gallery" id="artikel">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">Artikel</h2>
                            <p class="mb-5">Related about &nbsp;<img src="{{ asset('assets/front/img/logo.jpg') }}"
                                    alt="logo" width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="categories-links">
                            <span class="category-link category-active" data-name="All">All</span>
                            @foreach ($kategori as $category)
                                <span class="category-link" data-name="{{ $category->slug }}">{{ $category->name }}</span>
                            @endforeach
                            <a href="{{ route('catalog') }}">See More ...</a>
                        </div>

                        <div class="galleries">
                            @foreach ($artikels as $gallery)
                                <div class="gallery-img" data-name="{{ App\Models\KategoriArtikel::find($gallery->kategori_artikel_id)->slug ?? '' }}">
                                    <img src="{{ asset('uploads/catalog/image/' . $gallery->cover ?? '') }}"
                                        alt="gallery-img">
                                    <div class="gallery-overlay">
                                        <h4 class="mb-0">{{ $gallery->title ?? '' }}</h4>
                                        <span>{{App\Models\KategoriArtikel::find($gallery->kategori_artikel_id)->name}}</span>
                                        <div class="gallery-button mt-2">
                                            <a href="{{ route('artikel.detail', $gallery->id) }}"><i
                                                    class="fa-solid fa-magnifying-glass"></i></a>
                                            <button type="button" class="copy-link-button"
                                                data-link="{{ route('artikel.detail', $gallery->id) }}"><i
                                                    class="fa-solid fa-link"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Videos -->
    <section class="videos" id="videos">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">UMKM</h2>
                            <p class="mb-5">Umkm  Yang Beradad Di Gorontalo </p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="mb-3" style="height: 600px" id="map"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Videos -->

    <!-- Start Information -->
    <section class="information" id="information">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-right">
                        <div class="text-left">
                            <h2 class="mb-3">Information</h2>
                            <p class="mb-5"> &nbsp;<img
                                    src="{{ asset('assets/front/img/logo.jpg') }}" alt="logo" width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-right">
                        <div class="owl-carousel owl-theme">
                            @foreach ($informations as $info)
                                <div class="item">
                                    <img src="{{ $info->link_image }}" alt="">
                                    <div class="info-overlay">
                                        <div class="info-title">
                                            <h4>
                                                {{ $info->title ?? '' }}
                                            </h4>
                                            <span class="mb-3">Sumber : {{ $info->source ?? '-' }}</span>
                                            <a href="{{ $info->link_information }}" target="_blank">Read More</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Information -->

    <!-- Start Contact Us -->
    <section class="contact-us" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="content-title" data-aos="fade-down">
                        <div class="text-center">
                            <h2 class="mb-3">Contact Us</h2>
                            <p class="mb-5"><img src="{{ asset('assets/front/img/logo.jpg') }}" alt="logo"
                                    width="120px"></p>
                        </div>
                    </div>
                    <div class="content-body" data-aos="fade-up">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-12 col-lg-6">
                                <iframe src="{{ $aboutUs->maps ?? '' }}" frameborder="0" class="maps-frame"></iframe>
                            </div>
                            <div class="col-12 col-lg-6">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-phone"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Phone</h5>
                                                <span>{{ $aboutUs->phone ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-envelope"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Email</h5>
                                                <span>{{ $aboutUs->email ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="contact-us-card">
                                            <div class="contact-us-circle">
                                                <i class="fa-solid fa-clock"></i>
                                            </div>
                                            <div class="contact-us-text">
                                                <h5>Opening Hours</h5>
                                                <span>Senin-Sabtu 13.00–19.00</span>
                                                <span>Minggu 13.00–18.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- End Contact Us -->
@endsection


@push('scripts')
    <!-- Include Clipboard.js and SweetAlert libraries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function() {
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
        });
    </script>

    <script>
        var map = L.map('map').setView([0.556174, 123.058548], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        @foreach ($umkms as $umkm)
            @php
                $coordinates = DB::select("SELECT X(kordinat) AS lat, Y(kordinat) AS lng FROM u_m_k_m_s WHERE id = $umkm->id")[0];
                $latitude = $coordinates->lat;
                $longitude = $coordinates->lng;
            @endphp

            var lat = {{ $latitude }};
            var lng = {{ $longitude }};
            var marker = L.marker([lat, lng]).addTo(map);
            marker.bindPopup('{{ $umkm->nama_pemilik . ', jenis usaha : ' . $umkm->JenisUsaha->name . ', Klasifikasi Usaha : ' . $umkm->KlasifikasiUsaha->name }}');
        @endforeach
    </script>
@endpush
