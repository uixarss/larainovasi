@extends('layouts.guest')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

@endsection
@section('content')
  <div class="container-fluid p-5 mt-5 bg-primary">
    <div class="container my-5">
      <div class="row">
        <div class="col text-white">
          <h3 class="font-weight-bold">Daftar Inovasi</h3>
          <p>Inovasi yang terdaftar di Kab. Cirebon</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="container">
    <div class="home-inovasi my-5">
    <div class="container">
      <div class="card bg-gray shadow-md">
        <div class="p-5 flex justify-between items-center">
          <h2 class="text-left text-2xl md:text-3xl"><b>Daftar Inovasi</b></h2>
        </div>
        <div class="px-5">
          <div class="table-responsive">
            <table class="table js-basic-example">
              <thead>
                <tr>
                  <th scope="col">No.</th>
                  <th scope="col">Nama Inovasi</th>
                  <th scope="col">Program</th>
                  <th scope="col">Kegiatan</th>
                  <th scope="col">Sub Kegiatan</th>
                  <th scope="col">Kematangan</th>
                  <th scope="col">Nama SKPD</th>
                  <!-- <th scope="col">Waktu</th> -->
                </tr>
              </thead>
              <tbody>
                  @foreach($data_inovasi as $key => $inovasi)
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$inovasi->nama_inovasi}}</td>
                      <td>{{$inovasi->nama_prg}}</td>
                      <td>{{$inovasi->nama_keg}}</td>
                      <td>{{$inovasi->nama_sub_keg}}</td>
                      <td>{{number_format($inovasi->indikator()->sum('bobot')) ?? ''}}</td>
                      <td>
                        {{$inovasi->skpd->name ?? ''}}
                      </td>
                      <!-- <th scope="row">{{\Carbon\Carbon::parse($inovasi->created_at)->format('d M Y')}}</th> -->
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