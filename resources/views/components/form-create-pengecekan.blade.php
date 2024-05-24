<form method="POST" id="create_form_pengecekan" action="{{ route('transaksi.storepengecekan', $data->id) }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no peti kemas" class="form-label">No Peti Kemas</label>
            <select name="id_penghubung" class="form-select" id="id_penghubung" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($data->penghubungs as $penghubung)
                @if (
                $penghubung->pembayaran->status_pembayaran === 'sudah lunas' &&
                $penghubung->pembayaran->status_cetak_spk === 'sudah cetak' &&
                $penghubung->pengecekan->survey_in === null)
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}">
                    {{ $penghubung->petikemas->no_petikemas }}
                </option>
                @endif
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="jenis_ukuran_pengecekan" placeholder="Size & Type" name="jenis_ukuran_pengecekan" required readonly>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlahkerusakan2" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan2" required value="0">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <h5 id="text-between">List Kerusakan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_create_pengecekan">
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
    <button type="submit" class="btn btn-primary text-white">Submit</button>
</form>


<script>
    $(document).ready(function() {

        $("#table_create_pengecekan").hide();
        $("#text-between").hide();
        $("#jumlahkerusakan2").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#table_create_pengecekan").show();
                $("#text-between").show();
                $("#table_create_pengecekan tbody").empty();

                for (var i = 0; i < rowCount; i++) {
                    let rowObject = $('<tr>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text" name="lokasi_kerusakan[]"> ' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text" name="komponen[]"> ' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input type="hidden" name="metode_value[]"/>' +
                        '<select class="form-select"  name="metodes[]">' +
                        '<option selected disabled>Open this select menu</option>' +
                        '<option value="1">One</option>' +
                        '<option value="2">Two</option>' +
                        '<option value="3">Three</option>' +
                        '</select>' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input type="hidden" name="foto_pengecekan_name[]">' +
                        '<input type="file" name="foto_pengecekan[]" id="" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '</tr>');
                    $("#table_create_pengecekan tbody").append(
                        rowObject); // Append new rows using rowObject as a template
                }
                $('input[type="file"][name="foto_pengecekan[]"]').on('change', function() {
                    // Get the selected file name
                    var fileName = $(this).val().split('\\').pop();
                    console.log(fileName);
                    // Update the label with the selected file name
                    $(this).siblings('input[type="hidden"]').val(fileName);
                });
                $('select[name="metodes[]"]').on('change', function() {
                    // Get the selected file name
                    var selectedOptionval = $(this).find('option:selected').val();
                    console.log(selectedOptionval);
                    // Update the label with the selected file name
                    $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                });
            } else {
                $("#table_create_pengecekan").hide();
                $("#table_create_pengecekan tbody").empty();
                $("#text-between").hide();
            }
        });

        $('#id_penghubung').change(function(e) {
            e.preventDefault();
            var selectedOption = $(this).find('option:selected');
            var jenisUkuran = selectedOption.data('jenis-ukuran');
            $('#jenis_ukuran_pengecekan').val(jenisUkuran || '');
        });


        $("#create_form_pengecekan").submit(function(
            event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            const selectedOption = $(
                "#id_penghubung option:selected"); // Select the selected option using jQuery
            if (selectedOption.length) {
                selectedOption.attr("data-submit-check", "sudah submit"); // Remove the selected option
            }

            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('transaksi.storepengecekan', $data->id) }}", // Ganti dengan endpoint Anda
                type: 'POST',
                data: formData,
                processData: false, // Mengatur false, karena kita menggunakan FormData
                contentType: false, // Mengatur false, karena kita menggunakan FormData
                success: function(response) {
                    // Handle response sukses
                    $('#create-pengecekan-modal').modal('hide');
                    showAlert(response.message);
                    console.log('Success:', response);
                },

                error: function(xhr, status, error) {
                    const errors = xhr.responseJSON.errors;
                    if (xhr.status === 500) {
                        alert("Kolom Unik Tidak Boleh Sama!")
                    } else if (xhr.status === 404) {
                        alert("Data Tidak Ditemukan!");
                    }

                    $('#create_form_pengecekan').find('.is-invalid').removeClass('is-invalid');
                    $('#create_form_pengecekan').find('.invalid-feedback').text('');

                    $.each(errors, function(key, value) {
                        const element = $('#create_form_pengecekan').find('[name="' + key + '"]');


                        var cleanInputName = key.replace(/\.\d+/g, '');
                        var cleanAngka = value[0].replace(/\.\d+/g, '');
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').text(value[0]);
                        console.log(key + '[]');
                        const elementArray = $('#create_form_pengecekan').find('[name="' + cleanInputName + '[]"]');
                        elementArray.addClass('is-invalid');
                        elementArray.next('.invalid-feedback').text(cleanAngka);
                    });

                }
            });
        });

    });
</script>