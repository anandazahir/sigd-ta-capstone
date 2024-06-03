<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container position-relative">
        <h2 class="text-white fw-semibold">Riwayat Pengecekan</h2>
        <div class="btn-light rounded-circle btn date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="">
        </div>
        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Survey In</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->pengecekanhistories as $penghubung)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{$penghubung->tanggal_pengecekan}}
                        </td>
                        <td class="text-center">
                            {{$penghubung->jumlah_kerusakan}}
                        </td>

                        <td class="text-center">
                            On progress
                            {{--  <button class="btn btn-info mx-auto" id="button_listkerusakan_pengecekan" data-bs-toggle="modal" data-bs-target="#table-kerusakan-{{$penghubung->pengecekan->id}}"><span class="fs-semibold">LIST KERUSAKAN</span></button>  --}}
                        </td>

                        <td>
                            <span class="{{ $penghubung->petikemas->status_kondisi == 'available' ? 'bg-success' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{$penghubung->petikemas->status_kondisi}}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-1">
                            <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                            <span>{{$penghubung->survey_in}}</span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>