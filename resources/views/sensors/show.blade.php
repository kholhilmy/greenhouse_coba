<!-- resources/views/sensors/show.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Sensor Details</title>
</head>
<body>
    <h1>Sensor ID: {{ $sensor->id_sensor }}</h1>
    <p>Greenhouse: {{ $sensor->greenhouse->nama_greenhouse }}</p>
    <p>Suhu: {{ $sensor->suhu_data }}</p>
    <p>Kelembaban: {{ $sensor->kelem_data }}</p>
    <p>Cahaya: {{ $sensor->cahaya_data }}</p>
    <p>Ketinggian: {{ $sensor->ketinggian_data }}</p>
    <p>pH: {{ $sensor->ph_data }}</p>
    <p>TDS: {{ $sensor->tds_data }}</p>
</body>
</html>
