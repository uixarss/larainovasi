@extends('layouts.guest')
@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <style>
        .home-survey img.survey-thumbnail:hover {
            opacity: 80%;
        }

        .home-survey .badge {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 14px;
        }

        .home-survey .card {
            border-radius: 0px 10px 10px 0px;
            border: 1px solid #dddddd;
            border-left: none;
            padding: 20px;
            height: 100%;
            position: relative;
        }

        .home-survey .card h1 {
            font-family: Roboto;
            font-style: normal;
            font-weight: 600;
            font-size: 24px;
            margin-bottom: 10px;
            color: #1A202C;
        }

        .home-survey .survey-author {
            border-right: 1px solid #dddddd;
            display: inline-block;
            width: 135px;
            font-weight: bold;
        }

        .home-survey .survey-response {
            font-weight: bold;
            margin-left: 35px;
        }

        .home-survey .col-md-12.p-0 {
            height: 300px;
        }

        .home-survey .body-footer {
            position: absolute;
            bottom: 0;
        }

        @media (max-width: 769px) {
            .home-survey .body-footer {
                position: relative;
            }

            .home-survey .col-md-12.p-0:nth-child(2) {
                height: auto;
            }

        }

        @media (max-width: 500px) {
            .home-survey .survey-response {
                margin-left: 10px;
            }

            .home-survey .survey-author {
                width: 110px;
            }

            .body-footer {
                width: 100% !important;
            }

        }

    </style>
@endsection
@section('content')
    <div class="bg-light py-5">
        <div class="home-hero mt-5 py-3">
            <div class="container">
                <div class="card rounded-lg">
                    <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 images" src="{{ asset('images/banner4.png') }}"
                                    alt="Sistem Informasi Pengembangan & Penelitian Kab. Cirebon 2021">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 images" src="{{ asset('images/banner1.png') }}"
                                    alt="Pengaduan - Sistem Informasi Pengembangan & Penelitian Kab. Cirebon">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 images" src="{{ asset('images/banner2.png') }}"
                                    alt="Pengaduan - Sistem Informasi Pengembangan & Penelitian Kab. Cirebon">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100 images" src="{{ asset('images/banner3.png') }}"
                                    alt="Inovasi - Sistem Informasi Pengembangan & Penelitian Kab. Cirebon">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-keunggulan">
            <div class="container">
                <h2 class="my-5"><b>Keunggulan dan kemudahan</b></h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">

                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon1.svg') }}"
                                    alt="Pendaftaran">
                            </div>
                            <h5 class="pb-3 pt-2">Innovative</h5>
                            <p>Website Menghimpun Inovasi Daerah Kabupaten Cirebon.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">
                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon2.svg') }}"
                                    alt="Informasi Inovasi Daerah Mudah Diakses Oleh Masyrakat Luas"></div>
                            <h5 class="pb-3 pt-2">Informative</h5>
                            <p>Informasi Inovasi Daerah Mudah Diakses Oleh Masyrakat Luas</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">

                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon3.svg') }}"
                                    alt="Masyarakat Mudah Memberikan Kontribusi Inovasi Daerah"></div>
                            <h5 class="pb-3 pt-2">Contributive</h5>
                            <p>Masyarakat Mudah Memberikan Kontribusi Inovasi Daerah</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">

                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon4.svg') }}"
                                    alt="Catatan Inovasi Daerah dapat dipantau dengan mudah dan  lengkap."></div>
                            <h5 class="pb-3 pt-2">Transparent</h5>
                            <p>Catatan Inovasi Daerah dapat dipantau dengan mudah dan lengkap.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">

                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon5.svg') }}"
                                    alt="Data Inovasi Daerah Aman dan Aplikasi Mudah digunakan"></div>
                            <h5 class="pb-3 pt-2">Secure & Easy</h5>
                            <p>Data Inovasi Daerah Aman dan Aplikasi Mudah digunakan.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home-keunggulan-box">

                            <div class="home-keunggulan-icon"><img src="{{ asset('images/icon6.svg') }}"
                                    alt="Bisa diakses dari manapun">
                            </div>
                            <h5 class="pb-3 pt-2">Responsive</h5>
                            <p>Bisa Diakses Dari Manapun.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        @if ($polling)
            <div class="home-survey">
                <div class="container">
                    <div class="row p-3">
                        <div class="col-lg-6 col-md-12 p-0" style="position: relative;">
                            <a href="{{ route('polling.show', $polling->slug) }}">
                                <img class="survey-thumbnail" src="{{ asset('polling/images/' . $polling->thumbnail) }}"
                                    width="100%" alt="" style="height: 300px; object-fit: cover; object-position: center;">
                            </a>
                            <span class="badge badge-primary py-2 px-3">Survey</span>
                        </div>
                        <div class="col-lg-6 col-md-12 p-0">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="title-survey">
                                        <a href="{{ route('polling.show', $polling->slug) }}">
                                            <h1>{{ $polling->name }}</h1>
                                        </a>
                                    </div>
                                    <div class="body-survey mb-3">
                                        {!! \Str::limit($polling->description, 350, '...') !!}
                                    </div>
                                    <div class="body-footer py-3" style="border-top: 1px solid #dddddd; width: 80%">
                                        <span class="survey-author" style="border-right: 1px solid #dddddd">
                                            <img src="{{ asset('admin-bsb/images/profile-post-image.jpg') }}" alt=""
                                                style="width: 32px; height: 32px; object-position: center; object-fit: cover; border-radius: 50%">
                                            <span class="author-name ml-2">Admin</span>
                                        </span>
                                        <span class="survey-response">
                                            <i class="fas fa-user-friends mr-2"></i>
                                            <span>{{ $polling->reponses()->distinct()->get(['ip'])->count() }}
                                                Responses</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @isset($last_update->publish_date)
            <div class="home-berita blog my-5">
                <div class="container">
                    <div class="row blog-title-wrapper text-center">
                        <div class="col-12">
                            <h2><b>Berita Terkini</b></h2>
                            <p class="mt-4 mb-0" style="color: #000000;">Update Terakhir:
                                {{ date('l, d F Y H:i:s a', strtotime($last_update->publish_date)) }}</p>

                        </div>
                    </div>
                    <div class="row blog-content-wrapper">
                        @foreach ($posts as $post)
                            <div class="col-lg-3 col-md-4 col-sm-6 mt-3 content-card">
                                <a href="{{ route('show.blog', ['slug' => $post->slug]) }}" style="text-decoration: none;">
                                    <div class="card">
                                        <img class="card-img-top blog-img"
                                            src="{{ asset('blog/images/' . $post->thumbnail) }}" alt="Card image cap">
                                        <div class="card-body">
                                            @foreach ($post->category as $category)
                                                <span class="badge badge-pill badge-primary px-2 py-1"
                                                    style="font-size: 10px; line-height: 12px;">{{ $category->name }}</span>
                                            @endforeach
                                            <div class="text-heading mt-2">
                                                <h5>{{ \Str::limit($post->title, 28, '...') }}</h4>
                                            </div>
                                            <div class="text-body">
                                                <p class="text-grey">
                                                    {{ date('l, d F Y', strtotime($post->publish_date)) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center mt-5">
                    <a href="{{ route('list.blog') }}" class="btn btn-outline-warning">Lihat Selengkapnya</a>
                </div>
            </div>
        @endisset
        <div class="home-dokumen my-5">
            <div class="container">
                <div class="card bg-gray shadow-md">
                    <div class="p-5 flex justify-between items-center">
                        <h2 class="text-left"><b>Dokumen</b></h2>
                    </div>
                    <div class="px-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Nama Dokumen</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_dokumen as $dokumen)
                                        <tr>
                                            <th scope="row">
                                                {{ \Carbon\Carbon::parse($dokumen->created_at)->format('d M Y') }}</th>
                                            <td>{{ $dokumen->name }}</td>
                                            <td>
                                                <a href="{{ route('download.dokumen', ['id' => $dokumen->id]) }}"
                                                    class="btn btn-info">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center pt-3 pb-4">
                        <a href="{{ url('/dokumen') }}" class="btn btn-outline-warning">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        @if (count($data_lomba) >= 1)
            <div class="home-lomba">
                <div class="container">
                    <div class="card bg-grey shadow-md">
                        <div class="card-body d-lg-text-center">
                            <div class="my-3 p5 mx-auto d-flex align-items-center">
                                <img class="mx-5 d-none d-lg-block" src="{{ asset('images/vectorLomba.svg') }}" alt="">
                                <div class="col mx-2">
                                    <h3 class="d-lg-text-center"><b>Lomba Penelitian Teknologi dan Sosekwil</b></h3>
                                    <p>Ayo segera daftarkan diri anda sekarang juga!</p>
                                    <a href="{{ route('list.lomba') }}"
                                        class="btn btn-warning text-white py-2 px-3">Daftar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="home-inovasi my-5">
            <div class="container">
                <div class="card bg-gray shadow-md">
                    <div class="p-5 flex justify-between items-center">
                        <h2 class="text-left"><b>Daftar Inovasi</b></h2>
                    </div>
                    <div class="px-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Nama Inovasi</th>
                                        <th scope="col">Program</th>
                                        <th scope="col">Kegiatan</th>
                                        <th scope="col">Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_inovasi as $key => $inovasi)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $inovasi->nama_inovasi }}</td>
                                            <td>{{ $inovasi->nama_sub_keg }}</td>
                                            <td>{{ $inovasi->nama_keg }}</td>
                                            <th scope="row">
                                                {{ \Carbon\Carbon::parse($inovasi->created_at)->format('d M Y') }}</th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center pt-3 pb-4">
                        <a href="{{ url('/inovasi') }}" class="btn btn-outline-warning">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-ngadu my-5">
            <div class="container">
                <div class="card bg-grey shadow-md">
                    <div class="my-3 mx-auto d-flex align-items-center">
                        <img class="mr-5 d-none d-lg-block" src="{{ asset('images/vectorNgadu.svg') }}" alt="">
                        <div class="col">
                            <h3 class="my-4"><b>Form Pengaduan</b></h3>
                            <form action="{{ route('post.pengaduan') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nama <small class="text-muted">(Wajib diisi)</small></label>
                                            <input type="text" class="form-control" name="name"
                                                placeholder="Nama Lengkap Anda..." required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">Alamat Email <small
                                                    class="text-muted">(Wajib
                                                    diisi)</small></label>
                                            <input type="email" name="email" class="form-control"
                                                placeholder="anda@contoh.com" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="exampleInputPassword1">No. Handhpone <small
                                                    class="text-muted">(Wajib
                                                    diisi)</small></label>
                                            <input type="text" name="no_hp" class="form-control"
                                                placeholder="08xxxxxxxxxx" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Judul Aduan <small class="text-muted">(Wajib diisi)</small></label>
                                            <input type="text" name="title" class="form-control"
                                                placeholder="Judul Aduan Anda">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Deskripsi Aduan <small class="text-muted">(Wajib
                                                    diisi)</small></label>
                                            <textarea class="form-control" name="body" rows="3"
                                                placeholder="Mohon jelasakan lebih detail aduan anda..."
                                                required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Lampiran <small class="text-muted">(Max 1Mb, Jenis file yang di
                                                    izinkan adalah
                                                    JPEG/PNG)</small></label>
                                            <input type="file" name="file" class="form-control-file">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary px-5 py-2 my-3">Kirim</button>
                                @include('layouts.alert')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-penelitian my-5">
            <div class="container">
                <div class="card bg-gray shadow-md">
                    <div class="p-5 flex justify-between items-center">
                        <h2 class="text-left"><b>Penelitian Daerah</b></h2>
                    </div>
                    <div class="px-5">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Judul Penelitian</th>
                                        <th scope="col">Institusi</th>
                                        <th scope="col">Penulis</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_penelitian as $key => $penelitian)
                                        <tr>
                                            <th scope="row">{{ ++$key }}</th>
                                            <td>{{ $penelitian->title }}</td>
                                            <td>{{ $penelitian->institution }}</td>
                                            <td>{{ $penelitian->author }}</td>
                                            <td>
                                                <a href="{{ route('download.penelitian', ['id' => $penelitian->id]) }}"
                                                    class="btn btn-info">
                                                    <i class="fas fa-cloud-download-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center pt-3 pb-4">
                        <a href="{{ url('/penelitian') }}" class="btn btn-outline-warning">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-kontak my-5">
            <div class="container">
                <div class="card bg-grey shadow-md">
                    <div class="px-5 pt-5">
                        <h2><b>Kontak Informasi</b></h2>
                    </div>
                    <br />
                    <div class="row px-5 pb-5">
                        <div class="col-md-6">
                            <div id="googlemap" style="width:100%; height:350px;"></div>
                        </div>
                        <div class="col-md-6 align-self-center">
                            <ul class="list-unstyled" style="font-size: 18px">
                                <li class="my-5">
                                    <a href="#" class="text-decoration-none text-body">
                                        <i class="fas fa-address-book mr-3"></i>
                                        Jl. Sunan Kalijaga No. 11
                                        Kota Sumber – Provinsi Jawa Barat
                                        Kode Pos 45611
                                    </a>
                                </li>
                                <li class="my-5">
                                    <a href="tel:0231321991" class="text-decoration-none text-body">
                                        <i class="fas fa-phone-alt mr-3"></i>
                                        (0231)321991
                                    </a>
                                </li>
                                <!-- <li class="my-5">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                <a href="mailto:infokabupatencirebon@gmail.com" class="text-decoration-none text-body" target="_blank">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  <i class="fas fa-envelope mr-3"></i>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  infokabupatencirebon@gmail.com
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </a>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                              </li> -->
                                <li class="my-5">
                                    <a href="https://www.facebook.com/pages/Bappelitbangda%20Kab.cirebon/1829101517375492"
                                        class="text-decoration-none text-body" target="_blank">
                                        <i class="fab fa-facebook mr-3"></i>
                                        Bappelitbangda Kab.cirebon
                                    </a>
                                </li>
                                <li class="my-5">
                                    <a href="https://www.instagram.com/bappelitbangdacirebonkab/"
                                        class="text-decoration-none text-body" target="_blank">
                                        <i class="fab fa-instagram mr-3"></i>
                                        @bappelitbangdacirebonkab
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('data-scripts')
    <!-- Google Maps Api JS -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDfc1tWERSDUdtHoFcp5CNWOfNvcNTZ0Fk&callback=initialize">
    </script>
@endsection

@section('js')
    <script type="text/javascript">
        jQuery(function($) {
            // Google Maps setup
            var googlemap = new google.maps.Map(
                document.getElementById('googlemap'), {
                    center: new google.maps.LatLng(-6.7637577, 108.4777191),
                    zoom: 20,
                    mapTypeId: 'roadmap'
                }
            );
        });
    </script>
@endsection
