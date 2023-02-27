@extends('layouts.admin')
@section('css-add')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <style>
        #statistics,
        #responses {
            display: none;
        }

        #statistics.active,
        #responses.active {
            display: block;
        }

        .menu span {
            display: inline-block;
            font-weight: 600;
            color: #999999;
        }

        .menu span:hover,
        .menu span.active {
            color: #3B78E7;
            text-decoration: underline;
            cursor: pointer;
        }

        .heading,
        .body-statistic {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 25px;
        }

        .btn-chart .arrow {
            transition: all ease 0.3s;
        }

        .btn-chart.bawah .arrow {
            transition: all ease 0.3s;
            transform: rotate(90deg);
        }

        .data-statistic.active {
            display: block;
        }

        .body-responses {
            padding: 25px;
        }

        .data-statistic {
            padding: 15px 25px;
            display: none;
        }

        .body-statistic {
            padding: 15px 25px;
            border-bottom: 1px solid #e9e9e9;
            border-top: 1px solid #e9e9e9;
        }

        .body-statistic p {
            margin-bottom: 4px;
            font-weight: bold;
        }

        .body-statistic p.text-grey {
            font-size: 12px;
            color: #999999;
            font-weight: 500;
        }

        .text-heading {
            font-size: 16px;
            font-weight: bold;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="bg-white">
            <div class="breadcrumb">
                <li>
                    <a href="{{ route('home') }} "><i class="material-icons">home</i> Dashboard</a>
                </li>
                <li>
                    <a href="/admin/polling "><i class="material-icons">insert_chart_outlined</i> Polling</a>
                </li>
                <li>
                    <a href="#"><i class="material-icons">insert_chart_outlined</i> Statistics</a>
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3><i class="material-icons">insert_chart_outlined</i> Statistics</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix menu">
            <div class="col-md-12" style="margin: 15px 0px 30px 0px; padding-left: 25px;">
                <span id="menu-statistics" class="active">Statistics</span>
                <span id="menu-responses" style="margin-left: 10px">Responses</span>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card active" id="statistics">
                    <div class="card-body">
                        <div class="heading">
                            <span class="text-heading">{{ $polling->name }}</span>
                            <div>
                                <a href="{{ route('admin.polling.create') }}" class="btn btn-primary">Create Polling</a>
                                <a href="{{ route('admin.polling.edit', $polling->slug) }}" class="btn btn-warning">Edit
                                    Polling</a>
                                <a href="{{ route('admin.polling.reponse.export', $polling->slug) }}"
                                    class="btn btn-success">Export CSV</a>
                            </div>
                        </div>
                        @foreach ($polling->questions as $q)
                            <div class="statistic-wrapper">
                                <div class="body-statistic">
                                    <div>
                                        <p class="text-grey">Responses
                                            {{ $polling->reponses()->distinct()->get(['ip'])->count() }} people</p>
                                        <p style="margin-bottom: 0px; color: #000000;">{{ $q->question }}</p>
                                    </div>
                                    <div>
                                        <button class="btn btn-primary btn-chart" data-id="{{ $q->id }}"
                                            data-question="{{ $q->question }}">chart
                                            <span class="material-icons arrow"
                                                style="font-size: 15px; vertical-align: -5px">
                                                chevron_right
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                <div class="data-statistic">
                                    <div>
                                        <canvas id="myChart{{ $q->id }}"></canvas>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card" id="responses">
                    <div class="card-body">
                        <div class="heading">
                            <span class="text-heading">{{ $polling->name }}</span>
                            <div>
                                <a href="{{ route('admin.polling.create') }}" class="btn btn-primary">Create Polling</a>
                                <a href="{{ route('admin.polling.edit', $polling->slug) }}" class="btn btn-warning">Edit
                                    Polling</a>
                                <a href="{{ route('admin.polling.reponse.export', $polling->slug) }}"
                                    class="btn btn-success">Export CSV</a>
                            </div>
                        </div>
                        <div class="body-responses">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example">
                                    <thead>
                                        <tr>
                                            <th>Timestamp</th>
                                            <th>ip</th>
                                            @foreach ($polling->questions as $index => $q)
                                                <th>{{ $q->question }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($polling->reponses()->distinct()->get(['ip', 'created_at'])
        as $response)
                                            <tr>
                                                <td>{{ $response->created_at }}</td>
                                                <td>{{ $response->ip }}</td>
                                                @foreach ($polling->questions as $i => $q)
                                                    @foreach ($optionNames as $opt)
                                                        @if ($q->id === $opt->question->id)
                                                            <?php $options[] = $opt->option;
                                                            $option = implode(', ', $options);
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                    <td>{{ $option }}</td>
                                                    <?php $options = []; ?>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
@section('js')
    <script>
        $('.btn-chart').click(function() {
            if ($(this).hasClass('bawah')) {
                $(this).removeClass('bawah');
            } else {
                $(this).addClass('bawah');
            }

            $(this).parent().parent().siblings().toggle('active');
            const idQuestion = $(this).attr('data-id');
            const questionName = $(this).attr('data-question');
            let answers = [];
            let options = [];
            $.ajax({
                type: "GET",
                url: `/admin/option/${idQuestion}/answers`,
                success: function(answer) {
                    answers = answer;
                }
            })
            $.ajax({
                type: "GET",
                url: `/admin/option/${idQuestion}`,
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
        $('#menu-statistics').click(function() {
            $(this).addClass('active');
            $('#menu-responses').removeClass('active');
            $('#statistics').addClass('active');
            $('#responses').removeClass('active');
        })
        $('#menu-responses').click(function() {
            $(this).addClass('active');
            $('#menu-statistics').removeClass('active');
            $('#statistics').removeClass('active');
            $('#responses').addClass('active');
        })
    </script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@stop
