@extends('layouts.admin')
@section('css-add')

    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
    <!-- Bootstrap Select Css -->
    <link href="{{ asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
    <script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
    <style>
        .form-group .form-line:after {
            border-bottom: none !important;
        }

        .delete,
        .delete-add-option,
        .delete-edit-option {
            color: #c13b2a;
            float: right;
            margin-top: -25px;
            text-decoration: none;
            cursor: pointer;
        }

        @media (max-width: 991px) {
            .question-option-wrapper {
                display: block !important;
            }

            .option-wrappers {
                margin-top: 65px;
            }
        }

    </style>
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
                    Edit Polling
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3 style="margin: 25px 0px"><i class="material-icons">insert_chart_outlined</i> Polling</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix posts">
            <form action="{{ route('admin.polling.update', $polling->slug) }}" method="post" class="form-group"
                enctype="multipart/form-data">
                @csrf
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="box-shadow: none;">
                        <div class="body">
                            @include('layouts.alert')
                            <div>
                                <div class="form-line">
                                    <label for="title">Polling Name</label>
                                    <input type="text" name="name"
                                        value="{{ old('name') ? old('name') : $polling->name }}" class="form-control">
                                </div><br>
                                <label for="title" class="mb-3">Description</label>
                                <textarea name="description" id="editor" cols="30"
                                    rows="10">{{ old('description') ? old('description') : $polling->description }}</textarea>

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
                                    <button class="btn btn-primary"><i class="far fa-save"></i>
                                        Update
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
                                        <input type="text" name="author" value="{{ auth()->user()->name }}"
                                            class="form-control" disabled>
                                        <input type="hidden" name="author_id" value="{{ $polling->author_id }}">
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
                                            <option value="on" class="form-control"
                                                {{ $polling->status == 'on' ? 'selected' : false }}>On</option>
                                            <option value="off" class="form-control"
                                                {{ $polling->status == 'off' ? 'selected' : false }}>Off</option>
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
                                        <input type="datetime-local" name="expire_date" class="form-control"
                                            value="<?php echo date('Y-m-d\TH:i:s', strtotime($polling->expire_date)); ?>">
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

                                        <div class="image-upload-wrap"
                                            {{ $polling->thumbnail ? 'style=display:none' : false }}>
                                            <input class="file-upload-input" name="thumbnail" type='file'
                                                onchange="readURL(this);" accept="image/*" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content"
                                            {{ $polling->thumbnail ? 'style=display:block' : false }}>
                                            <img class="file-upload-image"
                                                src="{{ asset('polling/images/' . $polling->thumbnail) }}"
                                                alt="your image" />
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

        <!-- PAGE TITLE -->
        <div class="page-title">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <h3><i class="material-icons" style="float: left;">insert_chart_outlined</i>
                    Questions
                </h3>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addQuestionsModal">Add
                    Questions</a>
            </div>
        </div>

        <div class="row clearfix option-wrappers" style="margin-bottom: 30px;">
            @if ($question->count() > 0)
                @foreach ($question as $q)
                    <div class="col-md-12 mt-3" style="margin-top: 25px;">
                        <div class="card" style="margin-bottom: 0px;">
                            <div class="card-body" style="padding: 10px 15px;">
                                <div class="question-option-wrapper"
                                    style="display: flex; justify-content: space-between; align-items: center;">
                                    <div class="question">
                                        <h4>{{ $q->question }}</h4>
                                    </div>
                                    <div class="action">
                                        <a class="btn btn-warning" data-toggle="modal"
                                            data-target="#editQuestionsModal{{ $q->id }}">Edit</a>
                                        <a href="{{ route('admin.question.destroy', $q->id) }}"
                                            class="btn btn-danger">Hapus</a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editQuestionsModal{{ $q->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="editQuestionsModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editQuestionsModalLabel">Modal
                                                            Questions</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.question.edit', ['id' => $q->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <div class="row clearfix">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <label>Questions</label>
                                                                            <input type="text" name="question"
                                                                                class="form-control"
                                                                                value="{{ $q->question }}">
                                                                            <input type="hidden" name="polling_id"
                                                                                value="{{ $polling->id }}">
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-line">
                                                                            <div
                                                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                                                <label>Options</label>
                                                                                <a href="#" id=""
                                                                                    class="btn btn-primary addOptionsEdit"
                                                                                    data-id={{ $q->id }}>Add
                                                                                    Option</a>
                                                                            </div>
                                                                            <div
                                                                                class="option-wrapper id-{{ $q->id }}">
                                                                                @foreach ($q->options as $index => $option)

                                                                                    <div class="form-line"
                                                                                        style="margin-top: 10px">
                                                                                        <input type="text"
                                                                                            name="option[{{ $index }}]"
                                                                                            class="form-control question-option edit"
                                                                                            value="{{ $option->option }}"
                                                                                            data-id="{{ $option->id }}">
                                                                                        <a href="{{ route('admin.question.delete.option', $option->id) }}"
                                                                                            class="material-icons delete">delete</a>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-primary waves-effect">Simpan</button>
                                                            <button type="button" class="btn btn-link waves-effect"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            @endif
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addQuestionsModal" tabindex="-1" role="dialog"
            aria-labelledby="addQuestionsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addQuestionsModalLabel">Modal Questions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="{{ route('admin.question.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label>Questions</label>
                                            <input type="text" name="question" class="form-control">
                                            <input type="hidden" name="polling_id" value="{{ $polling->id }}">
                                        </div>
                                        <br>
                                        <div class="form-line">
                                            <div
                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                <label>Options</label>
                                                <a href="#" id="addOptions" class="btn btn-primary">Add Option</a>
                                            </div>
                                            <div class="option-wrapper">
                                                <div class="form-line mt-2">
                                                    <input type="text" name="option[0]"
                                                        class="form-control question-option">
                                                    <a href="#" class="material-icons delete-add-option">delete</a>
                                                </div>
                                            </div>
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
@endsection
@section('js')
    <script>
        CKEDITOR.replace('editor');

        //update option
        $('.question-option.edit').change(function() {
            const id = $(this).attr('data-id');
            const input = $(this).val();
            $.ajax({
                url: `/admin/questionoption/${id}/update`,
                type: "POST",

                data: {
                    option: input,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('berhasil mengubah option');
                },
                error: function() {
                    alert("input tidak boleh kosong");
                }

            });
        })
        $('.delete-add-option').click(function() {
            const input = $(this).parent().remove();
        })
        //tambah option
        $('#addOptions').click(function() {
            const length = $('.question-option').length;
            $('.option-wrapper').append(
                `<div class="form-line" style="margin-top: 10px;">
                <input type="text" name="option[${length + 1}]" class="form-control question-option">
                <a href="#" class="material-icons delete-add-option">delete</a>
            </div>`)
            $('.delete-add-option').click(function() {
                const input = $(this).parent().remove();
            })
        })
        $('.addOptionsEdit').click(function() {
            const idQuestion = $(this).attr('data-id');
            let length = $('.input-add-edit').length;
            if (length == 0) {
                length = 0;
            } else {
                length = parseInt($('.input-add-edit:last').attr('data-length'));
            }
            $(`.option-wrapper.id-${idQuestion}`).append(
                `<div class="form-line" style="margin-top: 10px;">
                <input type="text" name="addOption[${length + 1}]" data-length="${length + 1}" class="form-control input-add-edit">
                <a href="#" class="material-icons delete-edit-option">delete</a>
            </div>`)
            $('.delete-edit-option').click(function() {
                const input = $(this).parent().remove();
            })

        })

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
