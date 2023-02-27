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
                <i class="material-icons">person</i> Personal Account Management
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">person</i> Personal Account Management</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div class="header">
                        <h3>Ubah Data Akun Anda</h3>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                        @role('super admin')
                        <form action="{{route('users.updateSuperProfile')}}" method="post">
                            @csrf
                                <div class="form-line">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="username">Username Anda</label>
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="nickname">Nama Panggilan</label>
                                    <input type="text" name="nickname" class="form-control" value="{{$user->nick_name}}">
                                </div><br>
                                <div class="form-line">
                                    <label for="opdname">Nama OPD</label>
                                    <input type="text" name="opdname" class="form-control" value="{{$user->opd_name}}">
                                </div><br>
                                <div class="form-line">
                                    <label for="email">Email Anda</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                                </div><br>
                                <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                            </form>
                        @elserole('admin opd')
                            <form action="{{route('users.updateOPDProfile')}}" method="post">
                            @csrf
                                <div class="form-line">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="username">Username Anda</label>
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="nickname">Nama Panggilan</label>
                                    <input type="text" name="nickname" class="form-control" value="{{$user->nick_name}}">
                                </div><br>
                                <div class="form-line">
                                    <label for="opdname">Nama OPD</label>
                                    <input type="text" name="opdname" class="form-control" value="{{$user->opd_name}}">
                                </div><br>
                                <div class="form-line">
                                    <label for="email">Email Anda</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                                </div><br>
                                <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                            </form>
                        @else
                            <form action="{{route('users.updateProfile')}}" method="post">
                            @csrf
                                <div class="form-line">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" name="name" class="form-control" value="{{$user->name}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="username">Username Anda</label>
                                    <input type="text" name="username" class="form-control" value="{{$user->username}}" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="nickname">Nama Panggilan</label>
                                    <input type="text" name="nickname" class="form-control" value="{{$user->nick_name}}">
                                </div><br>
                                <div class="form-line">
                                    <label for="email">Email Anda</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                                </div><br>
                                <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                            </form>
                        @endrole
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

@stop