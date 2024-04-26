<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pembayaran</h2>
        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">Metode</th>
                        <th scope="col" class="fw-semibold">Biaya</th>
                        <th scope="col" class="fw-semibold">Cetak Kwitansi</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @for($i=0;$i<10;$i++) <tr>
                        <td class="text-center">
                            555555
                        </td>
                        <td class="text-center">
                            40'FT'
                        </td>
                        <td class="text-center">
                            Transfer BCA
                        </td>
                        <td class="text-center">
                            20000
                        </td>
                        <td class="text-center">
                            <span class="bg-success text-white p-1 rounded-2 fs-6">SUDAH CETAK</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group gap-2 mx-auto">
                                <button class="btn btn-info text-white rounded-3" data-bs-toggle="modal" data-bs-target="#create-pembayaran"> <i class="fa-solid fa-pen-to-square fa-lg my-1"></i></button>
                            </div>
                        </td>
                        </tr>
                        @endfor
                </tbody>
            </table>
        </div>
    </div>
</div>