<table>
    <thead>
        <tr>
            <th>Data</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nama Inovasi</td>
            <td>{{$inovasi->nama_inovasi}}</td>
        </tr>
        <tr>
            <td>Dibuat oleh</td>
            <td>
                {{$inovasi->user->name ?? ''}} ({{$inovasi->user->username ?? ''}})
            </td>
        </tr>
        <tr>
            <td>Program</td>
            <td>
                {{$inovasi->nama_prg ?? ''}}
            </td>
        </tr>
        <tr>
            <td>Kegiatan</td>
            <td>
                {{$inovasi->nama_keg ?? ''}}
            </td>
        </tr>
        <tr>
            <td>Sub Kegiatan</td>
            <td>
                {{$inovasi->nama_sub_keg ?? ''}}
            </td>
        </tr>
        <tr>
            <td>Tahapan Inovasi</td>
            <td>
                {{$inovasi->tahapan_inovasi}}
            </td>
        </tr>
        <tr>
            <td>Inisiator Inovasi</td>
            <td>
                {{$inovasi->inisiator_inovasi}}
            </td>
        </tr>
        <tr>
            <td>Jenis Inovasi</td>
            <td>
                {{$inovasi->jenis_inovasi}}
            </td>
        </tr>
        <tr>
            <td>Bentuk Inovasi</td>
            <td>
                {{$inovasi->bentuk_inovasi}}
            </td>
        </tr>
        <tr>
            <td>Urusan Inovasi Daerah</td>
            <td>
                {{$inovasi->urusan_inovasi}}
            </td>
        </tr>
        <tr>
            <td>Rancang Bangun dan Pokok Perubahan yang dilakukan</td>
            <td>
                {!!$inovasi->rancang_inovasi !!}
            </td>
        </tr>
        <tr>
            <td>Tujuan Inovasi Daerah</td>
            <td>
                {!!$inovasi->tujuan_inovasi!!}
            </td>
        </tr>
        <tr>
            <td>Manfaat Yang Diperoleh</td>
            <td>
                {!!$inovasi->manfaat_inovasi!!}
            </td>
        </tr>
        <tr>
            <td>Hasil Inovasi</td>
            <td>
                {!!$inovasi->hasil_inovasi!!}
            </td>
        </tr>
        <tr>
            <td>Waktu Uji Coba Inovasi Daerah</td>
            <td>
                {{\Carbon\Carbon::parse($inovasi->waktu_uji_coba)->format('d-m-Y')}}
            </td>
        </tr>
        <tr>
            <td>Waktu Implementasi Inovasi Daerah</td>
            <td>
                {{\Carbon\Carbon::parse($inovasi->waktu_implementasi)->format('d-m-Y')}}
            </td>
        </tr>
        <tr>
            <td>Anggaran</td>
            <td>
                {{$inovasi->anggaran_inovasi }}
            </td>
        </tr>
        <tr>
            <td>Profil Bisnis</td>
            <td>
                {{$inovasi->profil_bisnis }}
            </td>
        </tr>
        <tr>
            <td>Kematangan</td>
            <td>
                {{number_format($inovasi->indikator()->sum('bobot'),2)}}
            </td>
        </tr>

    </tbody>
</table>