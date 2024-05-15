<style>
    select.form-select:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
    }

    input.form-control:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
    }
</style>
<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class="container">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pembayaran</h2>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" style="width: fit-content;" id="button-edit2">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data">
                    <i class="fa-solid fa-pen-to-square text-white my-1" style="font-size:21px"></i>
                    <span class="fw-semibold fs-6 my-1">Edit Pembayaran</span>
                </div>
            </button>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" id="button-cetak2" style="width: fit-content; display:none;">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mencetak kwitansi">
                    <i class="fa-solid fa-circle-plus text-white my-2" style="font-size:25px"></i>
                    <span class="fw-semibold fs-6 my-2">Cetak Kwitansi</span>
                </div>
            </button>
        </div>

        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            <table class="table-variations-3 text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">Metode</th>
                        <th scope="col" class="fw-semibold">Biaya</th>
                        <th scope="col" class="fw-semibold" id="hide-tanggal">Tanggal Pembayaran</th>
                        <th scope="col" class="fw-semibold" id="hide-kwitansi">Cetak Kwitansi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">555555</td>
                        <td class="text-center">40'FT'</td>
                        <td class="text-center">
                            <select class="form-select mx-auto" name="metode" style="width: fit-content;" disabled>
                                <option value="Transfer BCA" selected>Transfer BCA</option>
                                <option value="Transfer Mandiri">Transfer Mandiri</option>
                                <option value="Cash">Cash</option>
                                <option value="Credit Card">Credit Card</option>
                            </select>
                        </td>
                        <td class="text-center">Rp. 20000,00</td>
                        <td class="text-center" id="tanggal_pembayaran">17-4-2024</td>
                        <td class="text-center" id="cetak-kwitansi">
                            <span class="bg-success text-white p-1 rounded-2 fs-6">SUDAH CETAK</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-success text-white rounded-3 mt-3" id="button-submit2" style="display:none;">
            Simpan Data
        </button>
    </div>
</div>

<script>
    $(document).ready(function() {
        const $button_edit = $("#button-edit2");
        const $button_cetak = $("#button-cetak2");
        const $button_submit = $("#button-submit2");
        const $select_metode = $('select[name="metode"]');
        const $cetak_kwitansi = $('#cetak-kwitansi');
        const $tanggal_pembayaran = $('#tanggal_pembayaran');
        const $hide_kwitansiheader = $('#hide-kwitansi');
        const $hide_tanggalheader = $('#hide-tanggal');

        $button_edit.on("click", function(e) {
            e.preventDefault();
            $select_metode.prop("disabled", false);
            $button_edit.hide();
            $button_cetak.show();
            $button_submit.show();
            $cetak_kwitansi.hide();
            $tanggal_pembayaran.hide();
            $hide_kwitansiheader.hide();
            $hide_tanggalheader.hide();
        });

        $button_cetak.on("click", function(e) {
            e.preventDefault();
            // Tambahkan logika untuk mencetak kwitansi di sini
            $select_metode.prop("disabled", true);
            $button_cetak.hide();
            $button_edit.show();
            $button_submit.hide();
            $cetak_kwitansi.show();
            $tanggal_pembayaran.show();
            $hide_kwitansiheader.show();
            $hide_tanggalheader.show();
        });

        $button_submit.on("click", function(e) {
            e.preventDefault();
            // Tambahkan logika untuk menyimpan data di sini
            alert('Data berhasil disimpan');
            $select_metode.prop("disabled", true);
            $button_cetak.hide();
            $button_edit.show();
            $button_submit.hide();
            $cetak_kwitansi.show();
            $tanggal_pembayaran.show();
            $hide_kwitansiheader.show();
            $hide_tanggalheader.show();
        });
    });
</script>