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
                                                <!-- Edit Button to trigger Modal for Greenhouse -->
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
                                                
                                                <!-- Button to trigger the Periode Tanam Modal -->
                                                <a href="javascript:void(0)" class="mx-3" data-bs-toggle="modal" data-bs-target="#periodeTanamModal{{ $greenhouse->id_greenhouse }}" data-bs-original-title="Manage Periode Tanam">
                                                    <i class="fas fa-calendar text-secondary"></i>
                                                </a>
                                                
                                                
                                                <!-- View Periode Tanam Button (opens the modal) -->
                                                <!-- Dropdown for View Periode Tanam -->
                                                <div class="dropdown">
                                                    <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                        View Periode Tanam
                                                    </button>
                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 900px; padding: 15px 15px; font-size: 10px;">
                                                        <div class="d-flex justify-content-between flex-wrap" style="font-size: 5px;">
                                                            <p>ID</p>
                                                            <p>Tanggal Tanam</p>
                                                            <p>Tanggal Panen</p>
                                                            <p>Keterangan</p>
                                                            <p>Edit</p>
                                                            <p>Delete</p>
                                                        </div>
                                                        @foreach($greenhouse->periodeTanam as $periode)
                                                            <div class="d-flex justify-content-between flex-wrap" style="font-size: 5px;">
                                                                <p>{{ $periode->id }}</p>
                                                                <p>{{ $periode->tanggal_tanam }}</p>
                                                                <p>{{ $periode->tanggal_panen ?? 'Not set' }}</p>
                                                                <p>{{ $periode->keterangan ?? 'No description' }}</p>
                                                                <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editPeriodeTanamModal{{ $periode->id }}">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                                <form action="{{ route('periode-tanam.destroy', $periode->id) }}" method="POST" style="display:inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger btn-sm" style="border:none; background:red;">
                                                                        <i class="fas fa-trash"></i> Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <hr>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                            </td>
                                        </tr>

                                        <!-- Modal for Managing Periode Tanam -->
                                        <div class="modal fade" id="periodeTanamModal{{ $greenhouse->id_greenhouse }}" tabindex="-1" aria-labelledby="periodeTanamModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="periodeTanamModalLabel">Periode Tanam - {{ $greenhouse->nama_greenhouse }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('periode-tanam.store', $greenhouse->id_greenhouse) }}" method="POST">
                                                        @csrf
                                                        
                                                        <div class="mb-3">
                                                            <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                                                            <input type="date" class="form-control" id="tanggal_tanam" name="tanggal_tanam" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="tanggal_panen" class="form-label">Tanggal Panen (optional)</label>
                                                            <input type="date" class="form-control" id="tanggal_panen" name="tanggal_panen">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="keterangan" class="form-label">Keterangan (optional)</label>
                                                            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save Periode Tanam</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Modal for Editing Periode Tanam -->
                                        @isset($periode)
                                            <div class="modal fade" id="editPeriodeTanamModal{{ $periode->id }}" tabindex="-1" aria-labelledby="editPeriodeTanamModalLabel{{ $periode->id }}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPeriodeTanamModalLabel{{ $periode->id }}">Edit Periode Tanam</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form action="{{ route('periode-tanam.update', $periode->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label for="tanggal_tanam" class="form-label">Tanggal Tanam</label>
                                                                    <input type="date" class="form-control" id="tanggal_tanam" name="tanggal_tanam" value="{{ old('tanggal_tanam', $periode->tanggal_tanam) }}" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="tanggal_panen" class="form-label">Tanggal Panen (optional)</label>
                                                                    <input type="date" class="form-control" id="tanggal_panen" name="tanggal_panen" value="{{ old('tanggal_panen', $periode->tanggal_panen) }}">
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="keterangan" class="form-label">Keterangan (optional)</label>
                                                                    <textarea class="form-control" id="keterangan" name="keterangan">{{ old('keterangan', $periode->keterangan) }}</textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save Periode Tanam</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <p>Periode Tanam belum tersedia. Silakan buat periode tanam baru.</p>
                                        @endif

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
