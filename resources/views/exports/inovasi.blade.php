<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Nama SKPD</th>
            <th>Nama Inovasi</th>
            <th>Program</th>
            <th>Kegiatan</th>
            <th>Sub Kegiatan</th>
            <th>Tahapan Inovasi</th>
            <th>Waktu Uji Coba</th>
            <th>Waktu Implementasi</th>
            <th>Kematangan</th>
            @foreach($data_indikator as $indikator)
            <th>{{$indikator->nama}}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($data_inovasi as $key => $inovasi)
        <tr>
            <td>{{++$key}}</td>
            <td>
                {{$inovasi->skpd->name ?? ''}}
            </td>
            <td>{{$inovasi->nama_inovasi}}</td>
            <td>{{$inovasi->nama_prg}}</td>
            <td>{{$inovasi->nama_keg}}</td>
            <td>{{$inovasi->nama_sub_keg}}</td>
            <td>{{$inovasi->tahapan_inovasi}}</td>
            <td>{{$inovasi->waktu_uji_coba->format('m/d/Y')}}</td>
            <td>{{$inovasi->waktu_implementasi->format('m/d/Y')}}</td>
            <td>{{number_format($inovasi->indikator()->sum('bobot'))}}</td>

            @foreach($data_indikator as $indikator)
            <td>
            @php
            $inovasi_indikator = $inovasi->indikator()->where('inovasi_id', $inovasi->id)->where('indikator_id', $indikator->id)->first();
            @endphp
                {{($inovasi_indikator) ? $inovasi_indikator->pivot->bobot : '0'}}
            </td>
            @endforeach

        </tr>
        @endforeach
    </tbody>
</table>