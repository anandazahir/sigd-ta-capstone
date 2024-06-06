<form method="POST" action="{{ route('transaksi.transaksistore') }}" id="create-transaksi-form" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
            <select class="form-select" id="jenis_kegiatan3" name="jenis_kegiatan" required>
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
            <input type="number" class="form-control" id="jumlah_petikemas" placeholder="Jumlah Peti Kemas" name="jumlah_petikemas" min="1" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-center" id="table_create_transaksi">
            <thead>
                <tr>
                    <th scope="col">No Peti Kemas</th>
                    <th scope="col">Jenis & Ukuran</th>
                    <th scope="col">Pelayaran</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn bg-primary text-white mb-3" style="width: fit-content; margin-left:15px;">Submit</button>
</form>

<script>
    $(document).ready(function() {
        // Declare the value3 variable at a broader scope so it's accessible
        let value3 = $("#jenis_kegiatan3").val();
        $("#table_create_transaksi").hide();

        $("#jenis_kegiatan3").on("change", function(e) {
            e.preventDefault();
            value3 = $(this).val();

            // Trigger change event for the #jumlah_petikemas field to update rows
            $("#jumlah_petikemas").trigger("change");
        });

        $("#jumlah_petikemas").on("change", function(e) {
            e.preventDefault();

            let rowCount = parseInt($(this).val());

            // Show or hide the table based on rowCount
            if (rowCount > 0) {
                $("#table_create_transaksi").show();
            } else {
                $("#table_create_transaksi").hide();
            }

            // Add or remove rows as necessary
            $("#table_create_transaksi tbody tr").each(function(index, row) {
                if (index >= rowCount) {
                    $(row).remove();
                }
            });

            // Add new rows if necessary
            for (let i = ($("#table_create_transaksi tbody tr").length); i < rowCount; i++) {
                const newRow = $('<tr>' +
                    '<td class="text-center">' +
                    '<select class="form-select" name="no_petikemas[]" required>' +
                    '<option selected disabled>Pilih Opsi Ini</option>' + // Add default option here
                    '</select>' +
                    '<div class="invalid-feedback"></div>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<input type="text" name="jenis_ukuran" required readonly value="" class="form-control">' +
                    '<div class="invalid-feedback"></div>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<input type="text" name="pelayaran" required readonly value="" class="form-control">' +
                    '<div class="invalid-feedback"></div>' +
                    '</td>' +
                    '</tr>');

                // Append the new row to the table body
                $("#table_create_transaksi tbody").append(newRow);

                // Fetch data for the new row
                fetchPetikemasOptions(newRow, newRow.find('select[name="no_petikemas[]"]').val(), value3);

                newRow.find('select[name="no_petikemas[]"]').on('change', function(e) {
                    var value = $(this).val();
                    fetchPetikemasOptions(newRow, value, value3);
                });
            }

        });

        $('#create-transaksi-form').submit(function(event) {
            handleFormSubmission(this);
        });

        function fetchPetikemasOptions($row, value, value2) {
            const $select = $row.find('select[name="no_petikemas[]"]');
            const $inputjenis_ukuran = $row.find('input[name="jenis_ukuran"]');
            const $inputpelayaran = $row.find('input[name="pelayaran"]');
            $.ajax({
                url: '/peti-kemas/index',
                type: 'GET',
                data: {
                    id: value,
                    jenis_transaksi: value2,
                },
                success: function(response) {
                    $.each(response.AllData, function(index, item) {
                        $select.append('<option value="' + item.id + '">' + item.no_petikemas + '</option>');
                    });
                    if (response.DataPetikemas) {
                        const item = response.DataPetikemas[0];
                        $inputjenis_ukuran.val(item.jenis_ukuran);
                        $inputpelayaran.val(item.pelayaran);
                    } else {
                        $inputjenis_ukuran.val('');
                        $inputpelayaran.val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>