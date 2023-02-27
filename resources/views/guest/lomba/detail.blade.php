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
                <a href="{{route('guest.list.lomba')}}"><i class="material-icons">class</i> Lomba</a>
            </li>
            <li>
                <a href="{{route('guest.riwayat.lomba')}}"><i class="material-icons">class</i> Detail Lomba</a>
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
                            <h3>Kode Peserta : <span class="badge bg-orange">{{$pesertalomba->kode_peserta}}</span></h3>
                        </div>
                        
                    </div>
                </div>
                <div class="body">
                    <form action="{{route('guest.update.data.lomba',['id' => $pesertalomba->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                <input type="text" name="name" class="form-control" value="{{$peserta->user->name}}" required>
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
                                <input type="email" name="email" class="form-control" value="{{$peserta->user->email}}" required>
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
                                <input type="text" name="no_hp" class="form-control" value="{{$peserta->no_hp}}" required>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-4 col-xs-4">
                                Tempat, Tanggal Lahir Peserta
                            </div>
                            <div class="col-md-1 col-xs-1 col-sm-1">
                                :
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3  align-left">
                                <input type="text" name="tempat_lahir" class="form-control" value="{{$peserta->tempat_lahir}}" required>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3  align-left">
                                <input type="date" name="tanggal_lahir" class="form-control" value="{{\Carbon\Carbon::parse($peserta->tanggal_lahir)->format('Y-m-d')}}" required>
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
                                <input type="text" class="form-control" name="alamat" value="{{$peserta->alamat}}" required>
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
                                <input type="text" name="nama_institusi" class="form-control" value="{{$peserta->nama_institusi}}" required> 
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
                                <input type="text" name="alamat_institusi" class="form-control" value="{{$peserta->alamat_institusi}}" required>
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
                                <input type="text" name="judul_dokumen_lomba" class="form-control" value="{{$pesertalomba->judul_dokumen_lomba}}" required>
                                <input type="file" name="file_dokumen_lomba" class="form-control">
                                <br>
                                <a href="{{route('guest.download.dokumen.peserta',['id' => $pesertalomba->id])}}" class="btn">Download</a>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-3 pull-right">
                                <button type="submit" class="btn bg-light-blue btn-lg btn-block">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                    </form>
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