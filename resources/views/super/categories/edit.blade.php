@extends('layouts.admin')
@section('css-add')
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <!-- fontawesome Icons -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <style>
        .form-group .form-line.form-select:after {
            border-bottom: none !important;
        }

        .badge-success {
            padding: 4px 6px;
            font-size: 10px;
            border-radius: 50% !important;
            background: #8BC34A;
        }

        .alert.alert-primary {
            background: #D2E9F0;
            border-left: 4px solid #00B0E4;
            color: #000000 !important;
        }

        .bulet {
            background: #2a303b;
            padding: 4px;
            border-radius: 4px;
            font-size: 10px;
            color: #ffffff;
            font-weight: 400;
        }

        .bulet.fa-trash:hover {
            color: #ffffff;
            background: #ff8a7f !important;
        }

        .list-categories a.edit-categories:hover span {
            color: #00B0E4 !important;
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="bg-white">
            <div class="breadcrumb">
                <li>
                    <a href="{{ route('home') }} "><i class="material-icons">home</i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('admin/categories') }}"><i class="material-icons">list</i> Categories</a>
                </li>
                <li class="active">
                    Edit Categories
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3 style="margin: 25px 0px"><i class="material-icons">list</i> Categories</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix">
            <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="card" style="box-shadow: none;">
                            @if ($parent->count() < 1)
                                <div>
                                    <div class="card-heading" style="padding: 24px 24px 0 24px">
                                        <h5 style="font-size: 16px">List Categories</h5>
                                    </div>
                                    <div class="body">
                                        <div class="text-center" style="color: #000000">
                                            <p>Category</p>
                                            <p>Not Found</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div>
                                    <div class="card-heading" style="padding: 24px 24px 0 24px">
                                        <h5 style="font-size: 16px">List Categories</h5>
                                    </div>
                                    <div class="body" style="padding: 10px 24px 24px 24px;">
                                        @foreach ($categories as $c)
                                            <div class="list-categories" style="margin-top: 10px">
                                                <a href="{{ route('admin.edit.category', $c->slug) }}"
                                                    class="edit-categories" style="text-decoration: none">
                                                    <span
                                                        style="margin-right: 8px; color: #000000; {{ $c->name == $category->name ? 'font-weight: bold' : false }}">{{ $c->name }}</span>
                                                </a>
                                                <span class="badge badge-pill badge-success"
                                                    style="margin-right: 8px">{{ $c->post->count() }}</span>
                                                <a href="{{ route('showByCategory.blog', $c->slug) }}" target="_blank"><i
                                                        class="bulet fas fa-link"></i></a>
                                                @if ($c->id == $category->id)
                                                    <a href="{{ route('admin.delete.category', $category->id) }}"
                                                        class="bulet fas fa-trash"
                                                        style="text-decoration: none;background: #D24135;"></a>
                                                @endif
                                            </div>
                                        @endforeach
                                        {{-- <div class="list-categories" style="margin-top: 10px">
                                            <span style="margin-right: 8px; color: #000000;">Tradisi</span> <span
                                                class="badge badge-pill badge-success" style="margin-right: 8px">2</span>
                                            <i class="bulet fas fa-link"></i>
                                        </div>
                                        <div class="list-categories" style="margin-top: 10px">
                                            <span style="margin-right: 8px; color: #000000;">Tradisi</span> <span
                                                class="badge badge-pill badge-success" style="margin-right: 8px">2</span>
                                            <i class="bulet fas fa-link"></i>
                                        </div> --}}
                                    </div>
                                </div>
                            @endif
                            <a href="{{ route('admin.list.category') }}" class="btn btn-block btn-primary text-white"
                                style=" padding: 12px; text-decoration: none; border-radius: 0px; color: #ffffff; font-size: 14px;">Create</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                <div class="card" style="box-shadow: none;">
                    <div class="body">
                        @include('layouts.alert')
                        {{-- <div class="alert alert-primary" role="alert">
                            Your create new categories
                        </div> --}}
                        <div>
                            <form action="{{ route('admin.update.category', $category->id) }}" method="post"
                                class="form-group">
                                @csrf
                                <div class="form-line">
                                    <label for="Nama">Nama</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ old('name') ? old('name') : $category->name }}">
                                </div><br>
                                <div class="form-group form-line form-select">
                                    <label for="Parent" style="margin-bottom: 15px">Parent</label>
                                    <select name="parent_id" id="parent" class="form-control">
                                        <option value="">-= Select Parent =-</option>
                                        @foreach ($parent as $p)
                                            <option value="{{ $p->id }}"
                                                {{ $p->id == $category->parent_id ? 'selected' : false }}>
                                                {{ $p->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <!-- Jquery CountTo Plugin Js -->
    {{-- <script src="{{ asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js') }}"></script> --}}

    <!-- Jquery DataTable Plugin Js -->
    {{-- <script src="{{ asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script> --}}
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
@stop
