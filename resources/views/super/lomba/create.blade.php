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
                <a href="{{route('admin.list.lomba')}}"><i class="material-icons">class</i> Lomba</a>
            </li>
            <li class="active">
                <i class="material-icons">class</i> Lomba Baru
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Tambah Lomba Baru</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <form action="{{route('admin.store.lomba')}}" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="form-line">
                                <label for="title">Judul Lomba</label>
                                <input type="text" name="title" class="form-control" required placeholder="Lomba Penelitian Daerah Wilayah Tiga">
                            </div><br>

                            <div class="form-line">
                                <label for="jenis_lomba_id">Jenis Dokumen</label>
                                <select name="jenis_lomba_id" id="jenis_lomba_id" class="form-control" required>
                                    @foreach($data_jenis_lomba as $jenislomba)
                                    <option value="{{$jenislomba->id}}">{{$jenislomba->name}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="form-line">
                                <label for="mulai_acara">Mulai Acara</label>
                                <input type="date" name="mulai_acara" class="form-control" required placeholder="22/02/2021">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="selesai_acara">Selesai Acara</label>
                                <input type="date" name="selesai_acara" class="form-control" required placeholder="22/04/2021">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="target_peserta">Target Peserta</label>
                                <input type="number" name="target_peserta" class="form-control" required placeholder="50">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="penyelenggara">Penyelenggara Acara</label>
                                <input type="text" name="penyelenggara" class="form-control" required placeholder="Bappelitbangda Kab. Cirebon">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="lokasi_acara">Lokasi Acara</label>
                                <input type="text" name="lokasi_acara" class="form-control" required placeholder="Hotel Patra Kab. Cirebon">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="deskripsi_acara">Deskripsi Acara</label>
                                <input type="text" name="deskripsi_acara" class="form-control" required placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Upload Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control" required>
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Status</label>
                                <select name="status" id="status" class="form-control show-tick">
                                    <option value="active">Active</option>
                                    <option value="closed">Closed</option>
                                    <option value="finished">Finished</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Upload File Dokumen Mekanisme</label>
                                <input type="file" name="file_mekanisme" class="form-control" required>
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