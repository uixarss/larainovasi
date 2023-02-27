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
                <a href="{{route('home')}} ">
                    <i class="material-icons">home</i>
                    Dashboard
                </a>
            </li>
            <li class="active">
                <a href="{{route('admin.list.role')}}">
                    <i class="material-icons">people</i>
                    Role Management
                </a>
            </li>
            <li class="active">
                <a href="#">
                    <i class="material-icons">people</i>
                    Edit Role
                </a>
            </li>

        </div>
    </div>

    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>Roles {{$role->name ?? ''}}</h4>
                        </div>
                        
                    </div>
                </div>

                <div class="body">
                @include('layouts.alert')
                    <form action="{{route('admin.update.role',[ 'id' => $role->id])}}" method="post">
                        @csrf


                        <div class="row clearfix">

                            <div class="col-sm-12">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="name" class="form-control" value="{{$role->name}}">
                                        <label class="form-label">Name</label>
                                    </div>

                                    <br>

                                    @foreach($permissions as $key => $permission)

                                    <div class="input-group input-group-lg">
                                        <span class="input-group-addon">
                                            <input type="checkbox" name="permission_name[]" value="{{$permission ?? ' '}}" class="filled-in" id="ig_checkbox{{$permission ?? ' '}}" {{ in_array($permission, $hasPermission) ? 'checked' : ' ' }}>
                                            <label for="ig_checkbox{{$permission ?? ' '}}"></label>
                                        </span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" value="{{$permission ?? ' ' }}" disabled>
                                        </div>
                                    </div>

                                    @endforeach

                                </div>
                            </div>


                        </div>



                        <button type="submit" class="btn btn-primary waves-effect">Save</button>


                    </form>
                </div>



            </div>
        </div>



    </div>
</div>
@endsection