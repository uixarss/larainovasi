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
            <li>
                <a href="{{route('admin.list.lomba')}}"><i class="material-icons">class</i> Lomba</a>
            </li>
            <li>
                <a href="{{route('admin.show.lomba', ['id' => $lomba->id])}}"><i class="material-icons">class</i> Detail Lomba {{$lomba->title}}</a>
            </li>
            <li class="active">
                <i class="material-icons">class</i> Peserta {{$peserta->user->name}}
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Detail Peserta {{$peserta->user->name}}</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h3>Kode Peserta : {{$peserta_lomba->kode_peserta}}</h3>
                        </div>
                        
                    </div>
                </div>
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Nama Peserta
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->user->name}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Email Peserta
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->user->email}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                No. HP
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->no_hp}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Tempat, Tanggal Lahir Peserta
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->tempat_lahir}}, {{\Carbon\Carbon::parse($peserta->tanggal_lahir)->format('d M Y')}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Alamat
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->alamat}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Nama Institusi
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->nama_institusi}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Alamat Institusi
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta->alamat_institusi}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Judul Dokumen Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                <span class="badge bg-orange">{{$peserta_lomba->judul_dokumen_lomba}}</span> <br> <br>
                                <span class="badge bg-green">{{$peserta_lomba->nama_dokumen_lomba}}</span> <br>
                                <br>
                                <a href="{{route('admin.download.dokumen.peserta',['id' => $peserta_lomba->id])}}" class="btn">Download</a>
                            </div>
                        </div><br>
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