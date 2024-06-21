<!DOCTYPE html>
<html>
    <head>
        <title>Exported Data</title>
    </head>
    <body>
        <table border="1">
            <thead>
                <tr>
                    <th>response_id</th>
                    <th>user_id</th>
                    @foreach ($dimensions as $d)
                        <th>{{$d->id}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($dimensionResults as $dimensionResult)
                    <tr>
                        <td>{{ $dimensionResult->response_id }}</td>
                        <td>{{ $dimensionResult->user_id }}</td>
                        @foreach ($dimensions as $d)
                            <td>{{round(\App\Models\DimensionResult::where("response_id", "=", $dimensionResult->response_id)->where("dimension_id", "=", $d->id)->first()->corruption_index,2)}}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
