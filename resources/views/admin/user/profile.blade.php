@extends('layouts.admin')

@section('content')

<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li class="active">
                <i class="material-icons">person</i> Profil Pribadi
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">person</i> Profil Pribadi</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clear-fix">

        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header" style="background: #B2F590; height: 75px;margin-bottom:30px;">
                    <div class="avatar-wrap" style="bottom: -50px; text-align:center; width:100%; ">
                        <div class="avatar">
                            <img src="https://i.pravatar.cc/150?img=58" alt="" style="border-radius: 50%; text-align: center; width:100px; padding:5px; background-color: transparent; border:1px solid #eee;">

                        </div>
                    </div>
                </div>
                <div class="body" style="text-align: center;">
                    <h2>{{$user->name ?? ''}}</h2>
                    <h5>{{$user->email ?? ''}}</h5>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h3>Data Pribadi</h3>
                </div>
                <div class="body">

                    <div class="form-group">
                        <label class="col-md-4 col-lg-4 col-sm-6 col-xs-6">Nama Lengkap</label>
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6">
                            <label>: {{$user->name ?? ''}}</label>

                        </div>
                        <br>

                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
@endsection
