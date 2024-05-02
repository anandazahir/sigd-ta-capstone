<form method="POST" action="{{ route('transaksi.entrydatastore') }}" id="create-transaksi-form" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select class="form-select" id="jenis_kegiatan" name="jenis_kegiatan" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="impor">Impor</option>
                <option value="ekspor">Ekspor</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="perusahaan" class="form-label">Perusahaan</label>
            <select class="form-select" id="perusahaan" name="perusahaan" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="PT Anugrah Mulia">PT Anugrah Mulia</option>
                <option value="PT B">PT B</option>
                <option value="PT C">PT C</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_do" class="form-label">No. DO</label>
            <input type="text" class="form-control" id="no_do" placeholder="No. DO" name="no_do" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_DO_rilis" class="form-label">Tanggal DO Rilis</label>
            <input type="date" class="form-control" id="tanggal_DO_rilis" name="tanggal_DO_rilis" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="cargo" class="form-label">Cargo:</label>
            <input type="text" class="form-control" id="kapl" placeholder="Cargo" name="kapal" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_DO_exp" class="form-label">Tanggal DO Expired</label>
            <input type="date" class="form-control" id="tanggal_DO_exp" name="tanggal_DO_exp" required>
        </div>
        <div class="invalid-feedback"></div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="emkl" class="form-label">EMKL</label>
            <select class="form-select" id="emkl" name="emkl" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="EMKL A">EMKL A</option>
                <option value="EMKL B">EMKL B</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="jumlah_petikemas" class="form-label">Jumlah Peti Kemas</label>
            <input type="number" min="0" class="form-control" id="jumlah_petikemas" placeholder="Jumlah Peti Kemas" name="jumlah_petikemas" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-center" id="table_entrydata">
            <thead>
                <tr>
                    <th scope="col">No Peti Kemas</th>
                    <th scope="col">Jenis & Ukuran</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">
                        <select class="form-select" name="no_petikemas" id="no_petikemas" required>
                            <option selected>Pilih Opsi Ini</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <input type="text" name="jenis_ukuran" id="jenis_ukuran" required readonly>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary text-white mb-3" style="width: fit-content; margin-left:15px;">Submit</button>
</form>
<script>
    $(document).ready(function() {
        $("#table_entrydata").hide();
        $("#jumlah_petikemas").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#table_entrydata").show();
                let rowData = $("#table_entrydata tbody tr:first").clone().html();
                $("#table_entrydata tbody").empty();
                for (var i = 0; i < rowCount; i++) {
                    $("#table_entrydata tbody").append("<tr>" + rowData + "</tr>"); // Append new rows using rowData as a template
                }
            } else {
                $("#table_entrydata").hide();
            }
        });
        $('#create-transaksi-form').submit(function(event) {
            handleFormSubmission(this);
        });
    });
</script>