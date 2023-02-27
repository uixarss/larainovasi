@extends('layouts.guest')
@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <style>
        .text-heading {
            font-family: Roboto;
            font-style: normal;
            font-weight: 600;
            font-size: 40px;
            line-height: 47px;
        }

        @media (max-width: 500px) {
            .text-heading {
                font-size: 24px;
            }

            .heading-wrapper {
                padding: 34px 0px 14px 0px !important;
            }

            .img-polling-thumbnail img {
                height: 200px !important;
            }
        }

        .img-polling-thumbnail img {
            margin-bottom: 20px;
            height: 350px;
            object-position: center;
            object-fit: cover;
        }

        .author-name {
            font-family: Roboto;
            font-style: normal;
            font-weight: 600;
            font-size: 16px;
        }

        .polling-body {
            font-family: Roboto;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            text-align: justify;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid py-3 mt-5">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12 text-center heading-wrapper" style="padding: 64px 0px 54px 0">
                    <h1 class="text-heading">{{ $polling->name }}</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                    <div class="content-polling">
                        <div class="img-polling-thumbnail">
                            <img src="{{ asset('polling/images/' . $polling->thumbnail) }}" width="100%" alt="">
                        </div>
                        <div class="polling-author mt-3 d-flex align-items-center">
                            <img src="{{ asset('admin-bsb/images/profile-post-image.jpg') }}" alt=""
                                style="width: 32px; height: 32px; object-position: center; object-fit: cover; border-radius: 50%">
                            <span class="author-name ml-2">Admin</span>
                        </div>
                        <div class="polling-body mt-4">
                            {!! $polling->description !!}
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="card-body" style="padding: 32px;">
                            <p class="jumlah-survey mb-1" style="color: #000000;">
                                <b>{{ $polling->reponses()->distinct()->get(['ip'])->count() }} telah mengisi survey</b>
                            </p>
                            <p style="font-size: 14px" id="expireDate">
                                <span id="hour">
                                    <?php
                                    date_default_timezone_set('Asia/Jakarta');
                                    $awal = new DateTime($polling->expire_date);
                                    $akhir = new DateTime(now());
                                    $diff = date_diff($awal, $akhir);
                                    
                                    if ($akhir > $awal) {
                                        echo 'Polling expired';
                                    } else {
                                        if ($diff->h == 0) {
                                            if ($diff->i == 0) {
                                                echo $diff->s . ' detik lagi survey akan ditutup.';
                                            } else {
                                                echo $diff->i . ' menit lagi survey akan ditutup.';
                                            }
                                        } else {
                                            echo $diff->d . ' hari ';
                                            echo $diff->h . ' jam lagi survey akan ditutup.';
                                        }
                                    }
                                    ?>
                                </span>
                            </p>
                            {{-- Jika expire --}}
                            @if (now() > $polling->expire_date)
                                <a href="#" class="btn btn-danger btn-block py-2" style="margin-top: 40px;">Survey Tutup</a>
                            @else
                                <a href="{{ route('survei.show', $polling->slug) }}"
                                    class="btn btn-primary btn-block py-2" style="margin-top: 40px;">Isi Survey</a>
                            @endif
                            <p class="text-grey mt-2" style="font-size: 14px">Dengan mengisi survey ini, data kamu akan aman
                                sesuai dengan ketentuan
                                layanan dan kebijakan privasi.</p>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="card-body" style="padding: 32px;">
                            <p class="jumlah-survey mb-1" style="color: #000000;"><b>Hasil Statistik</b></p>
                            <a href="{{ route('survei.statistic', $polling->slug) }}"
                                class="btn btn-primary btn-block py-2" style="margin-top: 40px;">Lihat Statistik</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Jquery Core Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            const error = "{{ session('error') }}";
            if (error) {
                console.info('true')
                Swal.fire({
                    title: "Error!",
                    text: "Kamu hanya bisa isi survey 1 kali",
                    icon: "error",
                    button: "kembali",
                });
            }
        });
    </script>
@endsection
