<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Penempatan</h2>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" data-bs-toggle="modal" data-bs-target="#create-penempatan">
                <div class="d-flex gap-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah lokasi baru">
                    <i class="fa-solid fa-circle-plus text-white fa-xl" style="margin-top:11px"></i>
                    <span class="fw-semibold fs-6">Tambah Lokasi Baru</span>

                </div>
            </button>
        </div>

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
                        @if ($penghubung->perbaikan->tally)
                        <th scope="col" class="fw-semibold">Tanggal Penempatan</th>
                        <th scope="col" class="fw-semibold">Tally</th>
                        <th scope="col" class="fw-semibold">Operator Berat</th>
                        <th scope="col"></th>
                        @break
                        @endif
                        @endforeach
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
                            <span class="{{ $penghubung->petikemas->lokasi == 'pending' ? 'bg-warning' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{$penghubung->petikemas->lokasi}}
                            </span>
                        </td>
                        <td>
                            <span class="{{ $penghubung->petikemas->status_ketersediaan == 'in' ? 'bg-success' : 'bg-danger' }} p-1 rounded-2 text-white">
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
                        <td class="text-center">
                            <div class="btn-group gap-2 mx-auto">
                                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data penempatan">
                                    <button class="btn btn-info text-white rounded-3" data-bs-toggle="modal" data-bs-target="#edit-penempatan"> <i class="fa-solid fa-pen-to-square fa-lg my-1"></i></button>
                                </div>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-modal-form size="modal-xl" text="Form Penempatan" id="create-penempatan">
    <x-form-create-penempatan :data="$data" />
</x-modal-form>