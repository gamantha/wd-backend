<title>Report {{ $id }}</title>
<head>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
        /*design indicators*/
        table.indicators {
            font-family: Arial, Helvetica, sans-serif;
            color: #232323;
            border-collapse: collapse;
        }
        table.indicators, table.indicators tr, table.indicators th, table.indicators td {
            border: 1px solid #999;
            padding: 8px 20px;
        }
    </style>
</head>
<body>
    <center>
        <p><b>LAPORAN BULANAN (LB3)</b></p>
		<small>KEGIATAN GIZI, KIA, IMUNISASI & PENGAMATAN PENYAKIT MENULAR</small>
    </center>
    <table class="name" width="100%" style="margin-top: 20px; font-size: 12px;">
        <tr>
            <td style="text-align: right">Kode Puskesmas</td>
            <td style="width: 10px;">:</td>
            <td style="width: 200px; ">{{ $id }}</td>
            <td style="text-align: right">Yang Lapor</td>
            <td style="width: 10px;">:</td>
            <td>{{ $author_id }}</td>
        </tr>
        <tr>
            <td style="text-align: right">Puskesmas</td>
            <td style="width: 10px;">:</td>
            <td>{{ $author_id }}</td>
            <td style="text-align: right">Periode</td>
            <td style="width: 10px;">:</td>
            <td>{{ date('d-m-Y', strtotime($report_date)) }}</td>
        </tr>
        <tr>
            <td style="text-align: right">Kabupaten/Kota</td>
            <td style="width: 10px;">:</td>
            <td> - </td>
        </tr>
    </table>
    <table class="indicators" width="100%" style="margin-top: 20px; font-size: 12px;">
        <thead>
            <tr>
                <th>Indicator Name</th>
                <th style="width: 50px;">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td> {{ $category['name'] }} </td>
                </tr>
                @foreach ($category->indicators as $indicator)
                    <tr>
                        <td>{{ $indicator['label'] }}</td>
                        <td style="text-align: center"> {{ $indicator['indicator_value']['value'] ? $indicator['indicator_value']['value'] : 0 }} </td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <table width="100%" style="margin-left: 20px; margin-top: 20px; font-size: 14px;">
        <tr>
            <td>Kepala Puskesmas</td>
        </tr>
    </table>
</body>
