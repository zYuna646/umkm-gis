<!DOCTYPE html>
<html lang="en" style="margin-left: 8%">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan UMKM</title>
    <style>
        table tr td {
            font-size: 13px;
        }

        @media only screen and (max-width: 768px) {
            table tr td {
                width: 100%;
            }
        }

        #kanan {
            margin-left: 70%;
        }

        #kanan_ttd {
            margin-left: 80%;
        }

        .data {
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 13px
        }

        .data thead {
            border: 1px solid black;
        }

        .data tbody tr {
            border: 1px solid black;
        }

        .data td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <center>
        <table>
            <tr>
                <td>
                    <img src="{{ public_path('assets/front/img/cop.png') }}" width="90" height="90" alt="">
                </td>
                <td>
                    <center>
                        <font size="4">PEMERINTAH KABUPATEN BOLAANG MONGONDOW SELATAN</font><br>
                        <font size="2">DINAS KOPERASI DAN UKM TRANSMIGRASI DAN TENAGA KERJA</font><br>
                        <font size="1">Jln. Daopeyago,Desa Popodu Kecamatan Bolaang Uki,Kode Pos 95774</font><br>
                    </center>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <div class="header">
            <font size='2' style="text-align: left">
                DAFTAR JUMLAH PELAKU USAHA MIRKO, KECIL, DAN MENENGAH <br> DINAS KOPERASI DAN UMKM, TRANSMIGRASI DAN
                TEANGA KERJA KABUPATEN BOLAANG MONGONDOW
            </font>
        </div>
        @if (count($umkms) > 0)
            <table class="data">
                <thead>
                    <tr>
                        <th>NO.</th>
                        <th>NAMA PEMILIK</th>
                        @foreach ($data as $item)
                            <th>{{ $item }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php

                        $i = 0;
                    @endphp

                    @foreach ($umkms as $umkm)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $umkm->nama_pemilik }}</td>
                            @foreach ($data as $item)
                                @if ($item == 'Klasifikasi Usaha' || $item == 'Jenis Usaha')
                                    <td>{{ $umkm->{$fields[$item]}->name }}</td>
                                @elseif ($item == 'Aktif' || $item == 'Bantuan' || $item == 'Umum')
                                    <td>{{ $umkm->{$fields[$item]} == 0 ? 'Tidak' : 'Ya' }}</td>
                                @else
                                    <td>{{ is_array($umkm->{$fields[$item]}) ? implode(', ', $umkm->{$fields[$item]}) : $umkm->{$fields[$item]} }}
                                    </td>
                                @endif
                            @endforeach

                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <br>
        <br>
        <table>
            <tr>
                <td>
                    <table id="kiri">

                    </table>
                </td>
                <td>
                    <table id="kanan_ttd">
                        <tr>
                            <td>
                                <font size='2'>Bolaang Uki, 28 November 2023 <br>Kepala Dinas
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    MUHAMMAD BASRI SUTRIMO, S, STP <br>
                                    NIP 1980110320011121002
                                </font>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </center>
</body>

</html>
