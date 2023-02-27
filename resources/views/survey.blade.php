<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Website Resmi - Sistem Informasi Pengembangan dan Penelitian Kabupaten Cirebon</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Bootstrap Core Css -->
    <!-- <link href="{{ asset('admin-bsb/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet"> -->

    <!-- Waves Effect Css -->
    <link href="{{ asset('admin-bsb/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('admin-bsb/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- fontawesome Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Fonts Google Roboto -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <style>
        * {
            font-family: Roboto;
        }

        body {
            background: #F7FAFC;
        }

        .survey-thumbnail img {
            height: 160px;
            object-fit: cover;
            object-position: center;
            border-radius: 4px
        }

        .survey-question {
            padding: 20px;
        }

        .survey-question p.question {
            font-weight: bold;
        }

        .survey-question label {
            color: #000000;
        }

    </style>
</head>

<body>
    <section class="content">
        <div class="container-fluid my-4">
            <div class="row clearfix d-flex justify-content-center mb-5">
                <div class="col-md-6 col-12">
                    @include('layouts.alert')
                    <div class="survey-thumbnail">
                        <img src="{{ asset('polling/images/' . $polling->thumbnail) }}" alt="image" width="100%">
                    </div>
                </div>
            </div>
            @if ($polling->questions->count() > 0 && $polling->questions[0]->options->count() > 0)
                <form action="{{ route('survei.store', $polling->slug) }}" method="POST">
                    @csrf
                    @foreach ($polling->questions as $question)
                        <div class="row clearfix d-flex justify-content-center mt-4">
                            <div class="col-md-6 col-12">
                                <div class="card survey-question">
                                    <div class="card-body">
                                        <p class="question">{{ $question->question }}</p>
                                        @foreach ($question->options as $option)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    name="options[{{ $option->id }}]"
                                                    value="{{ $question->id }}-{{ $option->id }}"
                                                    id="defaultCheck{{ $option->id }}">
                                                <label class="form-check-label ml-1"
                                                    for="defaultCheck{{ $option->id }}">
                                                    {{ $option->option }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row clearfix d-flex justify-content-center my-4">
                        <div class="col-md-6 col-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            @else
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-6 col-12">
                        <div class="alert alert-danger">Survey belum siap, silahkan hubungi admin!</div>
                    </div>
                </div>
            @endif
        </div>
    </section>


    @extends('layouts.includes.frontfooter')

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @yield('data-scripts')
    @yield('js')

</body>

</html>
