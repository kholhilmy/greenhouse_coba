
@extends('layouts.user_type.auth')

@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete to Manage !</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Data Threshold Tanaman</h5>
                        </div>
                        <a href="{{ route('jenis_tanaman.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Plant</a>
                        
                    
                    </div>
                    <div class="d-flex flex-row justify-content-between">
                    
                    <button type="button" class="btn btn-primary" id="mqttButton1">
                    Publish Threshold
                    </button>
                    
                    
                    </div>
                    

                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Tanaman</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold Ketinggian </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold Suhu</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold Kelembapan</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold Cahaya</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold Ph</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Threshold TDS</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($jenisTanamans as $jenisTanaman)

                            @php
                                $wa = $jenisTanaman->greenhouses
                            @endphp

                            @if(auth())
                            
                                <tr>
                                    <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $jenisTanaman->id_jenis }}</p></td>
                                    <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $jenisTanaman->nama_jenis }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">Max : {{ $jenisTanaman->tmax_ketinggian }} Min : {{ $jenisTanaman->tmin_ketinggian }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $jenisTanaman->t_suhu }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $jenisTanaman->t_kelembapan }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $jenisTanaman->t_cahaya }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">Max : {{ $jenisTanaman->tmax_ph }} Min : {{ $jenisTanaman->tmin_ph }}</p></td>
                                    <td class="text-center"><p class="text-xs font-weight-bold mb-0">Max : {{ $jenisTanaman->tmax_tds }} Min : {{ $jenisTanaman->tmin_tds }}</p></td>
                                    <td class="text-center">
                                        <a href="{{ route('jenis_tanaman.edit', $jenisTanaman->id_jenis) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="fas fa-user-edit text-secondary"></i>
                                        </a>
                                        <form action="{{ route('jenis_tanaman.destroy', $jenisTanaman->id_jenis) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border:none;background:none;" data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                            </button>
                                        </form>
                                        <button type="button" class="mx-3 mqttButton" data-id="{{ $jenisTanaman->id_jenis }}" data-bs-toggle="tooltip" data-bs-original-title="Publish Threshold"  style="border:none;background:none;" id="mqttButton">
                                        <i class="cursor-pointer fas fa-upload text-secondary"></i>

                                        </button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    // Menggunakan event delegation untuk tombol yang bisa ada di dalam table
    $(document).on('click', '.mqttButton', function(){
        const id_jenis = $(this).data('id'); // Ambil id_jenis dari tombol yang diklik
        console.log('Button clicked');
        console.log('ID Jenis Tanaman:', id_jenis);

        // Fetch data from the database
        $.ajax({
            url: '/threshold-data/' + id_jenis, // Endpoint untuk mendapatkan data
            method: 'GET',    // Gunakan GET untuk mengambil data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Token CSRF untuk keamanan
            },
            success: function(data) {
                console.log('Data retrieved for ID ' + id_jenis + ':', data); // Log struktur data
                console.log('Type of data:', typeof data); // Cek tipe data

                // Pastikan data adalah objek, bukan array
                if (data && typeof data === 'object') {
                    var message = {
                        t_cahaya: data.t_cahaya.toString(),
                        t_kelembapan: data.t_kelembapan.toString(),
                        t_suhu: data.t_suhu.toString(),
                        tmax_ketinggian: data.tmax_ketinggian.toString(),
                        tmax_ph: data.tmax_ph.toString(),
                        tmax_tds: data.tmax_tds.toString(),
                        tmin_ketinggian: data.tmin_ketinggian.toString(),
                        tmin_ph: data.tmin_ph.toString(),
                        tmin_tds: data.tmin_tds.toString(),
                    };
                    console.log('Message to be published for ID ' + id_jenis + ':', message);

                    // Publish the message
                    $.ajax({
                        url: '/mqtt/publish',
                        method: 'POST',
                        data: {
                            topic: 'tombol/coba',
                            message: JSON.stringify(message) // Convert message ke JSON string
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            alert('Published successfully for ID ' + id_jenis);
                        },
                        error: function(response) {
                            alert('Failed to publish for ID ' + id_jenis);
                        }
                    });
                } else {
                    console.error('Data is not in expected format or is empty');
                    alert('Data is not in expected format or is empty'); // Berikan alert jika data tidak sesuai
                }
            },
            error: function() {
                alert('Failed to retrieve data');
            }
        });
    });
});
</script>

<!-- <script>
$(document).ready(function(){
    $('#mqttButton').click(function(){
        const id_jenis = $(this).data('id');// Ambil id_jenis dari tombol yang diklik
        console.log('Button clicked');
        console.log('ID Jenis Tanaman:', id_jenis);

        // Fetch data from the database
        $.ajax({
            url: '/threshold-data/' + id_jenis, // Your endpoint to get data
            method: 'GET',    // Change to GET to retrieve data
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Not necessary for GET requests typically
            },
            success: function(data) {
                console.log('Data retrieved for ID ' + id_jenis + ':', data);// Log the entire data structure
                console.log('Type of data:', typeof data); // Check the type of data

                // Verify the structure of the data
                // if (Array.isArray(data) && data.length > 0) {
                //     // console.log('First item in data:', data[0]); // Log the first item in the array
                //     // var message = data[0].id_jenis; // Change 'your_field' to the correct field
                //     var message = {
                //         t_cahaya: data.t_cahaya.toString(),
                //         t_kelembapan: data.t_kelembapan.toString(),
                //         t_suhu: data.t_suhu.toString(),
                //         tmax_ketinggian: data.tmax_ketinggian.toString(),
                //         tmax_ph: data.tmax_ph.toString(),
                //         tmax_tds: data.tmax_tds.toString(),
                //         tmin_ketinggian: data.tmin_ketinggian.toString(),
                //         tmin_ph: data.tmin_ph.toString(),
                //         tmin_tds: data.tmin_tds.toString(),

                //     };
                //     console.log('Message to be published for ID ' + id_jenis + ':', message);
                //     // console.log('Message to be published:', message);
                // } else {
                //     console.error('Data is not in expected format or is empty');
                //     var message = null; // Set to null to prevent publishing
                // }
                

                console.log('Type of message:', typeof message);
                
                // Now publish the message
                $.ajax({
                    url: '/mqtt/publish',
                    method: 'POST',
                    data: {
                        topic: 'tombol/coba',
                        message: JSON.stringify(message)
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        alert('Published successfully for ID ' + id_jenis);
                    },
                    error: function(response) {
                        alert('Failed to publish for ID ' + id_jenis);
                    }
                });
            },
            error: function() {
                alert('Failed to retrieve data');
            }
        });
    });
});

</script> -->
@endsection
