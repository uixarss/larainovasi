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
                <a href="{{route('admin.list.indikator')}}"><i class="material-icons">insert_drive_file</i> Daftar Indikator</a>
            </li>
            <li class="active">
                <i class="material-icons">insert_drive_file</i> {{$indikator->nama}}
            </li>
        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">insert_drive_file</i> Daftar Indikator</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <form action="{{route('admin.update.indikator',['id' => $indikator->id])}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row clearfix" id="form-edit">

                {{-- Data Indikator --}}
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama Indikator</b>
                            <input type="text" name="nama" class="form-control" value="{{$indikator->nama}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Keterangan Indikator</b>
                            <input type="text" name="keterangan" class="form-control" value="{{$indikator->keterangan}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Jenis File</b>
                            <input type="text" name="jenis_file" class="form-control" value="{{$indikator->jenis_file}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Data Pendukung</b>
                            <input type="text" name="data_pendukung" class="form-control" value="{{$indikator->data_pendukung}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <button type="submit" id="submit" class="btn btn-primary waves-effect">Simpan</button>
                </div>

            </div>
        </form>
        <br>
        @include('layouts.alert')
    </div>

    <hr>

    <div class="page-title">
        <h3><i class="material-icons">insert_drive_file</i> Nilai Indikator</h3>
    </div>

    <div class="row clearfix">
        <form action="{{route('admin.store.nilai.indikator',['id' => $indikator->id])}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row clearfix" id="form-edit">

                {{-- Data Nilai --}}
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Uraian Indikator</b>
                            <input type="text" name="uraian" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nilai Indikator</b>
                            <input type="number" name="nilai" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <button type="submit" id="submit" class="btn btn-primary waves-effect">Tambah</button>
                </div>
            </div>
        </form>

    </div>

    <hr>

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Nilai Indikator</h4>
                        </div>
                    </div>
                </div>
                <div class="body">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>Uraian</th>
                                    <th>Nilai</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($indikator->nilai as $nilai)
                                <tr>
                                    <td>{{$nilai->uraian}}</td>
                                    <td>{{$nilai->nilai}}</td>
                                    <td>
                                        <a href="#editNilai" class="btn btn-info" data-toggle="modal" data-target="#editDataIndikator{{$nilai->id}}">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{route('admin.delete.nilai.indikator', ['id' => $nilai->id])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger">
                                            <i class="material-icons">delete</i>
                                        </a>

                                        <div class="modal fade" id="editDataIndikator{{$nilai->id}}" tabindex="-1" role="dialog" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header header">
                                                        <h4 class="modal-title">Tambah Data Indikator</h4>
                                                    </div>
                                                    <form action="{{route('admin.update.nilai.indikator',['id' => $nilai->id])}}" method="post">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <div class="row clearfix">

                                                                <div class="col-sm-12">
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <b class="lead">Uraian Indikator</b>
                                                                                <input type="text" name="uraian" class="form-control" value="{{$nilai->uraian ?? '' }}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-sm-12">
                                                                        <div class="form-group form-float">
                                                                            <div class="form-line">
                                                                                <b class="lead">Nilai Indikator</b>
                                                                                <input type="number" name="nilai" class="form-control" value="{{$nilai->nilai ?? '' }}" required>
                                                                            </div>
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






</div>




</div>
</div>
@endsection

@section('js')
<!-- Ckeditor -->
<script src="{{asset('admin-bsb/plugins/ckeditor/ckeditor.js')}}"></script>

<script src="{{asset('admin-bsb/js/admin.js')}}"></script>

@stop