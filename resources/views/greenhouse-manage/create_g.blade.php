@extends('layouts.user_type.auth')

@section('content')


<div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Create Greenhouse') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('greenhouses.store') }}" method="POST" role="form text-left">
                    @csrf
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
                                <label for="nama_greenhouse" class="form-control-label">{{ __('Nama Greenhouse') }}</label>
                                <div class="@error('nama_greenhouse')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{ old('nama_greenhouse') }}" type="text" id="nama_greenhouse" name="nama_greenhouse">
                                        @error('nama_greenhouse')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id" class="form-control-label">{{ __('ID User') }}</label>
                                <div class="@error('id')border border-danger rounded-3 @enderror">
                                    <input class="form-control" value="{{auth()->user()->id }}" type="text" placeholder="" id="id" name="id">
                                        @error('id')
                                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nama_jenis" class="form-control-label">{{ __('Jenis Tanaman') }}</label>
                                <div class="@error('nama_jenis')border border-danger rounded-3 @enderror">
                                    <select class="form-control" id="nama_jenis" name="nama_jenis">
                                        <option value="">{{ __('Select Jenis Tanaman') }}</option>
                                        
                                        @foreach($jenisTanamans as $jenisTanaman)
                                        <option value="{{ $jenisTanaman->id_jenis }}" {{ old('nama_jenis') == $jenisTanaman->id_jenis ? 'selected' : '' }}>{{ $jenisTanaman->nama_jenis }}</option>
                                        @endforeach
                                    </select>
                                    @error('nama_jenis')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                
                                <label for="waktu_tanam" class="form-control-label">{{ __('Waktu Tanam') }}</label>
                                <div class="@error('waktu_tanam') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="date" placeholder="" id="waktu_tanam" name="waktu_tanam" value="{{ old('waktu_tanam') }}">
                                </div>
                            </div>
                        </div>
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
