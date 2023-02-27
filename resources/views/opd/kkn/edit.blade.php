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
                <i class="material-icons">people</i> Indeks Inovasi Daerah
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">book</i> Ubah Penelitian</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <form action="{{route('opd.update.kkn',['id' => $data_kkn->id])}}" method="post" class="form-group" enctype="multipart/form-data">
                        @csrf
                            <div class="form-line">
                                <label for="title">Nama KKN</label>
                                <input type="text" name="title" class="form-control" value="{{$data_kkn->title ?? ''}}" required>
                            </div><br>
                            <div class="form-line">
                                <label for="description">Deskripsi KKN</label>
                                <textarea type="text" name="description" class="form-control" cols="20" rows="7" required>{{$data_kkn->description ?? ''}}</textarea>
                            </div><br>
                            <div class="form-line">
                                <label for="author">Author</label>
                                <input type="text" name="author" class="form-control" value="{{$data_kkn->author ?? ''}}" required>
                            </div><br>
                            <div class="form-line">
                                <label for="institution">Institusi</label>
                                <input type="text" name="institution" class="form-control" value="{{$data_kkn->institution ?? ''}}" required>
                            </div><br>
                            <div class="form-line">
                                <label for="status">Draft</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="draft">Draft</option>
                                    <option value="review">Review</option>
                                    <option value="publish">Publish</option>
                                </select>
                            </div><br>
                            <div class="form-line">
                                <label for="file_kkn">Upload File Laporan KKN</label>
                                <input type="file" name="file_kkn" class="form-control" required>
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