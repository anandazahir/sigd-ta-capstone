<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold">Pengajuan</h1>
        <a href="" class="btn btn-info mb-2 mb-lg-0" style="width: fit-content;">
            <img src="{{ URL('assets/tambah.svg')}}" alt="">
            <span class="fs-5 fw-semibold">Tambah Transaksi</span>
        </a>
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

        <div class="bg-white mt-3 p-2 rounded-4 shadow scroll" style="height: 30rem;">
            <table class="table-variations-3 table-responsive text-center">
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
                            <button class="btn btn-info rounded-3 d-flex p-1 mx-auto my-2" style="width: fit-content;">
                                <img src="{{ URL('assets/pdf.svg')}}" alt="" width="15" height="15" class="d-md-block d-none">
                                <span class="fw-normal text-white mx-2 " style="font-size: 1.4vh;">SURAT PENGAJUAN CUTI....</span>
                            </button>
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