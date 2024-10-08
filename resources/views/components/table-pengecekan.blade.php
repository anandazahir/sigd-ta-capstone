@php
$semuaBelumCetak = true;
foreach($data->penghubungs as $penghubung) {
if($penghubung->pengecekan->survey_in && $data->jenis_kegiatan === 'impor') {
$semuaBelumCetak = false;
break;
}
}
@endphp

<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pengecekan</h2>
            <button class="btn shadow bg-white  col-lg-2 mt-3 mt-lg-0" data-bs-toggle="modal" data-bs-target="#create-pengecekan-modal" style="width: fit-content; height: fit-content">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah data pengecekan">
                    <i class="fa-solid fa-circle-plus text-primary fa-xl mx-1" style="margin:10px;"></i>
                    <span class="fw-semibold fs-6 text-primary">Tambah Pengecekan</span>
                </div>
            </button>
        </div>

        <div class="bg-white mt-3 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">Data Peti Kemas Belum Dicek</h3>
            </div>
            @endif
            <table class="table-variations-3  text-center" id="table_pengecekan">
                <thead>
                    <tr>
                        @foreach ($data->penghubungs as $penghubung)
                        @if($penghubung->pembayaran->status_cetak_spk === 'sudah cetak' && $data->jenis_kegiatan === 'impor' && $penghubung->pengecekan->survey_in)
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        @break
                        @endif
                        @endforeach
                        @foreach ($data->penghubungs as $penghubung)
                        @if ($penghubung->pengecekan->survey_in)
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Survey In</th>
                        <th scope="col"></th>
                        @break
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->penghubungs as $penghubung)
                    @if($penghubung->pembayaran->status_pembayaran === 'sudah lunas' && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak' && $data->jenis_kegiatan === 'impor' && $penghubung->pengecekan->survey_in)
                    <tr>
                        <td class="text-center">
                            {{$penghubung->petikemas->no_petikemas}}
                        </td>
                        <td class="text-center">
                            {{$penghubung->petikemas->jenis_ukuran}}
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Melihat detail kerusakan">
                                <button class="btn shadow bg-primary mx-auto text-white" id="button_listkerusakan_pengecekan" data-bs-toggle="modal" data-bs-target="#table-kerusakan-{{$penghubung->pengecekan->id}}"><span class="fs-semibold">LIST KERUSAKAN</span></button>
                            </div>
                        </td>

                        @if ($penghubung->pengecekan->survey_in)
                        <td class="text-center">
                            {{$penghubung->pengecekan->jumlah_kerusakan}}
                        </td>
                        <td class="text-center m-0 p-0">
                            {{$penghubung->pengecekan->tanggal_pengecekan}}
                        </td>
                        <td>
                            <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{strtoupper($penghubung->petikemas->status_kondisi)}}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-1">
                            <div class="mx-auto d-flex gap-1">
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
                                <span>{{$penghubung->pengecekan->survey_in}}</span>
                            </div>

                        </td>
                        @can('mengelola transaksi')
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data pengecekan">
                                <button class="btn shadow bg-primary text-white mx-auto" data-bs-toggle="modal" data-bs-target="#edit-pengecekan-modal-{{$penghubung->pengecekan->id}}" id="edit_pengecekan_button">
                                    <i class="fa-solid fa-pen-to-square fa-lg my-1"></i>
                                </button>
                            </div>
                        </td>
                        @endcan()
                        @endif

                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<x-modal-form size="modal-xl" id="create-pengecekan-modal" text="Tambah Pengecekan">
    <x-form-create-pengecekan :data="$data" />
</x-modal-form>

@foreach ($data->penghubungs as $penghubung)
<x-table-kerusakan test="false" :data="$penghubung->pengecekan" id="table-kerusakan-{{$penghubung->pengecekan->id}}" text="List Kerusakan | {{$penghubung->petikemas->no_petikemas}}" petikemas="{{$penghubung->petikemas->id}}" />
@can('mengelola transaksi')
<x-modal-form size="modal-xl" id="edit-pengecekan-modal-{{$penghubung->pengecekan->id}}" text="Edit Pengecekan | {{$penghubung->petikemas->no_petikemas}}">
    <x-form-edit-pengecekan :data="$penghubung->pengecekan" id="edit-pengecekan-modal-{{$penghubung->pengecekan->id}}" :user="$user" />
</x-modal-form>
@endcan
@endforeach