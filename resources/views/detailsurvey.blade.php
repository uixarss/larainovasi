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
            padding: 24px;
        }

        .survey-question p.title {
            font-size: 18px;
        }

        .btn-chart {
            font-size: 16px;
            color: #000000;
            font-weight: 500;
            font-family: Roboto;
        }

    </style>
</head>

<body>

    <section class="content">
        <div class="container-fluid my-4">
            <div class="row clearfix d-flex justify-content-center mb-5">
                <div class="col-md-6 col-12">
                    <div class="survey-thumbnail">
                        <img src="{{ asset('polling/images/' . $polling->thumbnail) }}" alt="image" width="100%">
                    </div>
                </div>
            </div>
            <form action="#">
                <div class="row clearfix d-flex justify-content-center mt-4">
                    <div class="col-md-6 col-12">
                        <div class="card survey-question">
                            <div class="card-body p-0">
                                <p class="title">{{ $polling->name }}</p>
                                <p>Author : Admin</p>
                                <p>Status :
                                    @if (now() > $polling->expire_date)
                                        <span class="badge badge-danger px-2 py-1">Deactive</span>
                                    @else
                                        <span class="badge badge-primary px-2 py-1">Active</span>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($polling->questions->count() > 0)
                    @foreach ($polling->questions as $q)
                        <div class="row clearfix d-flex justify-content-center mt-4">
                            <div class="col-md-6 col-12">
                                <div class="card survey-question">
                                    <div class="card-body p-0">
                                        <div class="accordion" id="accordionExample">
                                            <div class="card p-0" style="border: none;">
                                                <div class="card-header p-0" id="headingOne"
                                                    style="background: none; padding-bottom: 10px !important;">
                                                    <h2 class="mb-0">
                                                        <a class="p-0 btn-chart" type="button" data-toggle="collapse"
                                                            data-target="#collapse{{ $q->id }}"
                                                            aria-expanded="true" aria-controls="collapseOne"
                                                            data-id="{{ $q->id }}"
                                                            data-question="{{ $q->question }}">
                                                            {{ $q->question }}
                                                        </a>
                                                    </h2>
                                                </div>

                                                <div id=" collapse{{ $q->id }}" class="collapse"
                                                    aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body px-0 py-2">
                                                        <div>
                                                            <canvas id="myChart{{ $q->id }}"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="row clearfix d-flex justify-content-center mt-4">
                        <div class="col-md-6 col-12">
                            <div class="alert alert-danger">Belum ada statistik</div>
                        </div>
                    </div>
                @endif

                <div class="row clearfix d-flex justify-content-center my-4">
                    <div class="col-md-6 col-12">
                        <a href="{{ route('polling.list') }}" type="submit" class="btn btn-primary">Back</a>
                    </div>
                </div>
            </form>
        </div>

    </section>


    @extends('layouts.includes.frontfooter')
    <!-- Jquery Core Js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">

    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script script src="{{ asset('admin-bsb/plugins/jquery/jquery.min.js') }}">
    </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        $('.btn-chart').click(function() {
            $(this).parent().parent().siblings().toggle('show');
            const idQuestion = $(this).attr('data-id');
            const questionName = $(this).attr('data-question');
            let answers = [];
            let options = [];
            $.ajax({
                type: "GET",
                url: `/option/${idQuestion}/answers`,
                success: function(answer) {
                    answers = answer;
                }
            })
            $.ajax({
                type: "GET",
                url: `/option/${idQuestion}`,
                success: function(res) {
                    $.each(res, function(key, value) {
                        options[key] = value.option;
                    });
                    const labels = options;

                    const data = {
                        labels: labels,
                        datasets: [{
                            label: questionName,
                            backgroundColor: 'rgb(255, 99, 132)',
                            borderColor: 'rgb(255, 99, 132)',
                            data: answers,
                        }]
                    };

                    const config = {
                        type: 'bar',
                        data: data,
                        options: {
                            indexAxis: 'y',
                        }
                    };

                    const myChart = new Chart(
                        document.getElementById(`myChart${idQuestion}`),
                        config
                    );
                },
                error: function() {
                    console.error('there is an error on getoption data');
                }

            });
        })
    </script>

</body>

</html>
