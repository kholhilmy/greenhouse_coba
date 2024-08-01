@extends('layouts.user_type.auth')

@section('content')


<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Plant') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('jenis_tanaman.update', $jenisTanaman->id_jenis) }}" method="POST" role="form text-left">
                    @csrf
                    @method('PUT')
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_jenis" class="form-control-label">{{ __('Nama Tanaman') }}</label>
                                <div class="@error('nama_jenis')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('nama_jenis', $jenisTanaman->nama_jenis) }}" type="text" id="nama_jenis" name="nama_jenis">
                                        @error('nama_jenis')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="id" class="form-control-label">{{ __('ID Greenhouse') }}</label>
                                <div class="@error('id')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('id_greenhouse') }}" type="text" placeholder="" id="id" name="id">
                                        @error('id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div> -->
                        
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmax_ph" class="form-control-label">{{ __('Threshold Max PH') }}</label>
                                <div class="@error('tmax_ph')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmax_ph" name="tmax_ph" value="{{ old('tmax_ph', $jenisTanaman->tmax_ph) }}">
                                        @error('tmax_ph')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmin_ph" class="form-control-label">{{ __('Threshold Min PH') }}</label>
                                <div class="@error('tmin_ph')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmin_ph" name="tmin_ph" value="{{ old('tmin_ph', $jenisTanaman->tmin_ph) }}">
                                        @error('tmin_ph')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="t_suhu" class="form-control-label">{{ __('Threshold Suhu') }}</label>
                                <div class="@error('t_suhu')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="t_suhu" name="t_suhu" value="{{ old('t_suhu', $jenisTanaman->t_suhu) }}">
                                        @error('t_suhu')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="t_cahaya" class="form-control-label">{{ __('Threshold Cahaya') }}</label>
                                <div class="@error('t_cahaya')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="t_cahaya" name="t_cahaya" value="{{ old('t_cahaya', $jenisTanaman->t_cahaya) }}">
                                        @error('t_cahaya')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="t_kelembapan" class="form-control-label">{{ __('Threshold Max Kelembapan') }}</label>
                                <div class="@error('t_kelembapan')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="t_kelembapan" name="t_kelembapan" value="{{ old('t_kelembapan', $jenisTanaman->t_kelembapan) }}">
                                        @error('t_kelembapan')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmax_ketinggian" class="form-control-label">{{ __('Threshold Max Ketinggian') }}</label>
                                <div class="@error('tmax_ketinggian')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmax_ketinggian" name="tmax_ketinggian" value="{{ old('tmax_ketinggian', $jenisTanaman->tmax_ketinggian) }}">
                                        @error('tmax_ketinggian')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmin_ketinggian" class="form-control-label">{{ __('Threshold Min Ketinggian') }}</label>
                                <div class="@error('tmin_ketinggian')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmin_ketinggian" name="tmin_ketinggian" value="{{ old('tmin_ketinggian', $jenisTanaman->tmin_ketinggian) }}">
                                        @error('tmin_ketinggian')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmax_tds" class="form-control-label">{{ __('Threshold Max Nutrisi') }}</label>
                                <div class="@error('tmax_tds')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmax_tds" name="tmax_tds" value="{{ old('tmax_tds', $jenisTanaman->tmax_tds) }}">
                                        @error('tmax_tds')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tmin_tds" class="form-control-label">{{ __('Threshold Min Nutrisi') }}</label>
                                <div class="@error('tmin_tds')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="tmin_tds" name="tmin_tds" value="{{ old('tmin_tds', $jenisTanaman->tmin_tds) }}">
                                        @error('tmin_tds')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>



                        <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_jenis" class="form-control-label">{{ __('Nama Jenis Tanaman') }}</label>
                                <div class="@error('jenis_tanaman')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="" id="nama_jenis" name="nama_jenis" value="{{ old('nama_jenis') }}">
                                        @error('nama_jenis')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div> -->

                    
                    </div>
                    <!-- <div class="form-group">
                        <label for="about">{{ 'About Me' }}</label>
                        <div class="@error('user.about')border border-danger rounded-3 @enderror">
                            <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                        </div>
                    </div> -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection




<!-- <!DOCTYPE html>
<html>
<head>
    <title>Create New Greenhouse</title>
</head>
<body>
    <h1>Create New Greenhouse</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="/greenhouse-manage" method="POST">
        @csrf
        <div>
            <label for="nama_greenhouse">Name:</label>
            <input type="text" id="nama_greenhouse" name="nama_greenhouse" value="{{ old('nama_greenhouse') }}">
        </div>
        <div>
            <label for="id">Id User:</label>
            <input type="text" id="id" name="id" value="{{auth()->user()->id }}">
        </div>
        <div>
            <label for="jenis_tanaman">Type of Plant:</label>
            <input type="text" id="jenis_tanaman" name="jenis_tanaman" value="{{ old('jenis_tanaman') }}">
        </div>
        <div>
            <label for="waktu_tanam">Planting Date:</label>
            <input type="date" id="waktu_tanam" name="waktu_tanam" value="{{ old('waktu_tanam') }}">
        </div>
        <div>
            <button type="submit">Create Greenhouse</button>
        </div>
    </form>
</body>
</html> -->
