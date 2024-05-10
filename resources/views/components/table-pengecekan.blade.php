<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pengecekan</h2>
            <button class="btn btn-info p-0 col-lg-2 mt-3 mt-lg-0" data-bs-toggle="modal" data-bs-target="#create-pengecekan">
                <i class="fa-solid fa-circle-plus text-white fa-xl mx-1"></i>
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah data pengecekan">
                <span class="fw-semibold fs-6">Tambah Pengecekan</span>
            </button>
        </div>

        <div class="bg-white mt-3 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Survey In</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            555555
                        </td>
                        <td class="text-center">
                            40'FT'
                        </td>
                        <td class="text-center">
                            3
                        </td>

                        <td class="text-center">
                        <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Melihat detail kerusakan">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#show-kerusakan"><span class="fs-semibold">LIST KERUSAKAN</span></button>
                        </td>
                        <td class="text-center m-0 p-0">
                            01-11-2023 <br> 10:00:00
                        </td>
                        <td>
                            <span class="bg-danger p-1 rounded-2 text-white">Damage</span>
                        </td>
                        <td class="text-center d-flex gap-1">
                            <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>
                            <span>Survey In 1</span>
                        </td>
                        <td class="text-center">
                        <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data pengecekan">
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-pengecekan">
                            <i class="fa-solid fa-pen-to-square fa-lg my-1"></i></a>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>