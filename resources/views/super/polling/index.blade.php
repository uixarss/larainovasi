@extends('layouts.admin')
@section('css-add')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <style>
        .dropdown-menu.action {
            position: absolute;
            left: -136px;
            top: 50px;
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

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3><i class="material-icons">insert_chart_outlined</i> Polling</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix">

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Polling</div>
                        <div class="number">{{ $polling->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Expired</div>
                        <div class="number">{{ $expire }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Open</div>
                        <div class="number">{{ $polling->count() - $expire }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">

                                <a href="{{ route('admin.polling.create') }}" class="btn btn-info waves-effect">
                                    <i class="material-icons">add</i> <span>Tambah</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="body">
                        @include('layouts.alert')
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Author</th>
                                        <th>Responses</th>
                                        <th>Expire Date</th>
                                        {{-- <th>Created at</th> --}}
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($polling as $p)
                                        <tr>
                                            <td>{{ $p->name }}</td>
                                            <td>{{ auth()->user()->name }}</td>
                                            <td>{{ $p->reponses()->distinct()->get(['ip'])->count() }}</td>
                                            <td>{{ $p->expire_date }}</td>
                                            <td>{{ $p->status }}</td>
                                            <td>
                                                <!-- Example single danger button -->
                                                <div class="btn-group" style="box-shadow: none;">
                                                    <span class="material-icons dropdown-toggle" data-toggle="dropdown"
                                                        style="cursor: pointer;" aria-haspopup="true" aria-expanded="false">
                                                        more_vert
                                                    </span>
                                                    </button>
                                                    <div class="dropdown-menu action">
                                                        <a class="btn btn-link btn-block text-left dropdown-item"
                                                            href="{{ route('admin.polling.statistics', $p->slug) }}"
                                                            style="text-align: left;">
                                                            <span class="iconify"
                                                                data-icon="mdi-light:chart-histogram"></span> Statistics
                                                        </a>
                                                        <a class="btn btn-link btn-block dropdown-item"
                                                            href="{{ route('admin.polling.statistics', $p->slug) }}"
                                                            style="text-align: left;"><span class="iconify"
                                                                data-icon="mdi-light:note-text"></span> Responses</a>
                                                        <a class="btn btn-link btn-block dropdown-item"
                                                            href="{{ route('admin.polling.edit', $p->slug) }}"
                                                            style="text-align: left;">
                                                            <span class="iconify"
                                                                data-icon="mdi-light:pencil"></span> Edit Survey
                                                        </a>
                                                        <a class="btn btn-link btn-block dropdown-item"
                                                            href="{{ route('admin.polling.delete', $p->slug) }}"
                                                            style="text-align: left;"><span class="iconify"
                                                                data-icon="mdi-light:delete"></span> Delete Survey</a>
                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('admin.polling.edit', $p->slug) }}"
                                                    class="btn btn-info"><i class="tiny material-icons">edit</i></a>
                                                <a href="{{ route('admin.polling.delete', $p->slug) }}"
                                                    class="btn btn-danger">
                                                    <i class="tiny material-icons">delete</i></a> --}}
                                            </td>
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
@endsection
@section('js')
    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
@stop
