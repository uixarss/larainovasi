@extends('layouts.admin')
@section('css-add')
    <!-- JQuery DataTable Css -->
    <link href="{{ asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}"
        rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="bg-white">
            <ol class="breadcrumb breadcrumb-bg-gray">
                <li class="active">
                    <a href="{{ route('home') }}"> <i class="material-icons">home</i>Dashboard </a>
                </li>
            </ol>
        </div>



        <div class="row clear-fix">
            <!-- PAGE TITLE -->
            <div class="page-title">
                <h3><i class="material-icons">book</i> Blog</h3>
            </div>
            <!-- END PAGE TITLE -->

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Post</div>
                        <div class="number">{{ $data_post_draft + $data_post_published }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-blue">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Draft</div>
                        <div class="number">{{ $data_post_draft }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Published</div>
                        <div class="number">{{ $data_post_published }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- PAGE TITLE -->
            <div class="page-title">
                <h3><i class="material-icons">bookmark_border</i>Inovasi Daerah</h3>
            </div>
            <!-- END PAGE TITLE -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Inovasi</div>
                        <div class="number">{{ $data_inovasi->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Inisiatif</div>
                        <div class="number">{{ $data_inovasi->where('tahapan_inovasi', 'Inisiatif')->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Uji Coba</div>
                        <div class="number">{{ $data_inovasi->where('tahapan_inovasi', 'Uji Coba')->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Penerapan</div>
                        <div class="number">{{ $data_inovasi->where('tahapan_inovasi', 'Penerapan')->count() }}
                        </div>
                    </div>
                </div>
            </div>
            @php
                $jumlah_kematangan = 0;
                foreach ($data_inovasi as $inovasi) {
                    $jumlah_kematangan += $inovasi->indikator()->sum('bobot');
                }
            @endphp
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange">
                    <div class="icon">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Kematangan</div>
                        <div class="number">{{ $jumlah_kematangan }}</div>
                    </div>
                </div>
            </div>


        </div>


        <!-- Penelitian -->
        <div class="row clearfix">

            <!-- PAGE TITLE -->
            <div class="page-title">
                <h3><i class="material-icons">book</i>Penelitian</h3>
            </div>
            <!-- END PAGE TITLE -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Penelitian</div>
                        <div class="number">{{ $data_penelitian->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-blue">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Draft</div>
                        <div class="number">{{ $data_penelitian->where('status', 'draft')->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Review</div>
                        <div class="number">{{ $data_penelitian->where('status', 'review')->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Publish</div>
                        <div class="number">{{ $data_penelitian->where('status', 'publish')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- KKN -->
        <div class="row clearfix">

            <!-- PAGE TITLE -->
            <div class="page-title">
                <h3><i class="material-icons">description</i>KKN</h3>
            </div>
            <!-- END PAGE TITLE -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">description</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total KKN</div>
                        <div class="number">{{ $data_kkn->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-blue">
                    <div class="icon">
                        <i class="material-icons">description</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Draft</div>
                        <div class="number">{{ $data_kkn->where('status', 'draft')->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange">
                    <div class="icon">
                        <i class="material-icons">description</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Review</div>
                        <div class="number">{{ $data_kkn->where('status', 'review')->count() }}</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green">
                    <div class="icon">
                        <i class="material-icons">description</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Publish</div>
                        <div class="number">{{ $data_kkn->where('status', 'publish')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dokumen -->
        <div class="row clearfix">

            <!-- PAGE TITLE -->
            <div class="page-title">
                <h3><i class="material-icons">book</i>Dokumen</h3>
            </div>
            <!-- END PAGE TITLE -->
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-red">
                    <div class="icon">
                        <i class="material-icons">book</i>
                    </div>
                    <div class="content">
                        <div class="text font-bold">Total Dokumen</div>
                        <div class="number">{{ $data_dokumen->count() }}</div>
                    </div>
                </div>
            </div>
            @foreach ($data_jenis_dokumen as $jenis_dokumen)
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green">
                        <div class="icon">
                            <i class="material-icons">book</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">{{ $jenis_dokumen->name }}</div>
                            <div class="number">
                                {{ $data_dokumen->where('jenis_dokumen_id', $jenis_dokumen->id)->count() }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @role('super admin')
            <!-- API -->
            <div class="row clearfix">

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h3><i class="material-icons">security</i>Data API Token</h3>
                </div>
                <!-- END PAGE TITLE -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <div class="icon">
                            <i class="material-icons">security</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Total API Token</div>
                            <div class="number">{{ $data_api->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pengaduan -->
            <div class="row clearfix">

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h3><i class="material-icons">feedback</i>Pengaduan</h3>
                </div>
                <!-- END PAGE TITLE -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Total Pengaduan</div>
                            <div class="number">{{ $data_pengaduan->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-blue">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Pending</div>
                            <div class="number">{{ $data_pengaduan->where('status', 'pending')->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Proses</div>
                            <div class="number">{{ $data_pengaduan->where('status', 'proses')->count() }}</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green">
                        <div class="icon">
                            <i class="material-icons">feedback</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Selesai</div>
                            <div class="number">{{ $data_pengaduan->where('status', 'selesai')->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User -->
            <div class="row clearfix">

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h3><i class="material-icons">person</i>User</h3>
                </div>
                <!-- END PAGE TITLE -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <div class="icon">
                            <i class="material-icons">person</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Total User</div>
                            <div class="number">{{ $data_user->count() }}</div>
                        </div>
                    </div>
                </div>
                @foreach ($data_role as $role)
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="info-box bg-light-green">
                            <div class="icon">
                                <i class="material-icons">person</i>
                            </div>
                            <div class="content">
                                <div class="text font-bold">{{ $role->name }}</div>
                                <div class="number">{{ $role->users_count }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Lain-lain -->
            <div class="row clearfix">

                <!-- PAGE TITLE -->
                <div class="page-title">
                    <h3><i class="material-icons">question_answer</i>F.A.Q</h3>
                </div>
                <!-- END PAGE TITLE -->
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-red">
                        <div class="icon">
                            <i class="material-icons">question_answer</i>
                        </div>
                        <div class="content">
                            <div class="text font-bold">Total F.A.Q</div>
                            <div class="number">{{ $data_faq->count() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        @endrole

    </div>

@endsection

@section('js')
    <!-- Chart Plugins Js -->
    <script src="{{ asset('admin-bsb/plugins/chartjs/Chart.bundle.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('admin-bsb/js/admin.js') }}"></script>
    <script src="{{ asset('admin-bsb/js/pages/charts/chartjs.js') }}"></script>
@endsection
