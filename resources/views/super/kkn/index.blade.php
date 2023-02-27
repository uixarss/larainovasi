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
        <h3><i class="material-icons">people</i> KKN</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-blue">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Draft</div>
                    <div class="number">{{$data_kkn->where('status','draft')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-orange">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Review</div>
                    <div class="number">{{$data_kkn->where('status','review')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Publish</div>
                    <div class="number">{{$data_kkn->where('status','publish')->count()}}</div>
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
                            <a href="{{route('admin.create.kkn')}}" class="btn btn-info waves-effect">
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
                                    <th>Tanggal Dibuat</th>
                                    <th width="200">Judul KKN</th>
                                    <th>Deskripsi</th>
                                    <th>Institusi</th>
                                    <th>Penulis</th>
                                    <th>Status</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_kkn as $kkn)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($kkn->created_at)->format('d-m-Y')}}</td>
                                    <td>{{$kkn->title ?? ''}}</td>
                                    <td>{{$kkn->description ?? ''}}</td>
                                    <td>{{$kkn->institution ?? ''}}</td>
                                    <td>{{$kkn->author ?? ''}}</td>
                                    <td>{{$kkn->status ?? ''}}</td>
                                    <td>
                                        <a href="{{route('admin.download.kkn',[ 'id' => $kkn->id ])}}" class="btn btn-info"><i class="tiny material-icons">file_download</i></a>
                                        <a href="{{route('admin.edit.kkn',[ 'id' => $kkn->id ])}}" class="btn btn-info"><i class="tiny material-icons">edit</i></a>
                                        <a href="{{route('admin.delete.kkn',[ 'id' => $kkn->id])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger"><i class="tiny material-icons">delete</i></a>
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