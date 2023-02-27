@extends('layouts.admin')
@section('css-add')
<!-- JQuery DataTable Css -->
<link href="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">
@endsection
@section('content')
<div class="container-fluid">
    <div class="bg-white">
        <div class="breadcrumb">
            <li>
                <a href="{{route('home')}} "><i class="material-icons">home</i> Dashboard</a>
            </li>
            <li class="active">
                <i class="material-icons">security</i> API Access
            </li>

        </div>
    </div>

    <!-- PAGE TITLE -->
    <div class="page-title">
        <h3><i class="material-icons">security</i> API Access</h3>
    </div>
    <!-- END PAGE TITLE -->

    <div class="row clearfix">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box bg-light-blue">
                <div class="icon">
                    <i class="material-icons">security</i>
                </div>
                <div class="content">
                    <div class="text font-bold">Total Token API</div>
                    <div class="number">{{$data_api->count()}}</div>
                </div>
            </div>
        </div>

        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <div class="row clearfix">
                        <div class="col-xs-12 col-sm-6">
                            <h4>API</h4>
                        </div>
                        <div class="col-xs-12 col-sm-6 align-right">
                            <button type="button" class="btn btn-info waves-effect" data-toggle="modal" data-target="#tambahDataapi">
                                <i class="material-icons">add</i> <span>Tambah</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="body">
                    @include('layouts.alert')
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover js-basic-example">
                            <thead>
                                <tr>
                                    <th>Nama Domain</th>
                                    <th>IP Address</th>
                                    <th>Token API</th>
                                    <th>Expired At</th>

                                    <th width="130">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_api as $key => $api)
                                <tr>
                                    <td>{{$api->nama_domain}}</td>
                                    <td>{{$api->ip_address}}</td>
                                    <td>{{$api->api_token}}</td>
                                    <td>{{\Carbon\Carbon::parse($api->expired_at)->format('d/m/Y')}}</td>
                                    <td>

                                        <button type="button" class="btn btn-warning btn-circle waves-effect waves-circle waves-float" data-toggle="modal" data-target="#editDataapi{{$api->id}}">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <a href="{{route('admin.delete.apitoken', [ 'id' => $api->id ])}}" onclick="return confirm('Apakah yakin akan dihapus?')" class="btn btn-danger btn-circle waves-effect waves-circle waves-float">
                                            <i class="material-icons">delete</i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="editDataapi{{$api->id}}" tabindex="-1" role="dialog" style="display: none;">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header header">
                                                <h4 class="modal-title">Detail data api</h4>
                                            </div>
                                            <form action="{{route('admin.update.apitoken',['id' => $api->id])}}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="row clearfix">

                                                        <div class="col-sm-12">
                                                            <div class="form-group form-float">
                                                                <div class="form-line">
                                                                    <input type="text" name="nama_domain" class="form-control" value="{{$api->nama_domain}}" disabled>
                                                                    <label class="form-label">Nama Domain</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="ip_address" class="form-control" value="{{$api->ip_address}}" disabled>
                                                                    <label class="form-label">IP Address</label>
                                                                </div>

                                                                <br>
                                                                <div class="form-line">
                                                                    <input type="text" name="api_token" class="form-control" value="{{$api->api_token}}" disabled>
                                                                    <label class="form-label">API Token</label>
                                                                </div>

                                                                <br>

                                                                <div class="form-line">
                                                                    <input type="date-time" name="expired_at" class="form-control" value="{{\Carbon\Carbon::parse($api->expired_at)->format('d/m/Y')}}" disabled>
                                                                    <label class="form-label">Expired At</label>
                                                                </div>

                                                                <br>


                                                            </div>
                                                        </div>


                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                                </div>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="tambahDataapi" tabindex="-1" role="dialog" style="display: none;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header header">
                                <h4 class="modal-title">Tambah Data API Token</h4>
                            </div>
                            <form action="{{route('admin.store.apitoken')}}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="demo-masked-input">
                                        <div class="row clearfix">

                                            <div class="col-sm-12">
                                                <div class="form-group form-float">
                                                    <div class="form-line">
                                                        <input type="text" name="nama_domain" class="form-control" required>
                                                        <label class="form-label">Nama Domain</label>
                                                    </div>

                                                    <br>
                                                    <div class="form-line">
                                                        <input type="text" name="ip_address" class="form-control" required>
                                                        <label class="form-label">IP Address</label>
                                                    </div>

                                                    <br>


                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary waves-effect">Simpan</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">Close</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
</div>
@endsection
@section('js')
<script src="{{asset('admin-bsb/js/admin.js')}}"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('admin-bsb/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>



<!-- Custom Js -->
<script src="{{asset('admin-bsb/js/pages/tables/jquery-datatable.js')}}"></script>


<!-- Input Mask Plugin Js -->
<script src="{{asset('admin-bsb/plugins/jquery-inputmask/jquery.inputmask.bundle.js')}}"></script>

<!-- Multi Select Plugin Js -->
<script src="{{asset('admin-bsb/plugins/multi-select/js/jquery.multi-select.js')}}"></script>

<script src="{{asset('admin-bsb/js/admin.js')}}"></script>

<script>
    $(function() {

        //Masked Input ============================================================================================================================
        var $demoMaskedInput = $('.demo-masked-input');
        var $maskedInput = $('.masked-input');
        // Rupiah
        $maskedInput.find('.money-rupiah').inputmask('Rp 999,999', {
            placeholder: 'Rp ___,___'
        });

        //Date
        $demoMaskedInput.find('.date').inputmask('dd/mm/yyyy', {
            placeholder: '__/__/____'
        });

        //Time
        $demoMaskedInput.find('.time12').inputmask('hh:mm t', {
            placeholder: '__:__ _m',
            alias: 'time12',
            hourFormat: '12'
        });
        $demoMaskedInput.find('.time24').inputmask('hh:mm', {
            placeholder: '__:__ _m',
            alias: 'time24',
            hourFormat: '24'
        });

        //Date Time
        $demoMaskedInput.find('.datetime').inputmask('d/m/y h:s', {
            placeholder: '__/__/____ __:__',
            alias: "datetime",
            hourFormat: '24'
        });

        //Mobile Phone Number
        $demoMaskedInput.find('.mobile-phone-number').inputmask('+99 (999) 999-99-99', {
            placeholder: '+__ (___) ___-__-__'
        });
        //Phone Number
        $demoMaskedInput.find('.phone-number').inputmask('+99 (999) 999-99-99', {
            placeholder: '+__ (___) ___-__-__'
        });

        //Dollar Money
        $demoMaskedInput.find('.money-dollar').inputmask('99,99 $', {
            placeholder: '__,__ $'
        });
        //Euro Money
        $demoMaskedInput.find('.money-euro').inputmask('99,99 €', {
            placeholder: '__,__ €'
        });

        //IP Address
        $demoMaskedInput.find('.ip').inputmask('999.999.999.999', {
            placeholder: '___.___.___.___'
        });

        //Credit Card
        $demoMaskedInput.find('.credit-card').inputmask('9999 9999 9999 9999', {
            placeholder: '____ ____ ____ ____'
        });

        //Email
        $demoMaskedInput.find('.email').inputmask({
            alias: "email"
        });

        //Serial Key
        $demoMaskedInput.find('.key').inputmask('****-****-****-****', {
            placeholder: '____-____-____-____'
        });
        //===========================================================================================================================================
    });
</script>

@stop