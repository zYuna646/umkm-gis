<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Boneva</title>
    <style type="text/css">
        body {
            font-family: sans-serif;
            font-size: 12px;
            background-color: #ccc;
            margin: 0;
            padding: 0;
        }

        .rangkasurat {
            width: 100%;
            max-width: 980px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #ccc;
        }

        .tengah {
            text-align: center;
            line-height: 5px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="rangkasurat">
        <table style="border: none">
            <tr>
                <td><img src="{{ public_path('assets/front/img/favicon.png') }}" width="100px" alt="Logo">
                <td class="tengah">
                    <h2>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h2>
                    <h2>DINAS PENDIDIKAN</h2>
                    <h2>CABANG DINAS PENDIDIKAN WILAYAH VIII</h2>
                    <b>Jalan Tarikolot Jatinunggal Telp. (0262) 428590 Sumedang 45376</b>
                </td>
            </tr>
        </table>
        <div class="header">
            <h2>Laporan UMKM</h2>
        </div>
        <table border="1">
            <thead>
                <tr>
                    <th>NO.</th>
                    <th>NAMA PEMILIK</th>
                    <th>ALAMAT</th>
                    <th>JENIS USAHA</th>
                    <th>KLASIFIKASI USAHA</th>
                </tr>
            </thead>
            <tbody>
                @php

                    $i = 0;
                @endphp

                @foreach ($umkms as $item)
                    @php
                        $i++;
                    @endphp
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $item->nama_pemilik }}</td>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->JenisUsaha->name }}</td>
                        <td>{{ $item->KlasifikasiUsaha->name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div></div>
</body>

</html>
