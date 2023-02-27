@extends('layouts.guest')

@section('content')
      <div class="container-fluid py-3 mt-5">
      <div class="container my-5 p-0">
      <h2 class="font-weight-bold">Pengaduan dari Masyarakat</h2>
      <div class="accordion mt-5" id="accordionExample">
        @foreach($data_pengaduan as $key => $pengaduan)
        <div class="card my-2">
          <div class="card-header bg-white" id="faq">
            <h2 class="mb-0">
              <div class="buttonn text-wrap text-left collapsed" data-toggle="collapse" data-target="#faq{{$key}}" aria-expanded="false" aria-controls="faq{{$key}}">
                <small class="text-muted">{{$pengaduan->name}} - {{\Carbon\Carbon::parse($pengaduan->created_at)->diffForHumans()}}</small>
                <h6 class="font-weight-bold mt-2">{{$pengaduan->title}}</h6>
                <p class="inline">{{$pengaduan->body}}</p>
              </div>
            </h2>
          </div>
          <div id="faq{{$key}}" class="collapse" aria-labelledby="faq" data-parent="#accordionExample">
            <div class="card-body text-justify">
              @foreach($pengaduan->respons as $respon)
                {{$respon->respon}}
              @endforeach
            </div>
          </div>
        </div>
        @endforeach
      </div>  
    </div>

  </div>
@endsection