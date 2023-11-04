<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .table th {

            font-weight: bold;
        }

        .header-table {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        hr {
            border-top: 2px solid #000;
        }

        .signature {
            position: absolute;
            bottom: 0;
            left: 20px;
            /* Sesuaikan posisi horizontal sesuai kebutuhan */
        }

        @media print {
            .page-break {
                page-break-before: auto;
            }

            .signature {
                page-break-before: auto;
            }
        }
    </style>
</head>

<body style="padding-left: 0px 20px 0px 20px; ">

    <div style=" font-weight: 600; margin-left: 20px; text-align: center">
        <h2 style="margin-bottom: 0"> LAPORAN ASET </h2>
        <h3 style="margin-bottom: 0; margin-top: 0;"> POLITEKNIK NEGERI LHOKSEUMAWE </h3>
    </div>
    <table style="width: 20%; text-align: start">
        <tr>
            <th>Unit</th>
            <th>: </th>
            <th>{{ $asets->first()->Ruangan->Unit->name }}</th>
        </tr>
        <tr>
            <th>Ruangan</th>
            <th>: </th>
            <th>{{ $asets->first()->Ruangan->name }}</th>
        </tr>
        <tr>
            <th>Total Barang</th>
            <th>: </th>
            <th>{{ $total }}</th>
        </tr>
    </table>
    <table class="table" style="width: 100%;  table-layout: fixed; margin-top: 20px">
        <tr>
            <th>NO</th>
            <th>BARANG</th>
            <th>VARIANT</th>
            <th>SPESIFIKASI</th>
            <th>KODE BARANG</th>
            <th>TAHUN PENGADAAN</th>
            <th>SIFAT</th>
        </tr>
        @foreach ($asets as $aset)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $aset->Barang->name }}</td>
                <td>{{ $aset->Barang->Variant->name }}</td>
                <td>{{ $aset->Barang->spesifikasi }}</td>
                <td>{{ $aset->Barang->kode_barang }}</td>
                <td>{{ $aset->Barang->tahun }}</td>
                <td>
                    @if ($aset->Barang->isMove == 1)
                        <span class="badge badge-info bg-info">Bergerak</span>
                    @else
                        <span class="badge badge-primary bg-primary">Tidak Bergerak</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </table>

    <div class="page-break">
    </div>

    {{-- ttd --}}
    <div style="margin-top: 130px; padding: 0px 5px 0px 5px">
        <div style="display:flex; justify-content:space-between; padding-right: 20px ">
            <div class="signature" style="float: left;">
                Mengetahui <span style="width: 80px; display: inline-block;"></span>
                <br>
                Atasan Langsung <span style="width: 80px; display: inline-block;"></span>
                <br><br>
                <br><br><br>
                {{-- {{ strtoupper($kontrak->kelas->mahasiswa->where('isKomisaris', 1)->first()->name) }} --}}
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                <p></p>
            </div>
            <div class="signature" style="float: right;">
                @php
                    date_default_timezone_set('Asia/Jakarta');

                    // Get the current day, month, and year
                    $day = date('j');
                    $month = date('F');
                    $year = date('Y');

                    // Create the formatted date string
                    $formattedDate = $day . ' ' . $month . ' ' . $year;
                @endphp
                Bayu, {{ $formattedDate }}<br><br><br><br><br><br>
                <hr style="border-width: 1px; border-color: black; border-style: solid;">
                <p></p>
            </div>
        </div>
    </div>



</body>

</html>
