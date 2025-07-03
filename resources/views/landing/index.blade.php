<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AFSHEENTOUR - Free Travel Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="/free_travel/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="/free_travel/preconnect" href="https://fonts.gstatic.com">
    <link href="/free_travel/https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="/free_travel/https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css"
        rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/free_travel/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="/free_travel/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/free_travel/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Topbar Start -->
    <div class="container-fluid bg-light pt-3 d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-center text-lg-left mb-2 mb-lg-0">
                    <div class="d-inline-flex align-items-center">
                        <p><i class="fa fa-envelope mr-2"></i>afsheentour14@gmail.com</p>
                        <p class="text-body px-3">|</p>
                        <p><i class="fa fa-phone-alt mr-2"></i>+62 857 8301 2544</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center text-lg-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-primary px-3" href="">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="text-primary pl-3" href="">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">AFSHEEN</span>TOUR</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="index.html" class="nav-item nav-link active">Home</a>
                        <a href="#afsheen-tour" class="nav-item nav-link">About</a>
                        <a href="#services" class="nav-item nav-link">Layanan</a>
                        <a href="#packages" class="nav-item nav-link">Paket Tour</a>
                        <a href="#testimonial" class="nav-item nav-link">Testimonial</a>
                        <!-- Tombol Login/Logout -->
                        @guest
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        @endguest

                        @auth
                            <a href="{{ route('logout') }}" class="nav-item nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth

                        {{-- @guest
                            <!-- Tampil jika belum login -->
                            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        @endguest

                        @auth
                            <!-- Tampil jika sudah login -->
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>
                                </div>
                            </div>

                            <!-- Form Logout tersembunyi -->
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endauth --}}

                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" style="height: auto; max-height: 700px; object-fit: cover;"
                        src="/free_travel/img/poto03.jpeg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Liburan Impianmu Dimulai Bersama Kami!</h1>

                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="/free_travel/img/carousel-2.jpg" alt="Image">
                    <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                        <div class="p-3" style="max-width: 900px;">
                            <h4 class="text-white text-uppercase mb-md-3">Tours & Travel</h4>
                            <h1 class="display-3 text-white mb-md-4">Liburan Impianmu Dimulai Bersama Kami!</h1>
                            <a href="" class="btn btn-primary py-md-3 px-md-5 mt-2">Pesan Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-prev-icon mb-n2"></span>
                </div>
            </a>
            <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                <div class="btn btn-dark" style="width: 45px; height: 45px;">
                    <span class="carousel-control-next-icon mb-n2"></span>
                </div>
            </a>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Booking Start -->
    <div class="container text-center mt-5">
        <h2 class="mb-4" style="font-weight: bold;">Atur Perjalanan Impianmu</h2>
    </div>
    <h2 style="color: rgb(236, 228, 228); background: rgb(236, 228, 228);">Atur perjalanan impianmu</h2>


    <form action="{{ route('hasil') }}" method="GET">
        <div class="container-fluid booking mt-5 pb-5">
            <div class="container pb-5">
                <div class="bg-light shadow" style="padding: 30px;">
                    <div class="row align-items-center" style="min-height: 60px;">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <input type="date" class="form-control p-4 datetimepicker-input"
                                            name="tanggal_mulai" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date1" data-target-input="nearest">
                                            <input type="date" class="form-control p-4 datetimepicker-input"
                                                name="tanggal_selesai" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <div class="date" id="date2" data-target-input="nearest">
                                            <input type="number" class="form-control p-4 datetimepicker-input"
                                                placeholder="Budget/Orang " name="budget" data-target="#date2"
                                                data-toggle="datetimepicker" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3 mb-md-0">
                                        <input type="number" class="form-control p-4 datetimepicker-input"
                                            placeholder="Jumlah Orang " name="jumlah_orang" data-target="#date2"
                                            data-toggle="datetimepicker" required/>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-block" type="submit"
                                style="height: 47px; margin-top: -2px;">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Booking End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5">
            <div class="row">
                <div class="col-lg-6" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="/free_travel/img/poto04.jpeg"
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 pt-5 pb-lg-5">
                    <div class="about-text bg-white p-4 p-lg-5 my-lg-5">
                        <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">About Us</h6>
                        <h1 class="mb-3">Kami Hadirkan Paket Wisata Terbaik, Sesuai Keinginan Anda</h1>
                        <p>Nikmati destinasi favorit dengan harga bersahabat dan pelayanan ramah. Mau jelajah alam,
                            budaya, atau santai di pantai? Semua bisa — tinggal pilih, kami yang urus!</p>
                        <div class="row mb-4">
                            <div class="col-6">
                                <img class="img-fluid" src="/free_travel/img/pulau_tegal_mas.jpg" alt=""
                                    style="width: 300px; height: 200px; object-fit: cover;">
                            </div>
                            <div class="col-6">
                                <img class="img-fluid" src="/free_travel/img/teluk_hantu.jpg" alt=""
                                    style="width: 300px; height: 200px; object-fit: cover;">
                            </div>
                        </div>
                        <a href="" class="btn btn-primary mt-1">Pesan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid pb-5">
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-money-check-alt text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Kenyamanan Utama</h5>
                            <p class="m-0">Nikmati liburan dengan fasilitas terbaik dan layanan prima. Kami hadir
                                untuk memastikan setiap momen perjalanan Anda terasa istimewa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-award text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Layanan Terbaik</h5>
                            <p class="m-0">Kami selalu siap memberikan pelayanan ramah, cepat, dan profesional untuk
                                kenyamanan perjalanan Anda.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="d-flex mb-4 mb-lg-0">
                        <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-primary mr-3"
                            style="height: 100px; width: 100px;">
                            <i class="fa fa-2x fa-globe text-white"></i>
                        </div>
                        <div class="d-flex flex-column">
                            <h5 class="">Paket Custom Sesuai Keinginan</h5>
                            <p class="m-0">Punya rencana sendiri? Kami bantu wujudkan!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->


    <!-- Destination Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Destination</h6>
                <h1>Explore Top Destination</h1>
            </div>
            <div class="row">
                @foreach ($destinasi as $dstn)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="destination-item position-relative overflow-hidden mb-2">
                            <img class="img-fluid" src="{{ asset('storage/' . $dstn->gambar) }}" alt=""
                                style="width: 350px; height: 219px; object-fit: cover;">
                            <a class="destination-overlay text-white text-decoration-none" href="">
                                <h5 class="text-white">{{ $dstn->nama }}</h5>
                                <span>{{ $dstn->deskripsi }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
    <!-- Destination Start -->


    <!-- Service Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 id="services" class="text-primary text-uppercase" style="letter-spacing: 5px;">Services</h6>
                <h1>Layanan Tours & Travel</h1>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-route mx-auto mb-4"></i>
                        <h5 class="mb-2">Travel Guide</h5>
                        <p class="m-0">Jelajahi destinasi dengan nyaman bersama pemandu berpengalaman dari kami.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-ticket-alt mx-auto mb-4"></i>
                        <h5 class="mb-2">Pemesanan Tiket</h5>
                        <p class="m-0">Mau tiket pesawat, kereta, atau lainnya? Kami bantu urus semuanya dengan
                            mudah dan cepat.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-item bg-white text-center mb-2 py-5 px-4">
                        <i class="fa fa-2x fa-hotel mx-auto mb-4"></i>
                        <h5 class="mb-2">Paket Wisata Lengkap</h5>
                        <p class="m-0">Dari tiket, penginapan, hingga jadwal perjalanan — semua kami siapkan dalam
                            satu paket praktis.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- Packages Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 id="packages" class="text-primary text-uppercase" style="letter-spacing: 5px;">Packages</h6>
                <h1>Pefect Tour Packages</h1>
            </div>
            <div class="row">
                @foreach ($paket as $pkt)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="package-item bg-white mb-2">
                            <img class="img-fluid" src="{{ asset('storage/' . $pkt->gambar) }}" alt=""
                                style="width: 350.01px; height: 233.33px; object-fit: cover;">
                            <div class="p-4">
                                <div class="d-flex justify-content-between mb-3">
                                    <small class="m-0"><i
                                            class="fa fa-map-marker-alt text-primary mr-2"></i>Lampung</small>
                                    <small class="m-0"><i
                                            class="fa fa-calendar-alt text-primary mr-2"></i>{{ $pkt->durasi }}</small>
                                    <small class="m-0"><i
                                            class="fa fa-user text-primary mr-2"></i>{{ $pkt->jumlah_orang }}</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <a class="h5 text-decoration-none">{{ $pkt->nama }}</a>
                                    <a href="{{ route('paket.summary', $pkt->id) }}">More</a>
                                </div>

                                <div class="border-top mt-4 pt-4">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="m-0"><i class="fa fa-star text-primary mr-2"></i>4.5
                                            <small>(100)</small>
                                        </h6>
                                        <h5 class="m-0">{{ $pkt->harga }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Packages End -->


            <!-- Registration Start -->
            <div class="container-fluid py-5"
                style="margin: 90px 0;background-image: url('{{ url('free_travel/img/poto03.jpeg') }}'); background-size: cover; background-position: center;">
                <div class="container py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-7 mb-5 mb-lg-0">
                            <div class="mb-4">
                                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;"> SAATNYA
                                    LIBURAN!</h6>
                                <h1 class="text-white"><span class="text-primary">Liburan Anti Ribet </span> Semua
                                    Sudah Kami Siapkan untuk Anda!</h1>
                            </div>
                            <p class="text-white">Nikmati keindahan alam yang menakjubkan – dari pantai pasir
                                putih, pulau eksotis, hingga pesona alam liar Way Kambas. Rasakan momen romantis
                                bersama pasangan dengan suasana yang tenang dan pemandangan yang memukau.</p>
                            <ul class="list-inline text-white m-0">
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Paket lengkap
                                    hotel, transportasi, dan tour guide</li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Kunjungi Pahawang,
                                    Tegal Mas, dan Air Terjun indah</li>
                                <li class="py-2"><i class="fa fa-check text-primary mr-3"></i>Cocok untuk
                                    liburan sahabt ataupun keluarga</li>
                            </ul>
                        </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Registration End -->

    <!-- Testimonial Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 id="testimonial" class="text-primary text-uppercase" style="letter-spacing: 5px;">Testimonial</h6>
                <h1>What Say Our Clients</h1>
            </div>
            <div class="owl-carousel testimonial-carousel">
                <div class="text-center pb-4">
                    <img class="img-fluid mx-auto" src="/free_travel/img/testimonial-1.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet
                            eirmod eos labore diam
                        </p>
                        <h5 class="text-truncate">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="/free_travel/img/testimonial-2.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet
                            eirmod eos labore diam
                        </p>
                        <h5 class="text-truncate">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="/free_travel/img/testimonial-3.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet
                            eirmod eos labore diam
                        </p>
                        <h5 class="text-truncate">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
                <div class="text-center">
                    <img class="img-fluid mx-auto" src="/free_travel/img/testimonial-4.jpg"
                        style="width: 100px; height: 100px;">
                    <div class="testimonial-text bg-white p-4 mt-n5">
                        <p class="mt-5">Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet
                            eirmod eos labore diam
                        </p>
                        <h5 class="text-truncate">Client Name</h5>
                        <span>Profession</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->


    <!-- Blog Start -->
    <div class="container-fluid py-5">
        <div class="container pt-5 pb-3">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">Our Blog</h6>
                <h1>Latest From Our Blog</h1>
            </div>
            <div class="row pb-3">
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="/free_travel/img/blog-1.jpg" alt="">
                            <div class="blog-date">
                                <h6 class="font-weight-bold mb-n1">01</h6>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Tours &
                                    Travel</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita
                                justo diam amet</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="/free_travel/img/blog-2.jpg" alt="">
                            <div class="blog-date">
                                <h6 class="font-weight-bold mb-n1">01</h6>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Tours &
                                    Travel</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita
                                justo diam amet</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 pb-2">
                    <div class="blog-item">
                        <div class="position-relative">
                            <img class="img-fluid w-100" src="/free_travel/img/blog-3.jpg" alt="">
                            <div class="blog-date">
                                <h6 class="font-weight-bold mb-n1">01</h6>
                                <small class="text-white text-uppercase">Jan</small>
                            </div>
                        </div>
                        <div class="bg-white p-4">
                            <div class="d-flex mb-2">
                                <a class="text-primary text-uppercase text-decoration-none" href="">Admin</a>
                                <span class="text-primary px-2">|</span>
                                <a class="text-primary text-uppercase text-decoration-none" href="">Tours &
                                    Travel</a>
                            </div>
                            <a class="h5 m-0 text-decoration-none" href="">Dolor justo sea kasd lorem clita
                                justo diam amet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-white-50 py-5 px-sm-3 px-lg-5" style="margin-top: 90px;">
        <div class="row pt-5">
            <div class="col-lg-3 col-md-6 mb-5">
                <a href="" class="navbar-brand">
                    <h1 id="afsheen-tour" class="text-primary"><span class="text-white">AFSHEEN</span>TOUR</h1>
                </a>
                <p>Nikmati keindahan alam yang memukau, tempat sempurna untuk berlibur dan melepas penat dari kesibukan
                    sehari-hari</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Follow Us</h6>
                <div class="d-flex justify-content-start">
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-twitter"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-outline-primary btn-square mr-2" href="#"><i
                            class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-outline-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Our Services</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destinasi</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Layanan</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Paket</a>
                    <a class="text-white-50 mb-2" href="{{ route('testimonial.index') }}"><i
                            class="fa fa-angle-right mr-2"></i>Testimonial</a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Usefull Links</h5>
                <div class="d-flex flex-column justify-content-start">
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>About</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Destinasi</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Layanan</a>
                    <a class="text-white-50 mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Paket</a>
                    <a class="text-white-50 mb-2" href="{{ route('testimonial.index') }}"><i
                            class="fa fa-angle-right mr-2"></i>Testimonial</a>

                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-5">
                <h5 class="text-white text-uppercase mb-4" style="letter-spacing: 5px;">Contact Us</h5>
                <p><i class="fa fa-map-marker-alt mr-2"></i>123 Street, New York, USA</p>
                <p><i class="fa fa-phone-alt mr-2"></i>+62 857 8301 2544</p>
                <p><i class="fa fa-envelope mr-2"></i>afsheentour14@gmail.com</p>
                <h6 class="text-white text-uppercase mt-4 mb-3" style="letter-spacing: 5px;">Newsletter</h6>
                <div class="w-100">
                    <div class="input-group">
                        <input type="text" class="form-control border-light" style="padding: 25px;"
                            placeholder="Your Email">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-3">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-dark text-white border-top py-4 px-sm-3 px-md-5"
        style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="row">
            <div class="col-lg-6 text-center text-md-left mb-3 mb-md-0">
                <p class="m-0 text-white-50">Copyright &copy; <a href="#">Domain</a>. All Rights Reserved.</a>
                </p>
            </div>
            <div class="col-lg-6 text-center text-md-right">
                <p class="m-0 text-white-50">Designed by <a href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i
            class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="/free_travel/https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="/free_travel/https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="free_travel/lib/easing/easing.min.js"></script>
    <script src="/free_travel/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/moment.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="/free_travel/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="/free_travel/mail/jqBootstrapValidation.min.js"></script>
    <script src="/free_travel/mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="/free_travel/js/main.js"></script>
</body>

</html>
