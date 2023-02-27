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
                <i class="material-icons">class</i> Jenis Lomba
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Jenis Lomba</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Jenis Lomba</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahJenisLomba">
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
                                    <th>Jenis Lomba</th>

                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_jenis_lomba as $key => $jenislomba)
                                <tr>
                                    <td>{{$jenislomba->name}}</td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editJenisLomba{{$jenislomba->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.jenislomba', [ 'id' => $jenislomba->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editJenisLomba{{$jenislomba->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Jenis Lomba</h4>
                                            </div>
                                            <form action="{{route('admin.update.jenislomba',['id' => $jenislomba->id])}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row clearfix">

                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="name" class="form-control" value="{{$jenislomba->name}}">
                                                                    <label class="form-label">Nama Domain</label>
                                                                </div>

                                                                <br>


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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahJenisLomba" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Jenis Lomba</h4>
                            </div>
                            <form action="{{route('admin.store.jenislomba')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="demo-masked-input">
                                        <div class="row clearfix">

                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="name" class="form-control" required>
                                                        <label class="form-label">Nama </label>
                                                    </div>

                                                    <br>


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