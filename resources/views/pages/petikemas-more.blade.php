<x-layout>
    <x-slot:title>
        Peti Kemas | {{$petikemas->no_petikemas}}
        </x-slot>
        <x-data-petikemas :data="$petikemas" />
        <x-table-pengecekanhistory :data="$petikemas" />
        <x-table-perbaikanhistory :data="$petikemas" />

        <div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
            <div class=" container position-relative">

                <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Penempatan</h2>
                <form class="btn bg-white rounded-circle btn month-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
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
                                    <span class="bg-primary text-white p-1 rounded-2">A0-01-01</span>
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