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
                <i class="material-icons">class</i> Lomba
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Lomba</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-blue">
                <div class="icon">
                    <i class="material-icons">class</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Active</div>
                    @isset($peserta->lomba)
                    <div class="number">{{$peserta->lomba->where('status', 'active')->count() ?? ''}}</div>
                    @else
                    <div class="number">0</div>
                    @endisset
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-orange">
                <div class="icon">
                    <i class="material-icons">class</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Closed</div>
                    @isset($peserta->lomba)
                    <div class="number">{{$peserta->lomba->where('status', 'closed')->count() ?? ''}}</div>
                        @else
                        <div class="number">0</div>
                    @endisset
                    
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">class</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Finished</div>
                    @isset($peserta->lomba)
                    <div class="number">{{$peserta->lomba->where('status', 'finished')->count() ?? ''}}</div>
                        @else
                        <div class="number">0</div>
                    @endisset
                    
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                        Informasi Lomba
                        </div>
                    </div>
                </div>

                <div class="body">
                    @include('layouts.alert')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>Tanggal Lomba</th>
                                    <th width="200">Judul Lomba</th>
                                    <th>Kode Peserta</th>
                                    <th>Jenis Lomba</th>
                                    <th>Dokumen Anda</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($peserta->lomba)
                                @foreach($peserta->lomba as $lomba)
                                <tr>
                                    <td>{{Carbon\Carbon::parse($lomba->mulai_acara)->format('d M Y')}} - {{Carbon\Carbon::parse($lomba->selesai_acara)->format('d M Y')}}</td>
                                    <td>{{$lomba->title ?? ''}}</td>
                                    <td>
                                        {{$lomba->pivot->kode_peserta}}
                                    </td>
                                    <td>{{$lomba->jenis->name ?? '' }}</td>
                                    <td>
                                        {{$lomba->pivot->nama_dokumen_lomba}}
                                    </td>
                                    <td>
                                        <a href="{{route('guest.detail.lomba',['id' => $lomba->pivot->id])}}" target="_blank" class="btn bg-yellow">
                                        <i class="material-icons">edit</i>
                                        </a>                                        
                                        
                                    </td>
                                </tr>
                                @endforeach
                                @endisset
                                
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