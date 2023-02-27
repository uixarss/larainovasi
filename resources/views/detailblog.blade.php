@extends('layouts.guest')
@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endsection
@section('content')
    @isset($post)
        <div class="container-fluid py-3 mt-5">
            <div class="container my-5 p-0">
                <div class="blog-heading">
                    <h1 class="font-weight-bold">{{ $post->title }}</h1>
                    <p class="text-grey mb-0">{{ date('l, d F Y H:i:s a', strtotime($post->publish_date)) }}</p>
                    <div style="margin-top: 11px">
                        @foreach ($post->category as $c)
                            <span class="badge badge-pill badge-primary px-2 py-1"
                                style="font-size: 12px; line-height: 12px;">{{ $c->name }}</span>
                        @endforeach
                        <span class="badge badge-pill badge-primary px-2 py-1"
                            style="background: #999999 !important;font-size: 12px; line-height: 12px;"><i
                                class="far fa-eye"></i> {{ $post->read == null ? '0' : $post->read }}</span>
                    </div>
                </div>
                <div class="blog">
                    <div class="row blog-content-wrapper">
                        <div class="col-md-12 img-blog-content">
                            <img src="{{ asset('blog/images/' . $post->thumbnail) }}" width="100%" alt="">
                        </div>
                        <div class="col-md-12 text-blog-content">
                            {!! $post->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-danger">Post sudah tidak tersedia!</div>
    @endisset
@endsection
