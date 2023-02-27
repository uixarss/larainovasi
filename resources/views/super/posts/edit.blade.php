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
                    <a href="{{ url('admin/posts') }}"><i class="material-icons">book</i> Blog</a>
                </li>
                <li class="active">
                    Edit Post
                </li>

            </div>
        </div>

        <!-- PAGE TITLE -->
        <div class="page-title">
            <h3 style="margin: 25px 0px"><i class="material-icons">book</i> Blog</h3>
        </div>
        <!-- END PAGE TITLE -->

        <div class="row clearfix posts">
            <form action="{{ route('admin.update.post', ['id' => $post->id]) }}" method="post" class="form-group"
                enctype="multipart/form-data">
                @csrf
                <div class="col-lg-8 col-md-6 col-sm-12 col-xs-12">
                    <div class="card" style="box-shadow: none;">
                        <div class="body">
                            @include('layouts.alert')
                            <div>
                                <div class="form-line">
                                    <label for="title">Name</label>
                                    <input type="text" name="title" class="form-control"
                                        value="{{ old('title') ? old('title') : $post->title }}">
                                </div><br>
                                <label for="Content" class="mb-3">Content</label>
                                <textarea name="content" id="editor" cols="30"
                                    rows="10">{{ old('content') ? old('content') : $post->content }}</textarea>
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
                                        Save
                                    </button>
                                    {{-- <button class="btn btn-success"><i class="fas fa-check-circle"></i>
                                        Save & Edit
                                    </button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Status <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup></h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <select class="form-control" name="status">
                                            <option value="draft" {{ $post->status == 'draft' ? 'selected' : false }}>
                                                Draft
                                            </option>
                                            <option value="published"
                                                {{ $post->status == 'published' ? 'selected' : false }}>
                                                Publish</option>
                                            {{-- <option value="pending" {{ $post->status == 'pending' ? 'selected' : false }}>
                                                Pending
                                            </option> --}}
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Status <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup></h5>
                                </div>
                                <div class="body" style="padding-top: 15px">
                                    {{-- @foreach ($post->category as $i => $pc)
                                        <div class="form-check" style="margin-top: 5px">
                                            <input class="form-check-input" type="checkbox"
                                                name="categories[{{ $i }}]" value="{{ $pc->id }}"
                                                id="defaultCheck{{ $i }}" checked>
                                            <label class="form-check-label" for="defaultCheck{{ $i }}">
                                                {{ $pc->name }}
                                            </label>
                                        </div>
                                    @endforeach --}}
                                    @if ($categories->count() > 0)
                                        @foreach ($categories as $i => $c)
                                            <div class="form-check" style="margin-top: 5px">
                                                <input class="form-check-input" type="checkbox"
                                                    name="categories[{{ $c->id }}]" value="{{ $c->id }}"
                                                    id="defaultCheck{{ $c->id }}">
                                                <label class="form-check-label" for="defaultCheck{{ $c->id }}">
                                                    {{ $c->name }}
                                                </label>
                                            </div>
                                            <?php $i = $c->id; ?>
                                        @endforeach
                                        <div class="form-group input-bordered mt-4" id="input-category"
                                            style="margin-top: 5px">
                                            <input type="text" name="categoryName" class="form-control"
                                                placeholder="Add Kategori" style="width: 73%; display: inline-block">
                                            <button type="button" onclick="addCategory({{ $i }})"
                                                class="btn btn-primary"
                                                style="padding: 7px 17px; vertical-align: 1px;">Add</button>
                                        </div>
                                    @else
                                        <a href="{{ route('admin.list.category') }}" class="btn btn-primary">Create
                                            Categories</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="box-shadow: none;">
                                <div class="heading">
                                    <h5>Thumbnail <sup style="color: red; font-size: 14px; vertical-align: -6px">*</sup>
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <div class="file-upload">
                                        <button class="file-upload-btn" type="button"
                                            onclick="$('.file-upload-input').trigger( 'click' )">Add Image</button>
                                        <div class="image-upload-wrap"
                                            {{ $post->thumbnail ? 'style=display:none;' : false }}>
                                            <input class="file-upload-input" name="thumbnail" type='file'
                                                onchange="readURL(this);" accept="image/*" />
                                            <div class="drag-text">
                                                <h3>Drag and drop a file or select add Image</h3>
                                            </div>
                                        </div>
                                        <div class="file-upload-content"
                                            {{ $post->thumbnail ? 'style=display:block;' : false }}>
                                            <img class="file-upload-image"
                                                src="{{ asset('blog/images/' . $post->thumbnail) }}" alt="your image" />
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
        $.ajax({
            type: "GET",
            url: "{{ route('admin.getPostCategory', $post->id) }}",
            success: function(data) {
                $.each(data, function(key, value) {
                    $('.form-check-input').each(function(index, element) {
                        let id = $(element).val();
                        if (id == value.id) {
                            $(this).attr('checked', true);
                        }

                    })
                });
            },
            error: function() {
                // alert("error");
            }

        });

        CKEDITOR.replace('editor');

        function addCategory(index) {
            const idCheck = parseInt($('.form-check-input:last').attr('value'));
            const input = $('input[name="categoryName"]').val();
            if (input !== null || input !== "") {
                let id = idCheck;
                $.ajax({
                    url: "/admin/categories/create",
                    type: "POST",

                    data: {
                        name: input,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#input-category').before(`
                            <div class="form-check" style="margin-top: 5px">
                                <input class="form-check-input" type="checkbox"
                                    name="categories[${id + 1}]" value="${id + 1}"
                                    id="defaultCheck${id + 1}">
                                <label class="form-check-label" for="defaultCheck${id + 1}">
                                    ${input}
                                </label>
                            </div>
                        `);
                        $('input[name="categoryName"]').val("");
                        Swal.fire(
                            'Berhasil!',
                            'Kategori ditambahkan!',
                            'success'
                        )
                    },
                    error: function() {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Nama kategori tidak boleh sama!',
                            icon: 'error',
                            confirmButtonText: 'Cool'
                        })
                    }

                });
            }

        }

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

    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
@stop
