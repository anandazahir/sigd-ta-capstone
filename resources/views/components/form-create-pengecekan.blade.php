<form method="POST" id="create_form_pengecekan" action="{{ route('transaksi.storepengecekan', $data->id) }}">
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no peti kemas" class="form-label">No Peti Kemas</label>
            <select name="id_penghubung" class="form-select" id="id_penghubung" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($data->penghubungs as $penghubung)
                @if($penghubung->pembayaran->status_pembayaran === 'sudah lunas' && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak' && $penghubung->pengecekan->survey_in === null)
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}">{{ $penghubung->petikemas->no_petikemas }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="jenis_ukuran_pengecekan" placeholder="Size & Type" name="jenis_ukuran_pengecekan" required readonly>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlahkerusakan2" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan2" required value="0">
        </div>
    </div>
    <h5 id="text-between">List Kerusakan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="myTable2">
            <thead>
                <tr>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Component</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Foto Pengecekan</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
</form>


<script>
    $(document).ready(function() {

        $("#myTable2").hide();
        $("#text-between").hide();
        $("#jumlahkerusakan2").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#myTable2").show();
                $("#text-between").show();
                $("#myTable2 tbody").empty();

                for (var i = 0; i < rowCount; i++) {
                    let rowObject = $('<tr>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text">' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text">' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<select class="form-select" aria-label="Default select example">' +
                        '<option selected>Open this select menu</option>' +
                        '<option value="1">One</option>' +
                        '<option value="2">Two</option>' +
                        '<option value="3">Three</option>' +
                        '</select>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input type="file" name="foto_pengecekan_' + (i + 1) +
                        '" id="" class="form-control">' +
                        '</td>' +
                        '</tr>');
                    $("#myTable2 tbody").append(rowObject); // Append new rows using rowObject as a template
                }


            } else {
                $("#myTable2").hide();
                $("#myTable2 tbody").empty();
                $("#text-between").hide();
            }
        });

        $('#id_penghubung').change(function(e) {
            e.preventDefault();
            var selectedOption = $(this).find('option:selected');
            var jenisUkuran = selectedOption.data('jenis-ukuran');
            $('#jenis_ukuran_pengecekan').val(jenisUkuran || '');
        });

        $("#create_pengecekan_form").submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            const selectedOption = $("#id_penghubung option:selected"); // Select the selected option using jQuery
            if (selectedOption.length) {
                selectedOption.attr("data-submit-check", "sudah submit"); // Remove the selected option
            }
        });
    });
</script>