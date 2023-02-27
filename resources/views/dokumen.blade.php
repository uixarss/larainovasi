@extends('layouts.guest')
@section('content')
      <div class="container-fluid p-5 mt-5 bg-primary">
    <div class="container my-5">
      <div class="row">
        <div class="col text-white">
          <h3 class="font-weight-bold">Dokumen</h3>
          <p>Daftar dokumen Kab. Cirebon</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="container">
        <div class="home-dokumen my-5">
    <div class="container">
      <div class="card bg-gray shadow-md">
        <div class="p-5 flex justify-between items-center">
          <h2 class="text-left text-2xl md:text-3xl"><b>Dokumen</b></h2>
        </div>
        <div class="px-5">
          @include('layouts.alert')
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Tanggal</th>
                  <th scope="col">Nama Dokumen</th>
                  <th scope="col">Download</th>
                </tr>
              </thead>
              <tbody>
                @foreach($data_dokumen as $dokumen)
                <tr>
                  <th scope="row">{{\Carbon\Carbon::parse($dokumen->created_at)->format('d M Y')}}</th>
                  <td>{{$dokumen->name}}</td>
                  <td>
                    <a href="{{route('download.dokumen',['id' => $dokumen->id])}}" class="btn btn-info">
                      <i class="fas fa-cloud-download-alt"></i>
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
  </div>
    </div>
  </div>
@endsection