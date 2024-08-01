
@extends('layouts.user_type.auth')

@section('content')
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
