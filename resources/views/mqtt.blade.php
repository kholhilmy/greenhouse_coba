<!-- resources/views/mqtt.blade.php -->

@extends('layouts.user_type.auth')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3 mt-5">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="mqttToggle" checked="">
                <label class="form-check-label" for="mqttToggle">OFF / ON</label>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('#mqttToggle').change(function(){
        var isChecked = $(this).is(':checked');
        var message = isChecked ? 'ON' : 'OFF';

        $.ajax({
            url: '/mqtt/publish',
            method: 'POST',
            data: {
                topic: 'tombol/coba',
                message: message
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                alert(response.message);
            },
            error: function(response) {
                alert('Failed to publish message');
            }
        });
    });
});
</script>
@endsection
