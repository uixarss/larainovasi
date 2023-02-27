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
                <i class="material-icons">people</i> Indeks Inovasi Daerah
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> Indeks Inovasi Daerah</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Inisiatif</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Inisiatif')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">person</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Uji Coba</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Uji Coba')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Penerapan</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Penerapan')->count()}}</div>
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

                            <a href="{{route('opd.create.inovasi')}}" class="btn btn-info waves-effect">
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

                                    <th style="width: 100px;">Nama Inovasi</th>
                                    <th style="width: 150px;">Program</th>
                                    <th style="width: 150px;">Kegiatan</th>
                                    <th style="width: 150px;">Sub Kegiatan</th>
                                    <th style="width: 50px;">Tahapan Inovasi</th>
                                    <th style="width: 75px;">Waktu Uji Coba</th>
                                    <th style="width: 75px;">Waktu Implementasi</th>
                                    <th style="width: 30px;">Kematangan</th>
                                    <th style="width: 80px;">PIID</th>
                                    <th style="width: auto;">Ubah Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_inovasi as $inovasi)
                                <tr>
                                    <td>{{$inovasi->nama_inovasi ?? ''}}</td>
                                    <td>{{$inovasi->nama_prg ?? ''}}</td>
                                    <td>{{$inovasi->nama_keg ?? ''}}</td>
                                    <td>{{$inovasi->nama_sub_keg ?? ''}}</td>
                                    <td>{{$inovasi->tahapan_inovasi ?? ''}}</td>
                                    <td>{{$inovasi->waktu_uji_coba->format('m/d/Y') ?? ''}}</td>
                                    <td>{{$inovasi->waktu_implementasi->format('m/d/Y') ?? ''}}</td>
                                    <td>{{number_format($inovasi->indikator()->sum('bobot')) ?? ''}}</td>
                                    <td>Rp {{ number_format($inovasi->reward()->sum('nominal'),2) ?? '-'}}</td>
                                    <td>
                                        <a href="{{route('opd.edit.indikator.inovasi', ['id' => $inovasi->id])}}" class="btn btn-primary"><i class="material-icons">explore</i></a>
                                        <a href="{{route('opd.edit.inovasi',['id' => $inovasi->id])}}" class="btn btn-info"><i class="material-icons">edit</i></a>
                                        <a href="{{route('opd.delete.inovasi', ['id' => $inovasi->id])}}" class="btn btn-danger" onclick="return confirm('Apakah yakin akan dihapus?')"><i class="material-icons">delete</i></a>
                                        
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