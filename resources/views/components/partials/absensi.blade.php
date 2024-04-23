<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold">Kehadiran | Desember</h1>

        <form class="btn-light rounded-circle btn month-picker p-2 position-absolute top-0 end-0" style="margin-right: 10px;">
            <img src="{{ URL('assets/date.svg')}}" alt="" width="25" height="25">
            <input type="month" name="" id="">
        </form>

        <div class="row mt-3">
            <div class="col-lg-4 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>IZIN</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>CUTI</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mt-lg-0 mt-3">
                <div class="card bg-danger  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-white position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-danger">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3 class="text-white">TERLAMBAT</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:white;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-lg-3 mt-0">
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-info  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-white position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-info">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3 class="text-white">IZIN</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:white;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-danger  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-white position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-danger">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3 class="text-white">TIDAK HADIR</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:white;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white mt-3 p-2 rounded-4 shadow scroll" style="height: 30rem;">
            <table class="table-variations-3 table-responsive text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Tanggal</th>
                        <th scope="col" class="fw-semibold">Waktu Masuk</th>
                        <th scope="col" class="fw-semibold">Keterangan</th>
                        <th scope="col" class="fw-semibold">Waktu Pulang</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            Senin, 01 Desember 2022
                        </td>
                        <td class="text-center">
                            07.45
                        </td>
                        <td class="text-center">
                            <span class="bg-success p-1 rounded-3 text-white">Absen</span>
                        </td>
                        <td class="text-center">
                            16.00
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info p-1 d-flex">
                                <img src="{{ URL('assets/edit.svg')}}" alt="" width="27" height="27"><span class="fw-semibold mx-1  fs-5 d-md-block d-none">EDIT</span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>