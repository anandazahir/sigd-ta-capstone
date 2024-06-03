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
                    @foreach($data->perbaikanhistories as $penghubung)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{$penghubung->tanggal_perbaikan}}
                        </td>
                        <td class="text-center">
                            {{$penghubung->jumlah_perbaikan}}
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
                            <span>{{$penghubung->repair}}</span>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>