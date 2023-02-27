@extends('layouts.admin')
@section('css-add')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

@endsection
@section('content')
    <div class="container-fluid">
        <div class="bg-white">
            <div class="breadcrumb">
                <li>
                    <a href="{{ route('home') }} "><i class="material-icons">home</i> Dashboard</a>
                </li>
                <li>
                    <a href="# "><i class="material-icons">book</i> Blog</a>
                </li>
                <li class="active">
                    Posts
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3><i class="material-icons">book</i> Blog</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix">

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Post</div>
                        <div class="number">{{ $posts->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Draft</div>
                        <div class="number">{{ $draft }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Published</div>
                        <div class="number">{{ $published }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <div class="row clearfix">
                            <div class="col-xs-12 col-sm-6">
                            </div>
                            <div class="col-xs-12 col-sm-6 align-right">

                                <a href="{{ route('admin.create.post') }}" class="btn btn-info waves-effect">
                                    <i class="material-icons">add</i> <span>Tambah</span>
                                </a>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Categories</th>
                                        <th>Created at</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $i => $post)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td><img src="{{ asset('blog/images/' . $post->thumbnail) }}" width="100%"
                                                    alt="{{ $post->title }}"
                                                    style="height: 120px; object-fit: cover; object-position: center;"></td>
                                            <td>{{ $post->title }}</td>
                                            <td>
                                                @foreach ($post->category as $category)
                                                    <span class="badge badge-primary"
                                                        style="font-size: 12px; background: #00b0e4;">{{ $category->name }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $post->created_at }}</td>
                                            <td>{{ $post->status }}</td>
                                            <td>
                                                <a href="{{ route('admin.edit.post', ['id' => $post->id]) }}"
                                                    class="btn btn-info"><i class="tiny material-icons">edit</i></a>
                                                <a href="{{ route('admin.delete.post', ['id' => $post->id]) }}"
                                                    class="btn btn-danger">
                                                    <i class="tiny material-icons">delete</i></a>
                                            </td>
                                        </tr>
                                    @endforeach
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

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
@stop
