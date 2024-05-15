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
    <div class=" container ">
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pembayaran</h2>
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