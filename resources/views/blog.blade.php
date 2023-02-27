@extends('layouts.guest')
@section('css-add')
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
@endsection
@section('content')
    <div class="container-fluid py-3 mt-5">
        <div class="container my-5 p-0">
            <h2 class="font-weight-bold">Blog</h2>
            <p class="text-secondary">Seputar kabupaten Cirebon dan berita lokal hingga mancanegara.</p>
            <div class="blog">

                <form action="{{ route('cari.blog') }}" method="GET" class="search">
                    <i class="far fa-search"></i>
                    <input type="text" name="cari" class="form-control input-search" id="formGroupExampleInput"
                        placeholder="Search Post">
                </form>
                {{-- @foreach ($data_faq as $key => $faq)
                    <div class="card my-2">
                        <div class="card-header bg-white" id="faq">
                            <h2 class="mb-0">
                                <div class="buttonn text-left collapsed text-weight-bold" data-toggle="collapse"
                                    data-target="#faq{{ $faq->id }}" aria-expanded="false"
                                    aria-controls="faq{{ $faq->id }}">
                                    {{ ++$key }}. {{ $faq->question }}
                                </div>
                            </h2>
                        </div>
                        <div id="faq{{ $faq->id }}" class="collapse" aria-labelledby="faq"
                            data-parent="#accordionExample">
                            <div class="card-body text-justify">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                @endforeach --}}
                <div class="row mt-4">
                    <div class="col-md-12">
                        <ul class="category-menu">
                            <li {{ request()->getPathInfo() == '/news' ? 'class=active' : false }}>
                                <a href="{{ route('list.blog') }}">All</a>
                            </li>
                            @foreach ($categories as $c)
                                @if (request()->getPathInfo() == '/news/categories/' . $c->slug)
                                    <li class="active">
                                        <a href="{{ route('showByCategory.blog', $c->slug) }}">
                                            {{ $c->name }} </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('showByCategory.blog', $c->slug) }}">
                                            {{ $c->name }} </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="row blog-content-wrapper" id="blog">
                    @foreach ($posts as $post)
                        <div class="col-lg-3 col-md-4 col-sm-6 mt-3 content-card">
                            <a href="{{ route('show.blog', ['slug' => $post->slug]) }}" style="text-decoration: none;">
                                <div class="card">
                                    <img class="card-img-top blog-img"
                                        src="{{ asset('blog/images/' . $post->thumbnail) }}" alt="Card image cap">
                                    <div class="card-body">
                                        @foreach ($post->category as $category)
                                            <span class="badge badge-pill badge-primary px-2 py-1"
                                                style="font-size: 10px; line-height: 12px;">{{ $category->name }}</span>
                                        @endforeach
                                        <div class="text-heading mt-2">
                                            <h5>{{ \Str::limit($post->title, 28, '...') }}</h4>
                                        </div>
                                        <div class="text-body">
                                            <p class="text-grey">
                                                {{ date('l, d F Y', strtotime($post->publish_date)) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                    {{-- @if ($posts->count() >= 6) --}}
                    <div class="col-lg-12 text-center btn-loadmore d-flex justify-content-center">
                        {{ $posts->links() }}
                        {{-- <a href="{{ $paginator->nextPageUrl() }}" class="btn btn-primary" id="load_more"
                            data-id="{{ $post->id }}">
                            Load More
                        </a> --}}
                    </div>
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </div>
@endsection
