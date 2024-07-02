@php
$semuaBelumCetak = true;
foreach($data->penghubungs as $penghubung) {
if(($data->jenis_kegiatan == "ekspor" && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak') || ($data->jenis_kegiatan == "impor" && $penghubung->pengecekan->survey_in && $penghubung->petikemas->status_kondisi == "available")) {
$semuaBelumCetak = false;
break;
}
}
@endphp
<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class="container">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Penempatan</h2>
        </div>

        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">

            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">Data Penempatan Belum Lunas / Cetak SPK</h3>
            </div>
            @endif

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
                                {{ strtoupper($penghubung->petikemas->lokasi)}}
                            </span>
                        </td>
                        <td>
                            <span class="{{ $penghubung->petikemas->status_ketersediaan == 'in' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{ strtoupper($penghubung->petikemas->status_ketersediaan)}}
                            </span>
                        </td>
                        @if ($penghubung->penempatan->tally)
                        <td class="text-center">
                            {{$penghubung->penempatan->tanggal_penempatan}}
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 mx-auto" style="width:fit-content;">
                                @if (auth()->user()->foto)
                                    <img src="{{URL::asset('storage/'.auth()->user()->foto)}}" alt="" class="rounded-circle my-1" width="22" height="22">
                                @else
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="22" height="22" class="rounded-circle my-1">
                                    <title>user-solid-svg</title>
                                <style>
                                    .s1 {
                                    fill: #ffffff
                                    }
                                </style>
                                    <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
                                    <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                                </svg>
                                @endif
                                <span>{{$penghubung->penempatan->tally}}</span>
                            </div>

                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 text-center mx-auto" style="width:fit-content;">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="22" height="22" class="rounded-circle my-1">
                                    <title>user-solid-svg</title>
                                <style>
                                    .s1 {
                                    fill: #ffffff
                                    }
                                </style>
                                    <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
                                    <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                                </svg>
                                <span>{{$penghubung->penempatan->operator_alat_berat}}</span>
                            </div>
                        </td>
                        @endif
                        <td class="text-center">
                            <div class="btn-group gap-2 mx-auto">
                                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data penempatan">
                                    <button class="btn bg-primary  rounded-3" data-bs-toggle="modal" data-bs-target="#edit-penempatan-{{$penghubung->penempatan->id}}" value="{{$penghubung->penempatan->id}}" id="edit-button-penempatan"> <i class="fa-solid fa-pen-to-square fa-lg my-1 text-white"></i></button>
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
    <x-form-edit-penempatan :data="$item" jenis="{{$data->jenis_kegiatan}}" id="form-edit-penempatan-{{$item->penempatan->id}}" value="{{$item->penempatan->id}}" lokasi="{{$item->petikemas->lokasi}}" tally="{{$item->penempatan->tally}}" operator="{{$item->penempatan->operator_alat_berat}} " petikemas="{{$item->petikemas->id}}" :user="$user" />
</x-modal-form>
@endforeach