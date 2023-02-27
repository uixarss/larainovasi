<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Website Resmi - Sistem Informasi Pengembangan dan Penelitian Kabupaten Cirebon</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.png" type="image/x-icon">
    <link rel="icon" href="/favicon.png" type="image/x-icon">
</head>

<body>
    <div class="w-full bg-light">
        <div class="container">
            @if($lomba->status == 'active')
            <form action="{{route('register.lomba', ['id' => $lomba->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <h3 class="text-center my-5">Registrasi Lomba {{$lomba->title}}</h3>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="name">Nama Peserta</label>
                            <input type="text" name="name" placeholder="Nama Peserta" value="{{$user->name}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="email">Email Peserta</label>
                            <input type="email" name="email" placeholder="Email Peserta" value="{{$user->email}}" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="no_hp">Nomor Handphone Peserta</label>
                            <input type="text" name="no_hp" placeholder="No. Handphone Peserta" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir Peserta</label>
                            <input type="text" name="tempat_lahir" placeholder="Tempat Lahir Peserta" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir Peserta</label>
                            <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir Peserta" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="alamat">Alamat Peserta</label>
                            <textarea name="alamat" id="alamat" class="form-control" cols="30" rows="10"></textarea>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="nama_institusi">Nama Institusi</label>
                            <input type="text" name="nama_institusi" placeholder="Nama Institusi" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="alamat_institusi">Alamat Institusi</label>
                            <input type="text" name="alamat_institusi" placeholder="Alamat Institusi" required class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="judul_dokumen_lomba">Judul Dokumen Lomba</label>
                            <input type="text" name="judul_dokumen_lomba" placeholder="Judul Dokumen Lomba" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label for="file_dokumen_lomba">Dokumen Lomba</label>
                            <small>(Max 3MB, Jenis file yang direkomendasikan adalah PDF)</small>
                            <input type="file" name="file_dokumen_lomba" placeholder="Judul Dokumen Lomba" required class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info py-2 mt-3">Daftar</button>
                        </div>
                    </div>
            </form>
        </div>
        @else
        <div class="row">
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                <h3 class="text-center my-5">Registrasi Lomba {{$lomba->title}}</h3>
            </div>
            <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">

                <a href="{{route('detail.lomba', ['id' => $lomba->id])}}" class="btn btn-block btn-lg btn-info">Kembali Detail Lomba</a>
            </div>

        </div>
        @endif


    </div>

    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>