@extends('layouts.admin')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li class="active">
                <i class="material-icons">insert_drive_file</i> Daftar Indikator
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">insert_drive_file</i> Daftar Indikator</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Indikator</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataIndikator">
                                <i class="material-icons">add</i> <span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="body">
                    @include('layouts.alert')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>No </th>
                                    <th>Name</th>
                                    <th>Keterangan</th>
                                    <th>Data Pendukung</th>
                                    <th>Jenis File</th>
                                    <th width="50">Uraian - Nilai </th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($indikators as $key => $indikator)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$indikator->nama}}</td>
                                    <td>{{$indikator->keterangan}}</td>
                                    <td>{{$indikator->data_pendukung}}</td>
                                    <td>{{$indikator->jenis_file}}</td>
                                    <td>
                                        @foreach($indikator->nilai as $nilai)
                                        <span class="badge bg-light-green">{{$nilai->uraian}} <span class="badge bg-light-blue">{{$nilai->nilai}} </span></span>
                                         <br> <br>
                                        @endforeach
                                    </td>
                                    <td>

                                        <a href="{{route('admin.edit.indikator', ['id' => $indikator->id ])}}" class="btn btn-warning btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{route('admin.delete.indikator', [ 'id' => $indikator->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahDataIndikator" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data Indikator</h4>
                            </div>
                            <form action="{{route('admin.store.indikator')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="nama" class="form-control">
                                                    <label class="form-label">Nama</label>
                                                </div>

                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="keterangan" class="form-control">
                                                    <label class="form-label">Keterangan</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="jenis_file" class="form-control" placeholder="Contoh : Dokumen / Foto Gambar / Video">
                                                    <label class="form-label">Jenis File</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="data_pendukung" class="form-control" placeholder="Contoh : Dokumen SK / Peraturan">
                                                    <label class="form-label">Data Pendukung</label>
                                                </div>
                                                


                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                </div>

                            </form>
                        </div>
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