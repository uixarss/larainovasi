<!DOCTYPE html>
<html>

<head>
    <title>Laporan Inovasi Daerah {{$inovasi->nama_inovasi}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 9pt;
        }

        header {
            position: fixed;
            top: -20px;
            left: 0px;
            right: 0px;
            bottom: 50px;
            height: 100px;
            /** Extra personal styles **/

            color: black;
            text-align: right;
            line-height: 35px;
        }
    </style>
</head>

<body>

    <!-- <header>
        <img src="{{asset('admin-bsb/images/logo-kab-cirebon.png')}}" alt="logokabcrb">
        
    </header> -->
    <br><br><br>
    <h3>LAPORAN INOVASI DAERAH</h3>
    <br>
    <br>
    <h4>1. PROFIL INOVASI</h4>
    <br>
    <h5>1.1. Nama Inovasi</h5><br>
    <p>
        {{$inovasi->nama_inovasi }}
    </p> <br>
    <h5>1.2 Dibuat oleh</h5> <br>
    <p>
        {{$inovasi->user->name ?? ''}}
    </p> <br>
    <h5>1.3. Tahapan Inovasi</h5> <br>
    <p>
        {{$inovasi->tahapan_inovasi ?? '-'}}
    </p> <br>
    <h5>1.4. Inisiator Inovasi Daerah</h5> <br>
    <p>
        {{$inovasi->inisiator_inovasi ?? '-'}}
    </p> <br>
    <h5>1.5. Jenis Inovasi</h5> <br>
    <p>
        {{$inovasi->jenis_inovasi ?? '-'}}
    </p> <br>
    <h5>1.6. Bentuk Inovasi Daerah</h5> <br>
    <p>
        {{$inovasi->bentuk_inovasi ?? '-'}}
    </p> <br>
    <h5>1.7. Urusan Inovasi Daerah</h5> <br>
    <p>
        {{$inovasi->urusan_inovasi ?? '-'}}
    </p> <br>
    <h5>1.8. Rancang Bangun dan Pokok Perubahan Yang Dilakukan</h5> <br>
    <p>
        {!!$inovasi->rancang_inovasi ?? '-' !!}
    </p> <br>

    <h5>1.9. Tujuan Inovasi Daerah</h5> <br>
    <p>
        {!!$inovasi->tujuan_inovasi ?? '-' !!}
    </p> <br>

    <h5>1.10. Manfaat Yang Diperoleh</h5> <br>
    <p>
        {!!$inovasi->manfaat_inovasi ?? '-'!!}
    </p> <br>

    <h5>1.11. Hasil Inovasi</h5> <br>
    <p>
        {!!$inovasi->hasil_inovasi ?? '-'!!}
    </p> <br>

    <h5>1.12. Waktu Uji Coba Inovasi Daerah</h5> <br>
    <p>
        {{\Carbon\Carbon::parse($inovasi->waktu_uji_coba)->format('d M Y')}}
    </p> <br>

    <h5>1.13. Waktu Implementasi</h5> <br>
    <p>
        {{\Carbon\Carbon::parse($inovasi->waktu_implementasi)->format('d M Y')}}
    </p> <br>

    <h5>1.14. Anggaran</h5> <br>
    <p>
        {{$inovasi->anggaran_inovasi ?? '-'}}
    </p> <br>

    <h5>1.15. Profil Bisnis</h5> <br>
    <p>
        {{$inovasi->profil_bisnis ?? '-'}}
    </p> <br>

    <h5>1.16. Kematangan</h5> <br>
    <p>
        {{number_format($inovasi->indikator()->sum('bobot'),2) ?? ''}}
    </p> <br>

    <hr>

    <h4>2. INDIKATOR INOVASI</h4>
    <br>

    <table class="table table-bordered">

        <thead>
            <tr>
                <td width="20px;">
                    No.
                </td>
                <td>
                    Indikator SPD
                </td>
                <td>
                    Informasi
                </td>
                <td>
                    Bukti Dukung
                </td>
            </tr>
        </thead>
        <tbody>

            @foreach($data_indikator as $key => $indikator)
            <tr>
                <td>
                    {{++$key}}.
                </td>
                <td>
                    {{$indikator->nama ?? ''}}
                </td>
                <td>
                    {{$indikator->keterangan ?? ''}}
                </td>
                <td>
                    @foreach($data_dokumen as $dokumen)
                     @if($dokumen->indikator_id == $indikator->id)
                     - {{$dokumen->tentang ?? 'Tidak tersedia'}} <br>
                     @endif
                    @endforeach
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>



</body>

</html>