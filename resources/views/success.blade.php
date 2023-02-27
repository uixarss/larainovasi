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
            font-family: Public Sans;
        }

        .success-thumbnail img {
            width: 50%;
        }

        @media (max-width: 500px) {

            .success-thumbnail img {
                width: 90%;
            }

            h1 {
                font-size: 28px;
            }
        }

        .survey-question {
            padding: 20px;
        }

        h1 {
            font-family: Public Sans;
            font-style: normal;
            font-weight: 600;
            font-size: 36px;
        }

        p {
            font-family: Public Sans;
            font-style: normal;
            font-weight: 300;
            font-size: 18px;
            color: #B0B0B0;
        }

        .btn.btn-back-home {
            background: #3252DF;
            box-shadow: 0px 8px 15px rgba(50, 82, 223, 0.3);
            border-radius: 4px;
            padding: 9px 27px;
        }

    </style>
</head>

<body>

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="col-md-6 col-12 text-center">
                    <h1 class="mb-4">Yeay! Completed</h1>
                    <div class="success-thumbnail">
                        <img src="{{ asset('images/dancing.png') }}" alt="image">
                    </div>
                    <p class="text-grey">Terimakasih atas partisipasi anda pada survey<br><b>{{ $polling }}</b>
                    </p>
                    <a href="{{ url('/') }}" class="btn btn-back-home text-white mt-4">Back to Home</a>
                </div>
            </div>
        </div>
    </section>

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
