<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold">Pengajuan</h1>
        {{--tambah transaksi belom--}}
        <button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#create-pengajuan">
            <div class="d-flex gap-2">
                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                    <i class="fa-solid fa-plus text-info" style="font-size:17px;"></i>
                </div>
                <span class="fs-5 fw-semibold">Tambah Pengajuan</span>
            </div>
        </button>
        <div class="row mt-3">
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>Kenaikan Gaji</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>Cuti</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 30rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Jenis Pengajuan</th>
                        <th scope="col" class="fw-semibold">Tanggal Dibuat</th>
                        <th scope="col" class="fw-semibold">File</th>
                        <th scope="col" class="fw-semibold">Status</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            Kenaikan Gaji
                        </td>
                        <td class="text-center">
                            01 Desember 2022
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info rounded-3 d-flex p-1 mx-auto my-2 position-relative" style="width: fit-content; height:30px;">
                                <i class="fa-solid fa-file-pdf position-absolute my-2 my-lg-0" style="font-size:20px;"></i>
                                <span class="fw-normal text-white mx-lg-4 mx-2 " style="font-size: 1.4vh;">SURAT PENGAJUAN CUTI....</span>
                            </button>
                        </td>
                        <td class="text-center">
                            16.00
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info text-white rounded-3" data-bs-toggle="modal" data-bs-target="#edit-pengajuan"> <i class=" fa-solid fa-pen-to-square fa-lg my-1"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>