@extends('layouts.admin')
@section('css-add')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />

    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>

@endsection
@section('content')
    <div class="container-fluid posts">
        <div class="bg-white">
            <div class="breadcrumb">
                <li>
                    <a href="{{ route('home') }} "><i class="material-icons">home</i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('admin/polling') }}"><i class="material-icons">insert_chart_outlined</i> Polling</a>
                </li>
                <li class="active">
                    Create Post
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3 style="margin: 25px 0px"><i class="material-icons">insert_chart_outlined</i> Polling</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix posts">
            <form action="{{ route('admin.polling.store') }}" method="post" class="form-group"
                enctype="multipart/form-data">
                @csrf
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="box-shadow: none;">
                        <div class="body">
                            @include('layouts.alert')
                            <div>
                                <div class="form-line">
                                    <label for="title">Polling Name</label>
                                    <input type="text" name="name" class="form-control" required>
                                </div><br>
                                <label for="title" class="mb-3">Description</label>
                                <textarea name="description" id="editor" cols="30" rows="10"></textarea>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="row clearfix">
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Publish</h5>
                                </div>
                                <div class="body">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save"></i>
                                        Start Making Questions!
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Author <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup></h5>
                                </div>
                                <div class="body" style="padding: 20px">
                                    <div class="form-group input-bordered" style="margin: 0px">
                                        <input type="text" name="author" class="form-control"
                                            value="{{ auth()->user()->name }}" disabled>
                                        <input type="hidden" name="author_id" class="form-control"
                                            value="{{ auth()->id() }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Status <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup></h5>
                                </div>
                                <div class="body" style="padding: 20px">
                                    <div class="form-group input-bordered" style="margin: 0px">
                                        <select name="status">
                                            <option value="on" class="form-control">On</option>
                                            <option value="off" class="form-control">Off</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Expire Date <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup>
                                    </h5>
                                </div>
                                <div class="body" style="padding: 20px">
                                    <div class="form-group input-bordered" style="margin: 0px">
                                        <input type="datetime-local" class="form-control" name="expire_date"
                                            placeholder="Off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Image <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup></h5>
                                </div>
                                <div class="card-body">
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>

                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input" type='file' onchange="readURL(this);"
                                                accept="image/*" name="thumbnail" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload()" class="remove-image">Remove
                                                    <span class="image-title">Uploaded Image</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        CKEDITOR.replace('editor');

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();

                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();

                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();

                    $('.image-title').html(input.files[0].name);
                };

                reader.readAsDataURL(input.files[0]);

            } else {
                removeUpload();
            }
        }

        function removeUpload() {
            $('.file-upload-input').replaceWith($('.file-upload-input').clone());
            $('.file-upload-content').hide();
            $('.image-upload-wrap').show();
        }
        $('.image-upload-wrap').bind('dragover', function() {
            $('.image-upload-wrap').addClass('image-dropping');
        });
        $('.image-upload-wrap').bind('dragleave', function() {
            $('.image-upload-wrap').removeClass('image-dropping');
        });
    </script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
@stop
