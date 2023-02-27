@extends('layouts.guest')
@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <style>
        .text-heading h5 {
            font-weight: bold;
        }

        .expire-date {
            margin-top: 11px;
        }

        .responses {
            margin-top: 6px;
        }

        .responses span span {
            color: #4285F4;
        }

        .expire-date,
        .responses {
            font-size: 11px;
            font-weight: 500;
        }

        .expire-date .date span {
            color: red;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid py-3 mt-5">
        <div class="container my-5 p-0">
            <h2 class="font-weight-bold">Pollings</h2>
            @if ($pollings->count() > 0)
                <p class="text-secondary">Update terakhir:
                    {{ date('l, d F Y H:m:s', strtotime($pollings[0]->created_at)) }}
            @endif
            </p>
            <div class="blog">

                <form action="{{ route('polling.cari') }}" method="GET" class="search">
                    <i class="far fa-search"></i>
                    <input type="text" name="cari" class="form-control input-search" id="formGroupExampleInput"
                        placeholder="Search Polling">
                </form>
                <div class="row blog-content-wrapper">
                    @if ($pollings)
                        @foreach ($pollings as $polling)
                            <div class="col-lg-3 col-md-4 col-sm-6 mt-3 content-card">
                                <a href="#" style="text-decoration: none;">
                                    <div class="card">
                                        <img class="card-img-top blog-img"
                                            src="{{ asset('polling/images/' . $polling->thumbnail) }}"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <div class="text-heading mt-2">
                                                <h5 class="mt-0">{{ $polling->name }}</h5>
                                            </div>
                                            <div class="text-body">
                                                <div class="expire-date">
                                                    <i class="fal fa-clock mr-1"></i>
                                                    <span class="date">
                                                        Expire:
                                                        <span>{{ date('l, d F Y', strtotime($polling->expire_date)) }}</span></span>
                                                </div>
                                                <div class="responses">
                                                    <i class="far fa-address-book mr-1"></i>
                                                    <span>Responses:
                                                        <span>{{ $polling->reponses()->distinct()->get(['ip'])->count() }}</span></span>
                                                </div>

                                            </div>
                                            <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                            @if (now() > $polling->expire_date)
                                                <a href="{{ route('polling.show', $polling->slug) }}"
                                                    style="text-decoration: none; margin-top: 11px; font-size: 14px;"
                                                    class="btn btn-danger btn-block">Lihat
                                                    Survey</a>
                                            @else
                                                <a href="{{ route('polling.show', $polling->slug) }}"
                                                    style="text-decoration: none; margin-top: 11px; font-size: 14px;"
                                                    class="btn btn-outline-warning btn-block">Isi Survey</a>
                                            @endif
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        <div class="col-lg-12 text-center btn-loadmore d-flex justify-content-center">
                            {{ $pollings->links() }}
                            {{-- <div class="btn btn-primary">
                            Load More
                        </div> --}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
