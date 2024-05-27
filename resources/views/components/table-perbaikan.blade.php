@php
$semuaBelumCetak = true;
foreach($data->penghubungs as $penghubung) {
if($penghubung->petikemas->status_kondisi === 'damage') {
$semuaBelumCetak = false;
break;
}
}
@endphp
<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Perbaikan</h2>


        <div class="bg-white mt-3 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">Data Peti Kemas Belum Lunas / Cetak SPK</h3>
            </div>
            @endif
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        @foreach ($data->penghubungs as $penghubung)
                        @if($penghubung->petikemas->status_kondisi === 'damage')
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        @break
                        @endif
                        @endforeach
                        @foreach ($data->penghubungs as $penghubung)
                        @if ($penghubung->perbaikan->repair)
                        <th scope="col" class="fw-semibold">Tanggal Perbaikan</th>
                        <th scope="col" class="fw-semibold">Repair</th>
                        @break
                        @endif
                        @endforeach
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->penghubungs as $penghubung)
                    @if($penghubung->pembayaran->status_pembayaran === 'sudah lunas' && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak' && $penghubung->petikemas->status_kondisi ==='damage')
                    <tr>
                        <td class="text-center">
                            {{$penghubung->petikemas->no_petikemas}}
                        </td>
                        <td class="text-center">
                            {{$penghubung->petikemas->jenis_ukuran}}
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Melihat detail kerusakan">
                                <button class="btn btn-info mx-auto" id="button_listkerusakan_pengecekan" value="{{$penghubung->pengecekan->id}}" data-nopetikemas="{{$penghubung->petikemas->no_petikemas}}" data-bs-toggle="modal" data-bs-target="#show-kerusakan"><span class="fs-semibold">LIST KERUSAKAN</span></button>
                            </div>
                        </td>
                        <td class="text-center">
                            {{$penghubung->pengecekan->jumlah_kerusakan}}
                        </td>
                        <td>
                            <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-success' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{$penghubung->petikemas->status_kondisi}}
                            </span>

                        </td>
                        @if ($penghubung->perbaikan->repair)

                        <td class="text-center m-0 p-0">
                            {{$penghubung->perbaikan->tanggal_perbaikan}}
                        </td>

                        <td class="text-center d-flex gap-1">
                            <div class="mx-auto d-flex gap-1">
                                <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                                <span>{{$penghubung->perbaikan->repair}}</span>
                            </div>

                        </td>
                        @endif
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data pengecekan">
                                <button class="btn btn-info mx-auto" data-bs-toggle="modal" data-bs-target="#edit-perbaikan-modal-{{$penghubung->perbaikan->id}}" value="{{$penghubung->pengecekan->id}}" data-nopetikemas="{{$penghubung->petikemas->no_petikemas}}" data-id="{{ $penghubung->id }}" data-ajax="true">
                                    <i class="fa-solid fa-pen-to-square fa-lg my-1"></i>
                                </button>
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
@foreach ($data->penghubungs as $penghubung)
<x-modal-form size="modal-xl" id="edit-perbaikan-modal-{{$penghubung->perbaikan->id}}" text="Edit perbaikan | {{$penghubung->petikemas->no_petikemas}}">
    <x-form-edit-perbaikan :data="$penghubung->pengecekan" id="edit-perbaikan-modal-{{$penghubung->pengecekan->id}}"/>
</x-modal-form>
@endforeach
