<!-- resources/views/sensors/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Sensors</title>
</head>
<body>
    <h1>Sensors</h1>
    <ul>
        @foreach($sensors as $sensor)
            <li>
                <a href="{{ route('sensors.show', ['id' => $sensor->id_sensor]) }}">Sensor ID: {{ $sensor->id_sensor }}</a>
                - Greenhouse: {{ $sensor->greenhouse->nama_greenhouse }}
            </li>
        @endforeach
    </ul>
</body>
</html>
