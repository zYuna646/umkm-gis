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
    <div class="main-banner">
        <div class="owl-carousel owl-banner">
            <div class="item item-1">
                <div class="header-text">
                    <span class="category">SIAPAKU, <em>Gorontalo</em></span>
                    <h2>SIAPAKU!<br>LAYANAN UMKM GORONTALO</h2>
                </div>
            </div>
            <div class="item item-2">
                <div class="header-text">
                    <span class="category">SIAPAKU, <em>Gorontalo</em></span>
                    <h2>SIAPAKU!<br>LAYANAN UMKM GORONTALO</h2>
                </div>
            </div>
            <div class="item item-3">
                <div class="header-text">
                    <span class="category">SIAPAKU, <em>Gorontalo</em></span>
                    <h2>SIAPAKU!<br>LAYANAN UMKM GORONTALO</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="properties section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Lokasi Maps UMKM</h6>
                        <h2>UMKM Gorontalo✨</h2>
                    </div>
                </div>
            </div>

            <div class="content-body" data-aos="fade-up">
                <div class="mb-3" style="height: 60vh; width: 100%" id="map"></div>
            </div>
        </div>
    </div>



    <!-- Data UMKM Section -->
    <div class="properties section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Data UMKM</h6>
                        <h2>UMKM Gorontalo✨</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($umkms as $item)
                    <div class="col-lg-4 col-md-6">
                        <div class="item">
                            <a href="{{ route('umkm.detail', $item->id) }}">

                                @if ($item->foto == null)
                                    <img src="{{ asset('temp/assets/images/property-01.jpg') }}" alt="">
                                @else
                                    <img src="{{ asset('uploads/catalog/image/' . $item->foto) }}"
                                        alt="{{ $item->name }}">
                                @endif


                            </a>
                            <span class="category">{{ $item->KlasifikasiUsaha->name }}</span>
                            <h6>{{ $item->nama_pemilik }}</h6>
                            <h4><a href="property-details.html"></a></h4>
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
        </div>
    </div>

    <div class="contact section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 offset-lg-4">
                    <div class="section-heading text-center">
                        <h6>| Contact Us</h6>
                        <h2>Get In Touch With Our Agents</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div id="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12469.776493332698!2d-80.14036379941481!3d25.907788681148624!2m3!1f357.26927939317244!2f20.870722720054623!3f0!3m2!1i1024!2i768!4f35!3m3!1m2!1s0x88d9add4b4ac788f%3A0xe77469d09480fcdb!2sSunny%20Isles%20Beach!5e1!3m2!1sen!2sth!4v1642869952544!5m2!1sen!2sth"
                            width="100%" height="500px" frameborder="0"
                            style="border:0; border-radius: 10px; box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.15);"
                            allowfullscreen=""></iframe>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="item phone">
                                <img src="assets/images/phone-icon.png" alt="" style="max-width: 52px;">
                                <h6>010-020-0340<br><span>Phone Number</span></h6>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="item email">
                                <img src="assets/images/email-icon.png" alt="" style="max-width: 52px;">
                                <h6>info@villa.co<br><span>Business Email</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <form id="contact-form" action="" method="post">
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="name">Full Name</label>
                                    <input type="name" name="name" id="name" placeholder="Your Name..."
                                        autocomplete="on" required>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="email">Email Address</label>
                                    <input type="text" name="email" id="email" pattern="[^ @]*@[^ @]*"
                                        placeholder="Your E-mail..." required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="subject">Subject</label>
                                    <input type="subject" name="subject" id="subject" placeholder="Subject..."
                                        autocomplete="on">
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <label for="message">Message</label>
                                    <textarea name="message" id="message" placeholder="Your Message"></textarea>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="orange-button">Send Message</button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
            marker.bindPopup(
                '{!! $umkm->nama_pemilik .
                    ', jenis usaha : ' .
                    $umkm->JenisUsaha->name .
                    ', Klasifikasi Usaha : ' .
                    $umkm->KlasifikasiUsaha->name .
                    ', Link : ' .
                    $umkm->link !!} '
            );
        @endforeach
    </script>
@endpush
