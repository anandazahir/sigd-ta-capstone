<x-layout>
    <x-slot:title>
        Peti Kemas | {{$petikemas->no_petikemas}}
        </x-slot>
        <x-data-petikemas :data="$petikemas" />
        <div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
            <div class=" container position-relative">
                <h2 class="text-white fw-semibold">Riwayat Pengecekan</h2>
                <form class="btn-light rounded-circle btn month-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
                    <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
                    <input type="month" name="" id="">
                </form>
                <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                    <table class="table-variations-3  text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                                <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                                <th scope="col" class="fw-semibold">LIST KERUSAKAN</th>

                                <th scope="col" class="fw-semibold">Kondisi</th>
                                <th scope="col" class="fw-semibold">Survey In</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petikemas->penghubungs as $penghubung)
                            <tr>
                                <td class="text-center m-0 p-0">
                                    {{$penghubung->pengecekan->tanggal_pengecekan}}
                                </td>
                                <td class="text-center">
                                    {{$penghubung->pengecekan->jumlah_kerusakan}}
                                </td>

                                <td class="text-center">
                                    <button class="btn btn-info mx-auto" id="button_listkerusakan_pengecekan" data-bs-toggle="modal" data-bs-target="#table-kerusakan-{{$penghubung->pengecekan->id}}"><span class="fs-semibold">LIST KERUSAKAN</span></button>
                                </td>

                                <td>
                                    <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-success' : 'bg-danger' }} p-1 rounded-2 text-white">
                                        {{$penghubung->petikemas->status_kondisi}}
                                    </span>
                                </td>
                                <td class="text-center d-flex gap-1">
                                    <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                                    <span>{{$penghubung->pengecekan->survey_in}}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
            <div class=" container position-relative">
                <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Perbaikan</h2>
                <form class="btn-light rounded-circle btn month-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
                    <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
                    <input type="month" name="" id="">
                </form>
                <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                    <table class="table-variations-3  text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">Tanggal Perbaikan</th>
                                <th scope="col" class="fw-semibold">Jumlah Perbaikan</th>
                                <th scope="col" class="fw-semibold">List Perbaikan</th>

                                <th scope="col" class="fw-semibold">Kondisi</th>
                                <th scope="col" class="fw-semibold">Repair</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($petikemas->penghubungs as $penghubung)
                            <tr>
                                <td class="text-center m-0 p-0">
                                    {{$penghubung->perbaikan->tanggal_perbaikan}}
                                </td>
                                <td class="text-center">
                                    {{$penghubung->perbaikan->jumlah_perbaikan}}
                                </td>

                                <td class="text-center">
                                    <a href="#" class="btn btn-info"><span class="fs-semibold">LIST PERBAIKAN</span></a>
                                </td>

                                <td>
                                    <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-success' : 'bg-danger' }} p-1 rounded-2 text-white">
                                        {{$penghubung->petikemas->status_kondisi}}
                                    </span>
                                </td>
                                <td class="text-center d-flex gap-1">
                                    <i class="fa-solid fa-circle-user text-primary my-1 fa-l d-none d-lg-block"></i>
                                    <span>{{$penghubung->perbaikan->repair}}</span>
                                </td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
            <div class=" container position-relative">

                <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Penempatan</h2>
                <form class="btn-light rounded-circle btn month-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
                    <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
                    <input type="month" name="" id="">
                </form>

                <div class="bg-white mt-4 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                    <table class="table-variations-3  text-center">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">Tanggal Penempatan</th>
                                <th scope="col" class="fw-semibold">Lokasi</th>
                                <th scope="col" class="fw-semibold">Tally</th>
                                <th scope="col" class="fw-semibold">Operator Berat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    31-01-2024:10:00:00
                                </td>
                                <td class="text-center">
                                    <span class="bg-success text-white p-1 rounded-2">A0-01-01</span>
                                </td>
                                <td class="text-center d-flex gap-1 justify-content-center">
                                    <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                                    <span>Tally 1</span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex gap-1 justify-content-center">
                                        <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                                        <span>Rizal Firdaus</span>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-layout>

@foreach ($petikemas->penghubungs as $penghubung)
<x-table-kerusakan :data="$penghubung->pengecekan" id="table-kerusakan-{{$penghubung->pengecekan->id}}" text="List Kerusakan | {{$penghubung->petikemas->no_petikemas}}" petikemas="{{$penghubung->petikemas->id}}" />
@endforeach