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
                <i class="material-icons">people</i> Permission Management
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> Permission Management</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Permissions</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataRole">
                                <i class="material-icons">add</i> <span>New Permission</span>
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
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permissions as $permission)
                                <tr>

                                    <td>{{$permission->name}}</td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDataRole{{$permission->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.permission', [ 'id' => $permission->id ])}}" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                    <div class="modal fade" id="editDataRole{{$permission->id}}" tabindex="-1" role="dialog" style="display: none;">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header header">
                                                    <h4 class="modal-title">Edit Role</h4>
                                                </div>
                                                <form action="{{route('admin.update.permission',['id' => $permission->id])}}" method="post">
                                                    @csrf
                                                    <div class="modal-body">

                                                        <div class="row clearfix">

                                                            <div class="col-sm-12">
                                                                <div class="form-group form-float">
                                                                    <div class="form-line">
                                                                        <input type="text" name="name" class="form-control" value="{{$permission->name}}">
                                                                        <label class="form-label">Name</label>
                                                                    </div>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary waves-effect">Save</button>
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

                <div class="modal fade" id="tambahDataRole" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Permission</h4>
                            </div>
                            <form action="{{route('admin.create.permission')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="row clearfix">

                                        <div class="col-sm-12">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input type="text" name="name" class="form-control">
                                                    <label class="form-label">Name</label>
                                                </div>
                                            </div>
                                        </div>


                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">Save</button>
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