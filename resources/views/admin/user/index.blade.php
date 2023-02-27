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
                <i class="material-icons">people</i> User Management
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> User Management</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Data Users</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataUser">
                                <i class="material-icons">add</i> <span>New User</span>
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
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Email verified at</th>
                                    <th>Roles</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $key => $user)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->email_verified_at}}</td>
                                    <td>
                                        @foreach($user->roles as $role)
                                        @switch($role->name)
                                        @case('admin')
                                        <span class="badge bg-teal">{{$role->name}}</span>
                                        @break

                                        @case('staff')
                                        <span class="badge bg-cyan">{{$role->name}}</span>
                                        @break

                                        @case('customer')
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
                                        <a href="{{route('admin.delete.user', [ 'id' => $user->id ])}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editDataUser{{$user->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Edit Data User</h4>
                                            </div>
                                            <form action="{{route('admin.update.user',['id' => $user->id])}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row clearfix">

                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="name" class="form-control" value="{{$user->name}}">
                                                                    <label class="form-label">Name</label>
                                                                </div>

                                                                <br>

                                                                <div class="form-line">
                                                                    <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                                                    <label class="form-label">Email</label>
                                                                </div>



                                                                <div class="input-group input-group-lg">

                                                                    @foreach($roles as $role)
                                                                    <span class="input-group-addon">
                                                                        <input type="checkbox" name="roles[]" value="{{$role->name}}" class="filled-in" id="user{{$user->id}}ig_checkbox{{$role->id}}">
                                                                        <label for="user{{$user->id}}ig_checkbox{{$role->id}}"></label>
                                                                    </span>
                                                                    <div class="form-line">
                                                                        <input type="text" class="form-control" value="{{$role->name}}" disabled>
                                                                    </div>
                                                                    @endforeach

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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahDataUser" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data User</h4>
                            </div>
                            <form action="{{route('admin.create.user')}}" method="post">
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
                                                    <input type="text" name="email" class="form-control">
                                                    <label class="form-label">Email</label>
                                                </div>

                                                @foreach($roles as $role)

                                                <div class="input-group input-group-lg">
                                                    <span class="input-group-addon">
                                                        <input type="checkbox" name="roles[]" value="{{$role->name}}" class="filled-in" id="add_ig_checkbox{{$role->id}}">
                                                        <label for="add_ig_checkbox{{$role->id}}"></label>
                                                    </span>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" value="{{$role->name}}" disabled>
                                                    </div>
                                                </div>
                                                @endforeach

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