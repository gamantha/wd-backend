<title>Report {{ $id }}</title>

<head> </head>

<body>
    <ul>
        <li>Report ID: {{ $id }}</li>
        <li>Author ID: {{ $author_id }}</li>
        <li>Report Date: {{ $report_date }}</li>
    </ul>
    <br/>
    <table width="400px" border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Indicator</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report_indicator_map as $key => $indicator_map)
                <tr>
                    <td>{{ $indicator_map['order'] }}</td>
                    <td>{{ $indicator_map['indicator']['label'] }}</td>
                    <td> {{ $indicator_value[$key]['value'] }} </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
