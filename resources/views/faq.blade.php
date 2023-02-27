@extends('layouts.guest')
@section('content')
      <div class="container-fluid py-3 mt-5">
    <div class="container my-5 p-0">
    <h2 class="font-weight-bold">Pertanyaan yang Sering Ditanyakan</h2>
      <div class="accordion mt-5" id="accordionExample">
        @foreach($data_faq as $key => $faq)
        <div class="card my-2">
          <div class="card-header bg-white" id="faq">
            <h2 class="mb-0">
              <div class="buttonn text-left collapsed text-weight-bold" data-toggle="collapse"
                data-target="#faq{{$faq->id}}" aria-expanded="false" aria-controls="faq{{$faq->id}}">
                {{++$key}}. {{$faq->question}}
              </div>
            </h2>
          </div>
          <div id="faq{{$faq->id}}" class="collapse" aria-labelledby="faq" data-parent="#accordionExample">
            <div class="card-body text-justify">
              {{$faq->answer}}
            </div>
          </div>
        </div>
        @endforeach
      </div>  
    </div>
  </div>
@endsection

