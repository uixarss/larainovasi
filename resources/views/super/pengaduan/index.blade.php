@extends('layouts.admin')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li class="active">
                <i class="material-icons">feedback</i> Data Pengaduan
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">feedback</i> Data Pengaduan</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-light-blue">
                <div class="icon">
                    <i class="material-icons">feedback</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Total Pengaduan</div>
                    <div class="number">{{$data_pengaduan->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-orange">
                <div class="icon">
                    <i class="material-icons">pause</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Pengaduan Pending</div>
                    <div class="number">{{$data_pengaduan->where('status', 'pending')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">warning</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Pengaduan Selesai</div>
                    <div class="number">{{$data_pengaduan->where('status', 'selesai')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-red">
                <div class="icon">
                    <i class="material-icons">loop</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Pengaduan Dalam Proses</div>
                    <div class="number">{{$data_pengaduan->where('status', 'proses')->count()}}</div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-green">
                <div class="icon">
                    <i class="material-icons">turned_in</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Pengaduan Hari Ini</div>
                    <div class="number">{{$data_pengaduan->where('created_at','>=', \Carbon\Carbon::today())->count()}}</div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Pengaduan</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataapi">
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
                                    <th>Tanggal Pengaduan</th>
                                    <th>Pesan</th>
                                    <th>Isi</th>
                                    <th>Jumlah Respon</th>
                                    <th>Status</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_pengaduan as $key => $pengaduan)
                                <tr>
                                    <td>{{\Carbon\Carbon::parse($pengaduan->created_at)->format('d/m/Y h:m:s')}}</td>
                                    <td>{{$pengaduan->title}}</td>
                                    <td>{{$pengaduan->body}}</td>
                                    <td>
                                        {{$pengaduan->respons->count()}}
                                    </td>
                                    <td>{{$pengaduan->status }}</td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDataPengaduan{{$pengaduan->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.show.pengaduan', [ 'id' => $pengaduan->id ])}}" class="btn btn-info btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">remove_red_eye</i>
                                        </a>
                                        <a href="{{route('admin.destroy.pengaduan', [ 'id' => $pengaduan->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editDataPengaduan{{$pengaduan->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Detail data pengaduan</h4>
                                            </div>

                                            <div class="modal-body">

                                                <div class="row clearfix">
                                                    <form action="{{route('admin.update.pengaduan',['id' => $pengaduan->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="name" class="form-control" value="{{$pengaduan->name}}" disabled>
                                                                    <label class="form-label">Nama </label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="email" class="form-control" value="{{$pengaduan->email}}" disabled>
                                                                    <label class="form-label">Email Address</label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="no_hp" class="form-control" value="{{$pengaduan->no_hp}}" disabled>
                                                                    <label class="form-label">No Handphone</label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="title" class="form-control" value="{{$pengaduan->title}}" disabled>
                                                                    <label class="form-label">Judul Pengaduan</label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="body" class="form-control" value="{{$pengaduan->body}}" disabled>
                                                                    <label class="form-label">Isi Pengaduan</label>
                                                                </div>
                                                                <br>
                                                                <div class="form-line">
                                                                    <br>
                                                                    <select name="status" id="status" class="form-control show-tick" data-size="3" data-live-search="true">
                                                                        <option value="selesai" {{($pengaduan->status == 'selesai') ? 'selected' : ''}}>Selesai</option>
                                                                        <option value="pending" {{($pengaduan->status == 'pending' || $pengaduan->status == null ) ? 'selected' : ''}}>Pending</option>
                                                                        <option value="proses" {{($pengaduan->status == 'proses') ? 'selected' : ''}}>Proses</option>
                                                                    </select>
                                                                    <br>
                                                                    <label class="form-label">Status</label>
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

                <div class="modal fade" id="tambahDataapi" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data Pengaduan</h4>
                            </div>
                            <form action="{{route('admin.new.pengaduan')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="name" class="form-control" placeholder="....">
                                                    <label class="form-label">Nama </label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="email" class="form-control" placeholder="....">
                                                    <label class="form-label">Email Address</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="no_hp" class="form-control" placeholder="....">
                                                    <label class="form-label">No Handphone</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="title" class="form-control" placeholder="....">
                                                    <label class="form-label">Judul Pengaduan</label>
                                                </div>
                                                <br>
                                                <div class="form-line">
                                                    <input type="text" name="body" class="form-control" placeholder="....">
                                                    <label class="form-label">Isi Pengaduan</label>
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