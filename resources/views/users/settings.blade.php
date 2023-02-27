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
                <i class="material-icons">person</i> Password Management
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">person</i> Password Management</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div class="header">
                        <h3>Ubah Password Akun Anda</h3>
                    </div>
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <form action="{{route('users.updateSettings')}}" method="post">
                            @csrf
                                <div class="form-line">
                                    <label for="email">Email Anda</label>
                                    <input type="email" name="email" class="form-control" value="{{$user->email}}" disabled>
                                </div><br>
                                <div class="form-line">
                                    <label for="password">Password Baru</label>
                                    <input type="password" name="password" class="form-control" required>
                                </div><br>
                                <div class="form-line">
                                    <label for="password_confirmation">Ketik Ulang Password Baru</label>
                                    <input type="password" name="password_confirmation" class="form-control" required>
                                </div><br>
                                <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
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

<!-- Validation Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-validation/jquery.validate.js')}}"></script>

<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>

@stop