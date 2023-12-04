<!-- Start Header Slider-->

<!-- ***** Preloader Start ***** -->
@if (Route::currentRouteName() != 'home')
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <ul class="info">
                        <li><i class="fa fa-envelope"></i> Sistem Informasi Pendataan UMKM</li>
                        <li><i class="fa fa-map"></i> Gorontalo</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">
                            <h1>SIAPAKU</h1>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li><a href="{{ route('home') }}"
                                    @if (Route::currentRouteName() == 'home') class="active" @endif>Home</a></li>
                            <li><a href="{{route('dashboard')}}" @if (Route::currentRouteName() == 'dashboard') class="active" @endif>Dashboard</a></li>
                            <li><a href="{{route('catalog')}}" @if (Route::currentRouteName() == 'catalog') class="active" @endif>Layanan UMKM</a></li>
                            <li><a href="{{ route('contact') }}"   @if (Route::currentRouteName() == 'contact') class="active" @endif>Tentang Kami</a></li>
                            <li><a href="{{ route('umkm') }}"   @if (Route::currentRouteName() == 'umkm') class="active" @endif>UMKM</a></li>
                            <li><a href="{{ route('login') }}"><i class="fa fa-person"></i> LOGIN</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
@endif
