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
                <i class="material-icons">money</i> Daftar Sumber Dana
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">money</i> Daftar Sumber Dana</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Sumber Dana</h4>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataopd">
                                <i class="material-icons">add</i> <span>Tambah</span>
                            </button>
                        </div> -->
                        <div class="col-xs-12 col-sm-6 align-right">
                            <a href="{{route('admin.sync.sumberdana')}}" class="btn btn-success waves-effect">
                                <i class="material-icons">sync</i> <span>Sync</span>
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
                                    <th>Kode Dana</th>
                                    <th>Nama Dana</th>
                                    <th>Urut Dana</th>
                                    <th>Tipe</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_sumberdana as $key => $sumberdana)
                                <tr>
                                    <td>{{$sumberdana->kd_dana}}</td>
                                    <td>{{$sumberdana->nama_dana}}</td>
                                    <td>{{$sumberdana->urut_dana}}</td>
                                    <td>{{$sumberdana->tipe}}</td>

                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDatasumberdana{{$sumberdana->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.sumberdana', [ 'id' => $sumberdana->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editDatasumberdana{{$sumberdana->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Detail data Sumber Dana</h4>
                                            </div>
                                            <form action="{{route('admin.update.sumberdana',['id' => $sumberdana->id])}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row clearfix">

                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="nama_dnaa" class="form-control" value="{{$sumberdana->nama_dana}}" disabled>
                                                                    <label class="form-label">Name</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="kd_dana" class="form-control" value="{{$sumberdana->kd_dana}}" disabled>
                                                                    <label class="form-label">Kode Dana</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="urut_dana" class="form-control" value="{{$sumberdana->urut_dana}}" disabled>
                                                                    <label class="form-label">Urut Dana</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="tipe" class="form-control" value="{{$sumberdana->tipe}}" disabled>
                                                                    <label class="form-label">Tipe</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <label for="">Dibuat oleh</label>
                                                                    <label for=""><b>System</b></label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <label for="">Diubah oleh</label>
                                                                    <label for=""><b>System</b></label>
                                                                </div>


                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <!-- <button type="submit" class="btn btn-primary waves-effect">Simpan</button> -->
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
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