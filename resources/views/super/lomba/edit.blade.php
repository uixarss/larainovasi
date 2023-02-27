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
                <i class="material-icons">class</i> Edit Lomba
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">class</i> Edit Lomba {{$lomba->title}}</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    @include('layouts.alert')
                    <div>
                        <form action="{{route('admin.update.lomba', ['id' => $lomba->id])}}" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="form-line">
                                <label for="title">Judul Lomba</label>
                                <input type="text" name="title" class="form-control" required placeholder="Lomba Penelitian Daerah Wilayah Tiga" value="{{$lomba->title}}">
                            </div><br>

                            <div class="form-line">
                                <label for="jenis_lomba_id">Jenis Dokumen</label>
                                <select name="jenis_lomba_id" id="jenis_lomba_id" class="form-control" required>
                                    @foreach($data_jenis_lomba as $jenislomba)
                                    <option value="{{$jenislomba->id}}" {{($lomba->jenis_lomba_id == $jenislomba->id) ? 'selected' : ''}}>{{$jenislomba->name}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            <div class="form-line">
                                <label for="mulai_acara">Mulai Acara</label>
                                <input type="date" name="mulai_acara" class="form-control" required placeholder="22/02/2021" value="{{\Carbon\Carbon::parse($lomba->mulai_acara)->format('Y-m-d')}}">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="selesai_acara">Selesai Acara</label>
                                <input type="date" name="selesai_acara" class="form-control" required placeholder="22/04/2021" value="{{\Carbon\Carbon::parse($lomba->selesai_acara)->format('Y-m-d')}}">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="target_peserta">Target Peserta</label>
                                <input type="number" name="target_peserta" class="form-control" required placeholder="50" value="{{$lomba->target_peserta}}">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="penyelenggara">Penyelenggara Acara</label>
                                <input type="text" name="penyelenggara" class="form-control" required placeholder="Bappelitbangda Kab. Cirebon" value="{{$lomba->penyelenggara}}">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="lokasi_acara">Lokasi Acara</label>
                                <input type="text" name="lokasi_acara" class="form-control" required placeholder="Hotel Patra Kab. Cirebon" value="{{$lomba->lokasi_acara}}">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="deskripsi_acara">Deskripsi Acara</label>
                                <input type="text" name="deskripsi_acara" class="form-control" required value="{{$lomba->deskripsi_acara}}" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Upload Thumbnail</label>
                                <input type="file" name="thumbnail" class="form-control">
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Status</label>
                                <select name="status" id="status" class="form-control show-tick">
                                    <option value="active" {{($lomba->status =='active') ? 'selected' : ''}}>Active</option>
                                    <option value="closed" {{($lomba->status =='closed') ? 'selected' : ''}}>Closed</option>
                                    <option value="finished" {{($lomba->status =='finished') ? 'selected' : ''}}>Finished</option>
                                </select>
                            </div>
                            <br>
                            <div class="form-line">
                                <label for="file">Upload File Dokumen Mekanisme</label>
                                <input type="file" name="file_mekanisme" class="form-control">
                            </div><br>
                            <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    Persyaratan Lomba
                </div>
                <div class="body">
                    <div>
                        <form action="{{route('admin.add.persyaratan.lomba', ['id' => $lomba->id])}}" method="post" class="form-group" enctype="multipart/form-data">
                            @csrf
                            <div class="form-line">
                                <label for="title">Nama</label>
                                <input type="text" name="title" class="form-control" required placeholder="Usia 18-49 Tahun">
                            </div><br>
                            <div class="form-line">
                                <label for="urutan">Urutan</label>
                                <input type="text" class="form-control" name="urutan" required>
                            </div><br>
                            <div class="form-line">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="non-active">Non Active</option>
                                </select>

                            </div><br>
                            <div class="form-line">
                                <label for="keterangan">Keterangan</label>
                                <input type="text" class="form-control" name="keterangan">
                            </div><br>

                            <button type="submit" class="btn btn-info waves-effect">SIMPAN</button>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>Urutan</th>
                                    <th width="200">Nama</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lomba->syarat as $syarat)
                                <tr>
                                    <td>
                                        {{$syarat->urutan}}
                                    </td>
                                    <td>{{$syarat->name ?? ''}}</td>
                                    <td>{{$syarat->status ?? '' }}</td>
                                    <td>{{$syarat->keterangan ?? ''}}</td>
                                    <td>
                                        <a href="{{route('admin.delete.persyaratan.lomba',[ 'id' => $syarat->id])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger"><i class="tiny material-icons">delete</i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="footer">

                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            {{--List Pemenang --}}
            <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h3>Pemenang Lomba {{$lomba->title}}</h3>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Urutan</th>
                                        <th>Title</th>
                                        <th>Nama Peserta</th>
                                        <th>Keterangan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lomba->pemenang as $pemenang)
                                    <tr>
                                        <td>
                                            {{$pemenang->pivot->urutan}}
                                        </td>
                                        <td>
                                            {{$pemenang->pivot->title}}
                                        </td>
                                        <td>
                                            {{$pemenang->user->name}}
                                        </td>
                                        <td>
                                            {{$pemenang->keterangan}}
                                        </td>
                                        <td>
                                            <a href="{{route('admin.delete.winner',['id' => $pemenang->pivot->id])}}" class="btn bg-red">
                                            <i class="material-icons">delete</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>

            {{--Input Pemenang--}}
            <div class="col-md-4 col-lg-4 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h4>Input Pemenang</h4>
                    </div>
                    <div class="body">
                        <div>
                            <form action="{{route('admin.post.winner',['id' => $lomba->id])}}" method="post">
                                @csrf
                                <div class="form-line">
                                    <label for="urutan">Urutan</label>
                                    <input type="number" name="urutan" class="form-control" required placeholder="Contoh : 1">
                                </div><br>
                                <div class="form-line">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" required placeholder="Contoh: Juara 1">
                                </div> <br>
                                <div class="form-line">
                                    <label for="peserta">Peserta</label>
                                    <select name="peserta_id" id="peserta_id" class="form-control show-tick" data-live-search="true" data-size="5">
                                        @foreach($lomba->peserta as $peserta)
                                            <option value="{{$peserta->id}}">{{$peserta->pivot->kode_peserta}} | {{$peserta->user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-line">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan" class="form-control" placeholder="Boleh dikosongkan">
                                </div> <br>
                                <button type="submit" class="btn btn-info waves-effect">KIRIM</button>
                            </form>
                        </div>
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