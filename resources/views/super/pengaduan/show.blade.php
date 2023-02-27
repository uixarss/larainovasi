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
                <a href="{{route('admin.list.pengaduan')}}"><i class="material-icons">feedback</i> Pengaduan</a>
            </li>
            <li class="active">
                <i class="material-icons">feedback</i> Respon Pengaduan
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">feedback</i> Respon Pengaduan</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <div class="card card-about-me">
                <div class="header">
                    <h2>TENTANG PENGADUAN</h2>
                </div>
                <div class="body">
                    <ul>
                        <li>
                            <div class="title">
                                <i class="material-icons">library_books</i>
                                Nama Lengkap
                            </div>
                            <div class="content">
                                {{$pengaduan->name}}
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">email</i>
                                Email
                            </div>
                            <div class="content">
                                <a href="mailto:{{$pengaduan->email}}">{{$pengaduan->email}}</a>
                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">contacts</i>
                                Kontak
                            </div>
                            <div class="content">
                                <a href="tel:{{$pengaduan->no_hp}}"><span class="label bg-blue">{{$pengaduan->no_hp}}</span></a>

                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">feedback</i>
                                Pesan
                            </div>
                            <div class="content">
                                <div class="title">{{$pengaduan->title}}</div>
                                <div class="body">{{$pengaduan->body}}</div>

                            </div>
                        </li>
                        <li>
                            <div class="title">
                                <i class="material-icons">info</i>
                                Status
                            </div>
                            <div class="content">
                            <span class="label bg-red">{{$pengaduan->status ?? 'pending'}}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <h3>{{$pengaduan->title}}</h3>
                        <p>{{$pengaduan->body}}</p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Respon</th>
                                    <th>Status</th>
                                    <th>Dijawab Oleh</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengaduan->respons as $key => $respon)
                                <tr>
                                    <td>{{$respon->respon}}</td>
                                    <td>{{$respon->status}}</td>
                                    <td>
                                        {{$respon->user->name}}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.delete.respon', [ 'id' => $respon->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <form action="{{route('admin.store.pengaduan',['id' => $pengaduan->id])}}" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="form-line">
                                <label for="answer">Respon</label>
                                <input type="text" name="respon" class="form-control" placeholder="Respon Anda..." required>
                            </div><br>
                            <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                        </form>
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