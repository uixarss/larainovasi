@extends('layouts.guest')
@section('content')
  <div class="container-fluid p-5 mt-5 bg-primary">
    <div class="container my-5">
      <div class="d-md-flex justify-content-start d-none-flex">
        <div>
          <div class="card mr-3" style="width: 140px; height: 140px">
            <img class="mx-auto my-auto" src="{{asset('admin-bsb/thumbnail')}}/{{$lomba->nama_thumbnail ?? ''}}" alt="" width="100">
          </div>
        </div>
        <div class="align-self-center text-white">
          <h3 class="font-weight-bold">{{$lomba->title ?? 'Lomba Penelitian Teknologi dan Sosekwil '}}</h3>
          <p>{{$lomba->penyelenggara ?? 'Bappelitbangda Kab. Cirebon '}} - {{$lomba->jenis->name ?? 'Penelitian'}}</p>
        </div>
        <div class="align-self-center ml-auto">
           <div class="card bg-white">
            <div class="card-body">
              <span class="text-secondary">Pelaksanaan</span>
              <h3 class="pt-2"><span class="text-success">{{\Carbon\Carbon::parse($lomba->mulai_acara ?? '')->format('d M Y')}}</span> - <span class="text-danger">{{\Carbon\Carbon::parse($lomba->selesai_acara ?? '')->format('d M Y')}}</span></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      <div class="col-xl-8 col-lg-8 content-right-offset">
        <div class="single-page-section">
          <h3 class="my-5" style="font-weight:bold !important">Deskripsi</h3>
          <div style="font-size: unset; font-color: unset;">
            <p style="text-align: justify; ">
            {{$lomba->deskripsi_acara ?? 'Tidak ada lomba'}}</p>
          </div>
        </div>
      </div>
  
      <!-- Sidebar -->
      @if(isset($lomba))
    <div class="col-xl-4 col-lg-4 mt-5">
      @include('layouts.alert')
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
    @endif
    </div>
  </div>  
    @if($data_lomba != null)
    <div class="container my-5">
      <h3><b>Daftar Lomba Penelitian Teknologi dan Sosekwil</b></h3>
      <div class="row mt-5">
        <div class="col-md-4">
          <form>
            <div class="form-group">
              <label>Kata Kunci</label>
              <input type="text" class="form-control" placeholder="e.g. UMKM, Inovasi, Penelitian">
            </div>
            <div class="form-group">
              <label>Tanggal Mulai</label>
              <input type="date" class="form-control">
            </div>
            <div class="form-group">
              <label>Tanggal Berakhir</label>
              <input type="date" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary px-3 py-2 mt-4">Tampilkan</button>
          </form>
        </div>
        <div class="col-md-8">
          @foreach ($data_lomba as $key => $lomba)
          <div class="card mb-2">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-fill align-self-center">
                  <img src="{{asset('admin-bsb/thumbnail')}}/{{$lomba->nama_thumbnail}}" alt="" width="100">
                </div>
                <div class="p-2 flex-fill">
                  <h4 class="my-1">{{$lomba->title}}</h4>
                  <p class="mt-1">{{$lomba->penyelenggara}} - {{$lomba->jenis->name}}</p>
                  <ul class="list-unstyled text-muted">
                    <li class="d-flex mb-1">
                      <i class="fas fa-map-marker-alt flex-fill"></i>
                      <small class="flex-fill">{{$lomba->lokasi_acara}}</small>
                    </li>
                    <li>
                      <i class="fas fa-clock"></i>
                      <small class="pl-2 mr-2">Pelaksanaan : <span class="text-success">{{\Carbon\Carbon::parse($lomba->mulai_acara)->format('d M Y')}}</span> - <span class="text-danger">{{\Carbon\Carbon::parse($lomba->selesai_acara)->format('d M Y')}}</span>
                      </small>
                      <i class="fas fa-id-badge"></i>
                      <small class="text-primary">{{number_format($lomba->target_peserta)}}</small>
                      @if ($lomba->status == "closed" || $lomba->status == "finished")
                      <span class="badge badge-danger">TUTUP</span>
                      @endif
                      
                    </li>
                  </ul>
                </div>
                <div class="p-2 flex-fill align-self-center">
                  <a href="{{route('detail.lomba', ['id' => $lomba->id])}}" class="btn btn-detail py-2 px-4">Detail</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>    
    @endif
@endsection
