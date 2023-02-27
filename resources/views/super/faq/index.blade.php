@extends('layouts.admin')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endsection
@section('content')
<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li class="active">
                <i class="material-icons">question_answer</i> FAQ
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">question_answer</i> FAQ</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-light-blue">
                <div class="icon">
                    <i class="material-icons">question_answer</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Total F.A.Q</div>
                    <div class="number">{{$data_faq->count()}}</div>
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
                            <a href="{{route('admin.create.faq')}}" class="btn btn-info waves-effect">
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
                                    <th>Pertanyaan</th>
                                    <th width="200">Jawaban</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_faq as $faq)
                                <tr>
                                    <td>{{$faq->question ?? ''}}</td>
                                    <td>{{$faq->answer ?? ''}}</td>
                                    <td>
                                        <a href="{{route('admin.edit.faq',[ 'id' => $faq->id ])}}" class="btn btn-info"><i class="tiny material-icons">edit</i></a>
                                        <a href="{{route('admin.delete.faq',[ 'id' => $faq->id])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger"><i class="tiny material-icons">delete</i></a>
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
<script src="{{asset('admin-bsb/js/admin.js')}}"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>



<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>
@stop