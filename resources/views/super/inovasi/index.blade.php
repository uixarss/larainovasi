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
        <h3><i class="material-icons">people</i> Indeks Inovasi Daerah</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">people</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Inisiatif</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Inisiatif')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">person</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Uji Coba</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Uji Coba')->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="info-box bg-light-green">
                <div class="icon">
                    <i class="material-icons">attach_money</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Penerapan</div>
                    <div class="number">{{$data_inovasi->where('tahapan_inovasi','Penerapan')->count()}}</div>
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

                            <a href="{{route('admin.create.inovasi')}}" class="btn btn-info waves-effect">
                                <i class="material-icons">add</i> <span>Tambah</span>
                            </a>
                            <a href="{{route('admin.export.inovasi')}}" class="btn bg-orange waves-effect">
                                <i class="material-icons">import_export</i> <span>Export</span>
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
                                    <th style="width: 100px;">Nama Inovasi</th>
                                    <th style="width: 150px;">Program</th>
                                    <th style="width: 150px;">Kegiatan</th>
                                    <th style="width: 150px;">Sub Kegiatan</th>
                                    <th style="width: 50px;">Tahapan Inovasi</th>
                                    <th style="width: 75px;">Waktu Uji Coba</th>
                                    <th style="width: 75px;">Waktu Implementasi</th>
                                    <th style="width: 30px;">Kematangan</th>
                                    <th style="width: 80px;">PIID</th>
                                    <th style="width: auto;">Nama SKPD</th>
                                    <th style="width: auto;">Ubah Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_inovasi as $key => $inovasi)
                                <tr>
                                    <td>
                                        {{++$key}}
                                    </td>

                                    <td>{{$inovasi->nama_inovasi ?? ''}}</td>
                                    <td>{{$inovasi->nama_prg ?? '-'}}</td>
                                    <td>{{$inovasi->nama_keg ?? '-'}}</td>
                                    <td>{{$inovasi->nama_sub_keg ?? '-'}}</td>
                                    <td>{{$inovasi->tahapan_inovasi ?? ''}}</td>
                                    <td>{{$inovasi->waktu_uji_coba->format('d-m-Y') ?? ''}}</td>
                                    <td>{{$inovasi->waktu_implementasi->format('d-m-Y') ?? ''}}</td>
                                    <td>{{number_format($inovasi->indikator()->sum('bobot')) ?? ''}}</td>
                                    <td>Rp {{ number_format($inovasi->reward()->sum('nominal'),2) ?? '-'}}</td>
                                    <td>
                                        {{$inovasi->skpd->name ?? ''}}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="material-icons">download</i> <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a href="{{route('admin.download.pdf',['id' => $inovasi->id])}}">PDF</a></li>
                                                <li><a href="{{route('admin.download.xls',['id' => $inovasi->id])}}">XLS</a></li>
                                            </ul>
                                        </div>
                                        <a href="{{route('admin.edit.indikator.inovasi', ['id' => $inovasi->id])}}" class="btn btn-primary"><i class="material-icons">explore</i></a>
                                        <a href="{{route('admin.edit.inovasi',['id' => $inovasi->id])}}" class="btn btn-info"><i class="material-icons">edit</i></a>
                                        <a href="{{route('admin.delete.inovasi', ['id' => $inovasi->id])}}" class="btn btn-danger" onclick="return confirm('Apakah yakin akan dihapus?')"><i class="material-icons">delete</i></a>
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#tambahDataReward{{$inovasi->id}}"><i class="material-icons">add</i></a>
                                        {{-- Pilih Parameter --}}
                                        <div class="modal fade" id="tambahDataReward{{$inovasi->id}}" tabindex="-1" role="dialog" style="display: none;">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header header">
                                                        <h4 class="modal-title">Tambah Reward</h4>
                                                    </div>
                                                    <form action="{{route('admin.reward.inovasi', ['id' => $inovasi->id])}}" method="post" enctype="multipart/form-data">
                                                        @csrf

                                                        <div class="modal-body">

                                                            <div class="masked-input">
                                                                <div class="row clearfix">

                                                                    <div class="col-sm-12 ">
                                                                        <div class="form-group">
                                                                            <br>
                                                                            <div class="form-line">
                                                                                <b>Sumber Dana</b>
                                                                                <select name="sumberdana" id="sumberdana" data-live-search="true" class="form-control show-tick" data-size="5">
                                                                                    @foreach($data_sumberdana as $sumberdana)
                                                                                    <option value="{{$sumberdana->id}}">{{$sumberdana->nama_dana}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <br>
                                                                            <div class="form-line">
                                                                                <b>Nominal Reward</b>
                                                                                <input type="text" class="form-control" name="nominal" placeholder="Jumlah nominal" required>

                                                                            </div>
                                                                            <br>
                                                                            <div class="form-control">
                                                                                <b>Tahun</b>
                                                                                <input type="text" class="form-control" name="tahun" placeholder="Contoh: 2021" required>
                                                                            </div>
                                                                            <br>
                                                                            <br>
                                                                            <br>
                                                                            <div class="form-line">
                                                                                <b>Keterangan</b>
                                                                                <input type="text" class="form-control" name="keterangan" placeholder="Boleh dikosongkan">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 col-sm-12">
                                                                        <div class="table-responsive">
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                    <th>Tahun</th>
                                                                                    <th>Sumber Dana</th>
                                                                                    <th>Nominal</th>
                                                                                    <th>Tanggal dibuat</th>
                                                                                    <th>Keterangan</th>
                                                                                    <th>Opsi</th>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach($inovasi->reward as $reward)
                                                                                    <tr>
                                                                                        <td>{{$reward->tahun}}</td>
                                                                                        <td>
                                                                                            {{$reward->nama_dana}}
                                                                                        </td>
                                                                                        <td>Rp {{ number_format($reward->nominal) ?? ''}}</td>
                                                                                        <td>{{ $reward->created_at->format('d M Y')}}</td>
                                                                                        <td>{{$reward->keterangan}}</td>
                                                                                        <td><a href="{{route('admin.delete.reward.inovasi', ['id' => $reward->id ])}}" class="btn btn-danger" onclick="return confirm('Apakah yakin akan hapus reward ini?')"><i class="material-icons">delete</i></a></td>
                                                                                    </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>

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
<script src="{{asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>



<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>
<script src="{{asset('admin-bsb/js/admin.js')}}"></script>
@stop