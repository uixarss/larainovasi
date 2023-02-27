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
            <li class="active">
                <i class="material-icons">class</i> Detail Lomba {{$lomba->title}}
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Detail Lomba {{$lomba->title}}</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-blue">
                <div class="icon">
                    <i class="material-icons">class</i>
                </div>
                <div class="content">
                    <div class="text font-bold">File Upload</div>
                    <div class="number">{{$peserta_lomba->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-orange">
                <div class="icon">
                    <i class="material-icons">class</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Jumlah Peserta</div>
                    <div class="number">{{$peserta_lomba->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h3>{{$lomba->title}}</h3>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <a href="{{route('admin.edit.lomba', ['id' => $lomba->id])}}" class="btn bg-blue" target="_blank">
                                <i class="material-icons">edit</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Nama Acara / Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$lomba->title}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Mulai Acara / Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{\Carbon\Carbon::parse($lomba->mulai_acara)->format('d M Y')}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Batas Akhir Acara / Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{\Carbon\Carbon::parse($lomba->selesai_acara)->format('d M Y')}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Target Peserta
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$peserta_lomba->count()}} / {{number_format($lomba->target_peserta)}} Peserta
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Jenis Acara / Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$lomba->jenis->name}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Penyelenggara Acara
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$lomba->penyelenggara}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Lokasi Acara / Lomba
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                {{$lomba->lokasi_acara}}
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Pemenang
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6  align-left">
                                Albert
                            </div>
                        </div><br>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>Daftar Peserta</h3>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>No Peserta</th>
                                    <th>Nama</th>
                                    <th>No. HP</th>
                                    <th>Email</th>
                                    <th>Institusi</th>
                                    <th>Dokumen</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($peserta_lomba as $peserta)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($peserta->created_at)->format('d M Y')}}</td>
                                    <td>
                                        {{$peserta->kode_peserta}}
                                    </td>
                                    <td>
                                        {{$peserta->peserta->user->name ?? ''}}
                                    </td>
                                    <td>
                                        {{$peserta->peserta->no_hp}}
                                    </td>
                                    <td>
                                        {{$peserta->peserta->user->email}}
                                    </td>
                                    <td>
                                        {{$peserta->peserta->nama_institusi}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.download.dokumen.peserta', [ 'id' => $peserta->id])}}" class="btn bg-green">
                                            <i class="material-icons">file_download</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('admin.detail.peserta.lomba', ['id' => $lomba->id, 'peserta_id' => $peserta->id])}}" class="btn bg-yellow">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                        <a href="{{route('admin.delete.peserta.lomba', ['id' => $peserta->id])}}" class="btn btn-danger">
                                            <i class="material-icons">delete</i>
                                        </a>
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