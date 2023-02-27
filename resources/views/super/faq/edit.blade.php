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
            <li>
                <a href="{{route('admin.list.faq')}}"><i class="material-icons">question_answer</i> FAQ</a>
            </li>
            <li class="active">
                <i class="material-icons">question_answer</i> Ubah FAQ
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">question_answer</i> Ubah FAQ</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <form action="{{route('admin.update.faq',['id' => $faq->id])}}" method="post" class="form-group" enctype="multipart/form-data">
                        @csrf
                        <div class="form-line">
                                <label for="title">Pertanyaan</label>
                                <textarea name="question" id="question" cols="30" rows="10" class="form-control" required>{{$faq->question ?? ''}}</textarea>
                            </div><br>
                            <div class="form-line">
                                <label for="answer">Jawaban</label>
                                <textarea type="text" name="answer" class="form-control" cols="20" rows="7" required>{{$faq->answer ?? ''}}</textarea>
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