<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">

        <table class="table-variations-3  text-center">
            <thead>
                <tr>
                    @foreach ($data->penghubungs as $penghubung)
                    @if ($data->jenis_kegiatan == "ekspor" && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak')
                    <th scope="col" class="fw-semibold">No Peti Kemas</th>
                    <th scope="col" class="fw-semibold">Size & Type</th>
                    <th scope="col" class="fw-semibold">Lokasi</th>
                    <th scope="col" class="fw-semibold">Status Ketersediaan</th>
                    @break
                    @elseif ($data->jenis_kegiatan == "impor" && $penghubung->pengecekan->survey_in && $penghubung->petikemas->status_kondisi == "available")
                    <th scope="col" class="fw-semibold">No Peti Kemas</th>
                    <th scope="col" class="fw-semibold">Size & Type</th>
                    <th scope="col" class="fw-semibold">Lokasi</th>
                    <th scope="col" class="fw-semibold">Status Ketersediaan</th>
                    @break
                    @endif
                    @endforeach
                    @foreach ($data->penghubungs as $penghubung)
                    @if ($penghubung->penempatan->tally)
                    <th scope="col" class="fw-semibold">Tanggal Penempatan</th>
                    <th scope="col" class="fw-semibold">Tally</th>
                    <th scope="col" class="fw-semibold">Operator Berat</th>
                    @break
                    @endif
                    @endforeach
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->penghubungs as $penghubung)
                @if (($data->jenis_kegiatan == "ekspor" && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak') || ($data->jenis_kegiatan == "impor" && $penghubung->pengecekan->survey_in && $penghubung->petikemas->status_kondisi == "available"))
                <tr>

                    <td class="text-center">
                        {{$penghubung->petikemas->no_petikemas}}
                    </td>
                    <td class="text-center">
                        {{$penghubung->petikemas->jenis_ukuran}}
                    </td>
                    <td class="text-center">
                        <span class="{{ $penghubung->petikemas->lokasi == 'pending' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                            {{$penghubung->petikemas->lokasi}}
                        </span>
                    </td>
                    <td>
                        <span class="{{ $penghubung->petikemas->status_ketersediaan == 'in' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                            {{$penghubung->petikemas->status_ketersediaan}}
                        </span>
                    </td>
                    @if ($penghubung->penempatan->tally)
                    <td class="text-center">
                        {{$penghubung->penempatan->tanggal_penempatan}}
                    </td>
                    <td class="text-center d-flex gap-1">
                        <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                        <span>{{$penghubung->penempatan->tally}}</span>
                    </td>
                    <td class="text-center">
                        <div class="d-flex gap-1">
                            <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                            <span>{{$penghubung->penempatan->operator_alat_berat}}</span>
                        </div>
                    </td>
                    @endif
                    <td class="text-center">
                        <div class="btn-group gap-2 mx-auto">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data penempatan">
                                <button class="btn bg-primary  rounded-3" data-bs-toggle="modal" data-bs-target="#edit-penempatan-{{$penghubung->penempatan->id}}"> <i class="fa-solid fa-pen-to-square fa-lg my-1 text-white"></i></button>
                            </div>
                        </div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>
@foreach ($data->penghubungs as $item)
<x-modal-form size="modal-xl" text="Form Edit Penempatan" id="edit-penempatan-{{$item->penempatan->id}}">
    <x-form-edit-penempatan :data="$item" jenis="{{$data->jenis_kegiatan}}" id="form-edit-penempatan-{{$item->penempatan->id}}" />
</x-modal-form>
@endforeach