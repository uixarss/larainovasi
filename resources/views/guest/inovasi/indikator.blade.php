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
                <a href="{{route('guest.list.inovasi')}}"><i class="material-icons">people</i> Indeks Inovasi Daerah</a>
            </li>
            <li class="active">
                <i class="material-icons">people</i> {{$inovasi->nama_inovasi}}
            </li>
        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">people</i> {{$inovasi->nama_inovasi}}</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">



        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h3>Nama Inovasi : {{$inovasi->nama_inovasi}}</h3>
                            <h3>Tahapan : {{$inovasi->tahapan_inovasi}}</h3>
                        </div>
                    </div>
                </div>

                <div class="body">
                    @include('layouts.alert')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 30px;">No</th>
                                    <th style="width: 100px;">Nama Indikator</th>
                                    <th style="width: 100px;">Keterangan</th>

                                    <th style="width: 30px;">Bobot</th>
                                    <th style="width: 40px;">Pilih Parameter</th>
                                    <th style="width: 45px;">Data Pendukung</th>
                                    <th style="width: 50px;">Jenis File</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_indikator as $key => $indikator)
                                <tr>
                                    <td>{{++$key}}</td>
                                    <td>{{$indikator->nama ?? ''}}</td>
                                    <td>{{$indikator->keterangan ?? ''}}</td>

                                    <td>{{$indikator->inovasi->find($inovasi->id)->pivot->bobot ?? ''}}</td>
                                    <td>
                                        <a href="#" class="btn" data-toggle="modal" data-target="#tambahDataParameter{{$indikator->id}}"><i class="material-icons">create</i></a>
                                        {{-- Pilih Parameter --}}
                                        <div class="modal fade" id="tambahDataParameter{{$indikator->id}}" tabindex="-1" role="dialog" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header header">
                                                        <h4 class="modal-title">Tambah Parameter</h4>
                                                    </div>
                                                    <form action="{{route('guest.update.indikator.inovasi',['id_inovasi' => $inovasi->id, 'id_indikator' => $indikator->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="modal-body">

                                                            <div class="row clearfix">

                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <b>{{$key}}. {{$indikator->nama}}</b>
                                                                        <br>
                                                                        <br>
                                                                        <p>{{$indikator->keterangan}}</p>
                                                                        <div class="form-line">
                                                                            <select name="nilai" id="" class="form-control">
                                                                                <option value="0">None</option>
                                                                                @foreach($indikator->nilai as $_indikator_nilai)
                                                                                <option value="{{$_indikator_nilai->nilai}}">{{$_indikator_nilai->uraian}}</option>
                                                                                @endforeach
                                                                            </select>
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
                                    </td>
                                    <td>
                                        {{$indikator->data_pendukung}} <br>
                                        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#tambahDataDokumen{{$indikator->id}}"><i class="material-icons">upload</i> Upload</a>
                                        {{-- Pilih Dokumen --}}
                                        <div class="modal fade" id="tambahDataDokumen{{$indikator->id}}" tabindex="-1" role="dialog" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header header">
                                                        <h4 class="modal-title">Tambah Dokumen</h4>
                                                    </div>
                                                    <form action="{{route('guest.upload.dokumen.indikator.inovasi',['id_inovasi' => $inovasi->id, 'id_indikator' => $indikator->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="modal-body">

                                                            <div class="row clearfix">

                                                                <div class="col-sm-12">
                                                                    @if($indikator->jenis_file == 'dokumen')
                                                                    {{-- File upload --}}

                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">Nomor Surat</b>
                                                                            <input type="text" name="nomor_surat" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">Tanggal Surat</b>
                                                                            <input type="date" name="tanggal_surat" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">Tentang</b>
                                                                            <input type="text" name="tentang" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">File dokumen</b>
                                                                            <input type="file" name="nama_file" class="form-control" required>
                                                                        </div>
                                                                    </div>

                                                                    @else

                                                                    {{-- Foto upload --}}
                                                                    
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">Tentang</b>
                                                                            <input type="text" name="tentang" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    <br>
                                                                    <div class="form-group form-float">
                                                                        <div class="form-line">
                                                                            <b class="lead">File gambar</b>
                                                                            <input type="file" name="nama_file" class="form-control" required>
                                                                        </div>
                                                                    </div>
                                                                    @endif
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
                                    </td>
                                    <td>{{$indikator->jenis_file}}</td>


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
<script src="{{asset('admin-bsb/js/admin.js')}}"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>



<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>
@stop