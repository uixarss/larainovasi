@extends('layouts.guest')

@section('content')
      <div class="container-fluid p-5 mt-5 bg-primary">
    <div class="container my-5">
      <div class="row">
        <div class="col text-white">
          <h3 class="font-weight-bold">Daftar Penelitian Daerah</h3>
          <p>Yang terdaftar di Kab. Cirebon</p>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid">
    <div class="container">
      <div class="home-penelitian my-5">
        <div class="container">
          <div class="card bg-gray shadow-md">
            <div class="p-5 flex justify-between items-center">
              <h2 class="text-left text-2xl md:text-3xl"><b>Penelitian Daerah</b></h2>
            </div>
            <div class="px-5">
              @include('layouts.alert')
              <div class="table-responsive">
                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Judul Penelitian</th>
                      <th scope="col">Institusi</th>
                      <th scope="col">Penulis</th>
                      <th scope="col">Download</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($data_penelitian as $key => $penelitian)
                    <tr>
                      <th scope="row">{{++$key}}</th>
                      <td>{{$penelitian->title}}</td>
                      <td>{{$penelitian->institution}}</td>
                      <td>{{$penelitian->author}}</td>
                      <td>
                        <a href="{{route('download.penelitian', ['id' => $penelitian->id])}}" class="btn btn-info">
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