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
                <i class="material-icons">people</i> Daftar OPD
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> Daftar OPD</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>OPD</h4>
                        </div>
                        <!-- <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataopd">
                                <i class="material-icons">add</i> <span>Tambah</span>
                            </button>
                        </div> -->
                        <div class="col-xs-12 col-sm-6 align-right">
                            <a href="{{route('admin.sync.opd')}}" class="btn btn-success waves-effect">
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
                                    <th>Name</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($opdes as $key => $opd)
                                <tr>
                                    <td>{{$opd->name}}</td>

                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDataopd{{$opd->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.opd', [ 'id' => $opd->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editDataopd{{$opd->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Detail data OPD</h4>
                                            </div>
                                            <form action="{{route('admin.update.opd',['id' => $opd->id])}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row clearfix">

                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="name" class="form-control" value="{{$opd->name}}" disabled>
                                                                    <label class="form-label">Name</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="kd_unit" class="form-control" value="{{$opd->kd_unit}}" disabled>
                                                                    <label class="form-label">Kode Unit</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="urut_unit" class="form-control" value="{{$opd->urut_unit}}" disabled>
                                                                    <label class="form-label">Urut Unit</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="kd_bid_urusan" class="form-control" value="{{$opd->kd_bid_urusan}}" disabled>
                                                                    <label class="form-label">Kode Bidang Urusan</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="nama_bid_urusan" class="form-control" value="{{$opd->nama_bid_urusan}}" disabled>
                                                                    <label class="form-label">Nama Bidang Urusan</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="urut_bid_urusan" class="form-control" value="{{$opd->urut_bid_urusan}}" disabled>
                                                                    <label class="form-label">Urut Bidang Urusan</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <label for="">Dibuat oleh</label>
                                                                    <label for=""><b>{{$opd->created_by ?? ''}}</b></label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <label for="">Diubah oleh</label>
                                                                    <label for=""><b>{{$opd->updated_by ?? ''}}</b></label>
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

                <div class="modal fade" id="tambahDataopd" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data OPD</h4>
                            </div>
                            <form action="{{route('admin.create.opd')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="name" class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>

                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="created_by" class="form-control" value="{{Auth::user()->name }}" disabled>
                                                    <label class="form-label">Dibuat oleh</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="updated_by" class="form-control" value="{{Auth::user()->name }}" disabled>
                                                    <label class="form-label">Diubah oleh</label>
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