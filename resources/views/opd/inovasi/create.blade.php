@extends('layouts.admin')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
<!-- Bootstrap Select Css -->
<link href="{{asset('admin-bsb/plugins/bootstrap-select/css/bootstrap-select.css')}}" rel="stylesheet" />

@endsection
@section('content')
<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li>
                <a href="{{route('opd.list.inovasi')}}"><i class="material-icons">bookmark_border</i> Indeks Inovasi Daerah</a>
            </li>
            <li class="active">
                <i class="material-icons">bookmark_border</i> Create
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">bookmark_border</i> Indeks Inovasi Daerah</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">

        <form action="{{route('opd.store.inovasi')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row clearfix" id="form-edit">
                @include('layouts.alert')
                {{-- Data Inovasi Daerah --}}
                <div class="col-md-12 col-sm-12">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama Program</b>
                            <input name="nama_prg" id="prg" class="form-control" value="-" disabled>

                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama Kegiatan</b>
                            <input name="nama_keg" id="keg" class="form-control" value="-" disabled>

                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama Sub Kegiatan</b>
                            <select name="nama_sub_keg" id="sub_keg" onchange="getSubKeg()" class="form-control" data-live-search="true">
                                @foreach($data_sub_keg as $sub_keg)
                                <option value="{{$sub_keg['kd_sub_keg']}}">{{$sub_keg['nama_sub_keg']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama Inovasi</b>
                            <input type="text" name="nama_inovasi" class="form-control" required>
                        </div>
                    </div>

                    <div class="form-group form-float">
                        <div class="form-line">
                            <b class="lead">Nama OPD</b>
                            <select name="opd_id" id="opd_id" class="form-control show-tick" data-size="5" data-live-search="true">
                                <option value="">--Tidak ada--</option>
                                @foreach($data_opd as $opd)
                                <option value="{{$opd->id}}">{{$opd->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <b class="lead">Tahapan Inovasi</b>
                    <div class="form-group form-float">

                        <div class="form-line">

                            <div class="col-md-4 col-sm-12">

                                <input type="radio" name="tahapan_inovasi" id="tahapan_inisiatif" class="with-gap radio-col-green" value="Inisiatif" checked>
                                <label for="tahapan_inisiatif">Inisiatif</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <input type="radio" name="tahapan_inovasi" id="tahapan_uji_coba" class="with-gap radio-col-green" value="Uji Coba">
                                <label for="tahapan_uji_coba">Uji Coba</label>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <input type="radio" name="tahapan_inovasi" id="tahapan_penerapan" class="with-gap radio-col-green" value="Penerapan">
                                <label for="tahapan_penerapan">Penerapan</label>
                            </div>


                        </div>
                    </div>
                    <br>
                    <b class="lead">Inisiator Inovasi Daerah</b>
                    <div class="form-group form-float">

                        <div class="form-line">

                            <div class="col-md-2 col-sm-12">

                                <input type="radio" name="inisiator_inovasi" id="inisiator_kepala_daerah" class="with-gap radio-col-green" value="Kepala Daerah" checked>
                                <label for="inisiator_kepala_daerah">Kepala Daerah</label>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <input type="radio" name="inisiator_inovasi" id="inisiator_anggota_dpr" class="with-gap radio-col-green" value="Anggota DPRD">
                                <label for="inisiator_anggota_dpr">Anggota DPRD</label>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <input type="radio" name="inisiator_inovasi" id="inisiator_opd" class="with-gap radio-col-green" value="OPD">
                                <label for="inisiator_opd">OPD</label>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <input type="radio" name="inisiator_inovasi" id="inisiator_asn" class="with-gap radio-col-green" value="ASN">
                                <label for="inisiator_asn">ASN</label>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <input type="radio" name="inisiator_inovasi" id="inisiator_masyarakat" class="with-gap radio-col-green" value="Masyarakat">
                                <label for="inisiator_masyarakat">Masyarakat</label>
                            </div>


                        </div>
                    </div>
                    <br>
                    <b class="lead">Jenis Inovasi</b>
                    <div class="form-group form-float">

                        <div class="form-line">

                            <div class="col-md-6 col-sm-12 col-xs-12">

                                <input type="radio" name="jenis_inovasi" id="jenis_digital" class="with-gap radio-col-green" value="digital" checked>
                                <label for="jenis_digital">Digital</label>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                <input type="radio" name="jenis_inovasi" id="jenis_non_digital" class="with-gap radio-col-green" value="non Digital">
                                <label for="jenis_non_digital">Non Digital</label>
                            </div>



                        </div>
                    </div>
                    <b class="lead">Bentuk Inovasi Daerah</b>
                    <div class="form-group form-float">
                        <div class="form-line">

                            <select name="bentuk_inovasi" id="bentuk_inovasi" class="form-control" data-live-search="true">
                                <option value="Inovasi Tata Kelola">Inovasi Tata Kelola</option>
                                <option value="Inovasi Pelayanan Publik">Inovasi Pelayanan Publik</option>
                                <option value="Inovasi Lainnya">Inovasi Lainnya</option>
                            </select>
                        </div>
                    </div>

                    <b class="lead">Urusan Inovasi Daerah</b>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <select name="urusan_inovasi" id="urusan_inovasi" class="form-control" data-live-search="true">
                                @foreach($data_urusan as $urusan)
                                @if(isset($urusan['nama_bid_urusan']))
                                <option value="{{strtolower($urusan['nama_bid_urusan'])}}">{{strtolower($urusan['nama_bid_urusan'])}}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <b class="lead">Waktu Uji Coba Inovasi Daerah</b>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="date" name="waktu_uji_coba" id="waktu_uji_coba" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <b class="lead">Waktu Implementasi Inovasi Daerah</b>
                        <div class="form-group form-float">
                            <div class="form-line">
                                <input type="date" name="waktu_implementasi" id="waktu_implementasi" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <b class="lead">Rancang bangun dan pokok perubahan yang dilakukan</b>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="rancang_bangun" id="rancang_bangun" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <b class="lead">Tujuan Inovasi Daerah</b>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="tujuan_inovasi" id="tujuan_inovasi" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <b class="lead">Manfaat Inovasi Daerah</b>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="manfaat_inovasi" id="manfaat_inovasi" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <b class="lead">Hasil Inovasi Daerah</b>
                    <div class="form-group form-float">
                        <div class="form-line">
                            <textarea name="hasil_inovasi" id="hasil_inovasi" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                    <b class="lead">Anggaran <small>(jika diperlukan)</small></b>
                    <input type="file" name="anggaran" id="anggaran">
                    <b class="lead">Profil Bisnis <small>(jika ada)</small></b>
                    <input type="file" name="profil_bisnis">
                    <b class="lead">Dibuat oleh</b>
                    <small>{{Auth::user()->name}}</small>

                </div>




            </div>



            <button type="submit" id="submit" class="btn btn-primary waves-effect">Simpan</button>
            <br>

        </form>

    </div>
</div>
@endsection

@section('js')
<!-- JS sub kegiata, kegiatan, program -->
<script type="text/javascript">
    function getSubKeg() {
        var sub_keg = document.getElementById("sub_keg").value;

        console.log(sub_keg);

        $.post('{{url("get-data-keg-prg")}}', {
            'kd_sub_keg': sub_keg,
            '_token': $('input[name=_token]').val()
        }, function(data) {
            console.log((data));
            document.getElementById("keg").value = data[0]["nama_keg"];

            document.getElementById("prg").value = data[0]["nama_prg"];
        });
    }
</script>
<!-- Ckeditor -->
<script src="{{asset('admin-bsb/plugins/ckeditor/ckeditor.js')}}"></script>
<script>
    $(function() {
        //CKEditor
        CKEDITOR.replace('rancang_bangun');
        CKEDITOR.config.height = 300;
        CKEDITOR.replace('tujuan_inovasi');
        CKEDITOR.config.height = 300;
        CKEDITOR.replace('manfaat_inovasi');
        CKEDITOR.config.height = 300;
        CKEDITOR.replace('hasil_inovasi');
        CKEDITOR.config.height = 300;


    });
</script>

<script src="{{asset('admin-bsb/js/admin.js')}}"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>



<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>

@stop