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
                <i class="material-icons">people</i> Account Management
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> Account Management</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        @foreach($roles as $role)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">person</i>
                </div>
                <div class="content">
                    <div class="text font-bold">{{ucwords($role->name)}}</div>
                    <div class="number">{{$role->users_count}}</div>
                </div>
            </div>
        </div>
        @endforeach

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-12 col-md-12 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataUser">
                                <i class="material-icons">add</i> <span>New Account</span>
                            </button>
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#importDataUser">
                                <i class="material-icons">file_upload</i> <span>Import Account</span>
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

                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>

                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        @switch($role->name)
                                        @case('admin')
                                        <span class="badge bg-teal">{{$role->name}}</span>
                                        @break

                                        @case('super admin')
                                        <span class="badge bg-cyan">{{$role->name}}</span>
                                        @break

                                        @case('masyarakat')
                                        <span class="badge bg-blue">{{$role->name}}</span>
                                        @break

                                        @default
                                        <span class="badge bg-purple">{{$role->name}}</span>
                                        @endswitch
                                        @endforeach
                                    </td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDataUser{{$user->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.account', [ 'id' => $user->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="editDataUser{{$user->id}}" tabindex="-1" role="dialog" style="display: none;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header header">
                                                    <h4 class="modal-title">Edit Data</h4>
                                                </div>
                                                <form action="{{route('admin.update.account',['id' => $user->id])}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="row clearfix">

                                                            <div class="col-sm-12">
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <p>
                                                                            <b>Role</b>
                                                                        </p>
                                                                        <select name="update_role" id="update_role" class="form-control show-tick">
                                                                            <option value=""></option>
                                                                            @foreach($roles as $role)
                                                                            <option value="{{$role->name}}" {{$user->hasAnyRole($role->name) ? 'selected' : ''}}>{{$role->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <p>
                                                                            <b>OPD</b>
                                                                        </p>
                                                                        <select name="update_opd_name" id="update_opd_name" class="form-control show-tick" data-live-search="true">
                                                                            <option value=""></option>
                                                                            @foreach($opdes as $opd)
                                                                            <option value="{{$opd->name}}" {{$opd->name == $user->opd_name ? 'selected' : ''}}>{{$opd->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <input type="text" name="name" class="form-control" value="{{$user->name ?? ''}}">
                                                                        <label class="form-label">Nama Lengkap</label>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <input type="text" name="nick_name" class="form-control" value="{{$user->nick_name ?? ''}}">
                                                                        <label class="form-label">Nama Panggilan</label>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <input type="text" name="email" class="form-control" value="{{$user->email ?? ''}}">
                                                                        <label class="form-label">Email</label>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <input type="text" name="username" class="form-control" value="{{$user->username ?? ''}}">
                                                                        <label class="form-label">Username</label>
                                                                    </div>

                                                                    <br>

                                                                    <div class="form-line">
                                                                        <input type="password" name="password" class="form-control">
                                                                        <label class="form-label">Password</label>
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
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahDataUser" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data</h4>
                            </div>
                            <form action="{{route('admin.create.account')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <p>
                                                        <b>Role</b>
                                                    </p>
                                                    <select name="roles" id="roles" class="form-control">
                                                        <option value=""> </option>
                                                        @foreach($roles as $role)
                                                        <option value="{{$role->name}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <p>
                                                        <b>OPD</b>
                                                    </p>
                                                    <select name="opd_name" id="opd_name" class="form-control">
                                                        <option value=""> </option>
                                                        @foreach($opdes as $opd)
                                                        <option value="{{$opd->name}}">{{$opd->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <input type="text" name="name" class="form-control">
                                                    <label class="form-label">Nama Lengkap</label>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <input type="text" name="nick_name" class="form-control">
                                                    <label class="form-label">Nama Panggilan</label>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <input type="text" name="email" class="form-control">
                                                    <label class="form-label">Email</label>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <input type="text" name="username" class="form-control">
                                                    <label class="form-label">Username</label>
                                                </div>

                                                <br>

                                                <div class="form-line">
                                                    <input type="password" name="password" class="form-control">
                                                    <label class="form-label">Password</label>
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


                <div class="modal fade" id="importDataUser" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Import Data</h4>
                            </div>
                            <form action="{{route('admin.import.account')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                

                                                <br>

                                                <div class="form-line">
                                                    <input type="file" name="file" class="form-control">
                                                    <label class="form-label">File</label>
                                                    <small>file format xlsx</small>
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