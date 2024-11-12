
@extends('layouts.user_type.auth')

@section('content')
<div>
    <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white">
            <strong>Add, Edit, Delete to Manage Your Greenhouse!</strong>
        </span>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card mb-4 mx-4">
                <div class="card-header pb-0">
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <h5 class="mb-0">Your Greenhouse</h5>
                        </div>
                        <a href="{{ route('greenhouses.create') }}" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Greenhouse</a>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">User</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Greenhouse</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jenis Tanaman</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Tanam</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tinggi Penampung Air (cm) </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Creation Date</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($greenhouses as $greenhouse)
                                
                                    @if(auth()->user()->id == $greenhouse->user->id)
                                        <tr>
                                            <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->id_greenhouse }}</p></td>
                                            <td class="ps-4"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->user->name }}</p></td>
                                            <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->nama_greenhouse }}</p></td>
                                            <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->JenisTanaman->nama_jenis }}</p></td>
                                            <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->waktu_tanam }}</p></td>
                                            <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->tong }}</p></td>
                                            <td class="text-center"><p class="text-xs font-weight-bold mb-0">{{ $greenhouse->created_at }}</p></td>
                                            <td class="text-center">
                                                <a href="{{ route('greenhouses.edit', $greenhouse->id_greenhouse) }}" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                    <i class="fas fa-user-edit text-secondary"></i>
                                                </a>
                                                <form action="{{ route('greenhouses.destroy', $greenhouse->id_greenhouse) }}" method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="border:none;background:none;">
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </button>
                                                </form>
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
@endsection
