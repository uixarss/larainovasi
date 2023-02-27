@extends('layouts.guest')
@section('content')
      <div class="container-fluid p-5 mt-5 bg-primary">
    <div class="container my-5">
      <div class="d-md-flex justify-content-start d-none-flex">
        <div>
          <div class="card mr-3" style="width: 140px; height: 140px">
            <img class="mx-auto my-auto" src="{{asset('admin-bsb/thumbnail')}}/{{$lomba->nama_thumbnail}}" alt="" width="100">
          </div>
        </div>
        <div class="align-self-center text-white">
          <h3 class="font-weight-bold">{{$lomba->title}}</h3>
          <p>{{$lomba->penyelenggara}} - {{$lomba->jenis->name}}</p>
        </div>
        <div class="align-self-center ml-auto">
           <div class="card bg-white">
            <div class="card-body">
              <span class="text-secondary">Pelaksanaan</span>
              <h3 class="pt-2"><span class="text-success">{{\Carbon\Carbon::parse($lomba->mulai_acara)->format('d M Y')}}</span> - <span class="text-danger">{{\Carbon\Carbon::parse($lomba->selesai_acara)->format('d M Y')}}</span></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row">
      @include('layouts.alert')
    <div class="col-xl-8 col-lg-8 content-right-offset">
      <div class="single-page-section">
        <h3 class="my-5" style="font-weight:bold !important">Deskripsi Lomba</h3>
        <div style="font-size: unset; font-color: unset;">
          <p style="text-align: justify; ">
            {{$lomba->deskripsi_acara}}
          </p>
        </div>
      </div>
      <div class="card border-0 bg-light mb-5">
        <div class="card-body px-5">
          <div class="d-flex my-4">
            <div class="mr-4">
              <i class="fas fa-map-marker-alt text-primary"></i>
            </div>
            <div>
                <h5 class="">Alamat</h5>
                <span class="text-muted">{{$lomba->lokasi_acara}}</span><br>
            </div>
          </div>
          <div class="d-flex my-4">
            <div class="mr-4">
              <i class="fas fa-clock text-primary"></i>
            </div>
            <div>
              <h5 class="">Pelaksanaan Lomba</h5>
              <span class="text-muted">{{\Carbon\Carbon::parse($lomba->mulai_acara)->format('d M Y')}} - {{\Carbon\Carbon::parse($lomba->selesai_acara)->format('d M Y')}}</span>
            </div>
          </div>
          <div class="d-flex my-4">
            <div class="mr-4">
              <i class="fas fa-id-badge text-primary"></i>
            </div>
            <div>
              <h5 class="">Kuota</h5>
              <span class="text-muted">{{number_format($lomba->target_peserta)}} Peserta</span>
            </div>
          </div>
          @if(isset($lomba->pemenang))
          <div class="d-flex my-4">
            <div class="mr-4">
              <i class="fas fa-people text-primary"></i>
            </div>
            <div>
              <h5>Pemenang</h5>
                @foreach($lomba->pemenang as $pemenang)
                  <span class="badge bg-green">{{$pemenang->pivot->urutan}}</span>
                  {{$pemenang->user->name}} ({{$pemenang->pivot->title}}) <br>
                @endforeach
            </div>
          </div>
          @endif
        </div>
      </div>
    </div>

    

    <!-- Sidebar -->
  <div class="col-xl-4 col-lg-4 mt-5">
      <h6><b>Download Mekanisme Lomba</b></h6>
        <a href="{{route('download.mekanisme',['id' => $lomba->id])}}" class="text-decoration-none">
          <div class="btn btn-block btn-mekanisme text-left px-3 py-2">
          <b>Mekanisme</b>
          <br>
          <span>PDF</span>
        </div>
        </a>

      <div class="card border-0 my-5" style="background: #F9F9F9 !important;">
        <div class="card-header border-0 py-3" style="font-weight:bold !important">Persyaratan</div>
        <ul class="list-unstyled" style="padding:15px !important;margin-left:25px !important">
          @foreach($lomba->syarat as $syarat)
            @if ($syarat->status == "active")
                         <li class="my-2">
                           <i class="fas fa-arrow-right mr-2 text-primary"></i>
                           <span class="text-muted">{{$syarat->name ?? ''}}</span>
                          </li>     
            @endif
          @endforeach
        </ul>

        @if ($lomba->status == "active")
          <a href="{{route('registrasi.lomba', ['id' => $lomba->id])}}" class="btn btn-block btn-primary py-3">Daftar Sekarang</a>
        @else
          <button class="btn btn-block btn-danger py-3" disabled>Pendaftaran Tutup</button>
        @endif
      </div>
    </div>
  </div>

  </div>
@endsection
