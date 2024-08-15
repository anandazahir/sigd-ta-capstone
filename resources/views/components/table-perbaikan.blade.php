@php
$semuaBelumCetak = true;
$value = true;
$tanggal_perbaikan = true;
foreach($data->penghubungs as $penghubung) {
if($penghubung->perbaikan->jumlah_perbaikan > 0) {
$semuaBelumCetak = false;
break;
}
if($penghubung->perbaikan->repair ) {
$value = false;
break;
}
if($penghubung->perbaikan->tanggal_perbaikan) {
$tanggal_perbaikan = false;
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
                <h3 class="text-center">Semua Peti Kemas Dalam Kondisi Baik</h3>
            </div>
            @endif
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        @foreach ($data->penghubungs as $penghubung)
                        @if($penghubung->perbaikan->jumlah_perbaikan > 0)
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">List Perbaikan</th>
                        <th scope="col" class="fw-semibold">Jumlah Perbaikan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        @break
                        @endif
                        @endforeach
                        @foreach ($data->penghubungs as $penghubung)
                        @if ($penghubung->perbaikan->repair && $penghubung->perbaikan->jumlah_perbaikan > 0)
                        <th scope="col" class="fw-semibold">Repair</th>
                        @break
                        @endif
                        @endforeach
                        @foreach ($data->penghubungs as $penghubung)
                        @if ($penghubung->perbaikan->tanggal_perbaikan && $penghubung->perbaikan->jumlah_perbaikan > 0)
                        <th scope="col" class="fw-semibold">Tanggal Perbaikan</th>
                        @break
                        @endif
                        @endforeach
                        @foreach ($data->penghubungs as $penghubung)
                        @if($penghubung->perbaikan->jumlah_perbaikan > 0)
                        <th scope="col"></th>
                        @break
                        @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->penghubungs as $penghubung)
                    @if($penghubung->perbaikan->jumlah_perbaikan > 0)
                    <tr>
                        <td class="text-center">
                            {{$penghubung->petikemas->no_petikemas}}
                        </td>
                        <td class="text-center">
                            {{$penghubung->petikemas->jenis_ukuran}}
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Melihat detail kerusakan">
                                <button class="btn shadow bg-primary text-white mx-auto" id="button_listkerusakan_pengecekan" value="{{$penghubung->pengecekan->id}}" data-nopetikemas="{{$penghubung->petikemas->no_petikemas}}" data-bs-toggle="modal" data-bs-target="#table-perbaikan-{{$penghubung->pengecekan->id}}"><span class="fs-semibold">LIST KERUSAKAN</span></button>
                            </div>
                        </td>
                        <td class="text-center">
                            {{$penghubung->perbaikan->jumlah_perbaikan}}
                        </td>
                        <td>
                            <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{strtoupper($penghubung->petikemas->status_kondisi)}}
                            </span>
                        </td>
                        @if ($penghubung->perbaikan->repair)
                        <td class="text-center">
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
                                <span>{{$penghubung->perbaikan->repair}}</span>
                            </div>
                        </td>
                        @endif
                        @if ($penghubung->perbaikan->tanggal_perbaikan)
                        <td class="text-center">
                            {{$penghubung->perbaikan->tanggal_perbaikan}}
                        </td>
                        @endif
                        <td class="text-center">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data pengecekan">
                                <button class="btn shadow bg-primary text-white mx-auto" data-bs-toggle="modal" data-bs-target="#edit-perbaikan-modal-{{$penghubung->perbaikan->id}}" value="{{$penghubung->pengecekan->id}}" data-nopetikemas="{{$penghubung->petikemas->no_petikemas}}" data-id="{{ $penghubung->id }}" data-ajax="true">
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
<x-table-kerusakan test="true" :data="$penghubung->pengecekan" id="table-perbaikan-{{$penghubung->pengecekan->id}}" text="List Perbaikan | {{$penghubung->petikemas->no_petikemas}}" petikemas="{{$penghubung->petikemas->id}}" />
<x-modal-form size="modal-xl" id="edit-perbaikan-modal-{{$penghubung->perbaikan->id}}" text="Edit perbaikan | {{$penghubung->petikemas->no_petikemas}}">
    <x-form-edit-perbaikan :data="$penghubung->pengecekan" id="edit-perbaikan-modal-{{$penghubung->pengecekan->id}}" :perbaikan="$penghubung->perbaikan" :user="$user" />
</x-modal-form>
@endforeach