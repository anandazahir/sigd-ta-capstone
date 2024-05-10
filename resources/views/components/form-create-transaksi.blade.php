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
                <tr>
                    <td class="text-center">
                        <select class="form-select" id="" name="no_petikemas[]" required>
                        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="text" name="jenis_ukuran" id="" required readonly value="" class="form-control">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="text" name="pelayaran" id="" required readonly value="" class="form-control">
                        <div class="invalid-feedback"></div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn btn-primary text-white mb-3" style="width: fit-content; margin-left:15px;">Submit</button>
</form>

<script>
    $(document).ready(function() {
        $("#table_create_transaksi").hide();
        $("#jumlah_petikemas").on("change", function(e) {
            e.preventDefault();
            let rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#table_create_transaksi").show();
                var firstRow = $("#table_create_transaksi tbody tr:first").clone();
                $("#table_create_transaksi tbody").empty();
                for (var i = 0; i < rowCount; i++) {
                    var newRow = firstRow.clone();
                    newRow.find('[id]').each(function() {
                        var name = $(this).attr('name').replace(/\[\s*\]/g, '');
                        $(this).attr('id', name + '_' + (i + 1));
                    });
                    $("#table_create_transaksi tbody").append(newRow);
                    newRow.find('#no_petikemas_' + (i + 1)).append('<option selected disabled>Pilih Opsi Ini</option>');
                    newRow.find('#no_petikemas_' + (i + 1)).on("change", function(e) {
                        e.preventDefault();
                        var $row = $(this).closest('tr');
                        fetchPetikemas($(this).val(), $row);
                    });
                    fetchPetikemas($("#no_petikemas_" + (i + 1)).val(), newRow);
                    $('#table_create_transaksi tbody tr').not(newRow).each(function() {
                        $(this).find('select[id^="no_petikemas"]').find('option[value="' + $("#no_petikemas_" + (i + 1)).val() + '"]').remove();
                    });
                }
            } else {
                $("#table_create_transaksi").hide();
            }
        });

        $('#create-transaksi-form').submit(function(event) {
            handleFormSubmission(this);
            event.preventDefault(); // Menghentikan pengiriman form secara default

            // Validasi data sebelum pengiriman
            var isValid = validateFormData();
            if (!isValid) {
                return; // Hentikan proses jika data tidak valid
            }

            // Lanjutkan dengan pengiriman form secara langsung
            this.submit();
        });

        function validateFormData() {
            // Lakukan validasi di sini
            var isValid = true;
            // Contoh validasi untuk mengecek kesamaan nilai no_petikemas
            var noPetikemasValues = [];
            $('select[name="no_petikemas[]"]').each(function() {
                var value = $(this).val();
                if (noPetikemasValues.indexOf(value) !== -1) {
                    isValid = false;
                    $(this).addClass('is-invalid'); // Tambahkan kelas is-invalid pada select
                    $(this).siblings('.invalid-feedback').show(); // Tampilkan pesan kesalahan yang sesuai
                    return false; // Hentikan iterasi jika ditemukan kesamaan
                } else {
                    $(this).removeClass('is-invalid'); // Hapus kelas is-invalid jika tidak ada kesalahan
                    $(this).siblings('.invalid-feedback').hide(); // Sembunyikan pesan kesalahan
                }
                noPetikemasValues.push(value);
            });
            return isValid;
        }        

        function fetchPetikemas(value, $row) {
            var $select = $row.find('select[id^="no_petikemas"]');
            var $inputjenis_ukuran = $row.find('input[id^="jenis_ukuran"]');
            var $inputpelayaran = $row.find('input[id^="pelayaran"]');
            $.ajax({
                url: '/peti-kemas/index',
                type: 'GET',
                data: {
                    id: value,
                },
                success: function(response) {
                    if ($row.index === 0) {
                        $select.append('<option selected disabled>Pilih Opsi Ini</option>');
                    }

                    $.each(response.Data, function(index, item) {
                        $select.append('<option value="' + item.id + '">' + item.no_petikemas + '</option>');
                    });
                    if ($select.find('option[value=""]').length !== response.count) {
                        var removeNum = $select.find('option[value=""]').length - response.count;
                        $select.find('option:last-child').prevAll().slice(0, removeNum).remove();
                    }

                    $.each(response.DataPetikemas, function(index, item) {
                        $inputjenis_ukuran.val(item.jenis_ukuran);
                        $inputpelayaran.val(item.pelayaran);
                    });
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    });
</script>