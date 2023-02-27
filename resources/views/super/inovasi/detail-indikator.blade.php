<table>
    <thead>
        <tr>
            <td>
                No.
            </td>
            <td>
                Indikator SPD
            </td>
            <td>
                Informasi
            </td>
            <td>
                Skor
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
                @php
                $inovasi_indikator = $inovasi->indikator()->where('inovasi_id', $inovasi->id)->where('indikator_id', $indikator->id)->first();
                @endphp
                {{($inovasi_indikator) ? $inovasi_indikator->pivot->bobot : '0'}}
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