<form method="POST" id="edit_form_pengecekan" action="{{ route('transaksi.editpengecekan') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="status pernikahan" class="form-label">
                <span>Survey In</span>
                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
            </label>
            <select name="survey_in2" class="form-select" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="survey in 1">Survey in 1</option>
                <option value="survey in 2">Survey in 2</option>
                <option value="survey in 3">Survey in 3</option>
                <option value="rizal">Rizal</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan3" required>
            <input type="hidden" name="id_pengecekan" id="id_pengecekan2">
            <input type="hidden" name="id_penghubung" id="id_penghubung2">
        </div>
    </div>
    <h5 id="text-kerusakan-edit">List Kerusakan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_edit_pengecekan">
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
        $(document).on('click', '#edit_pengecekan_button', function(e) {
            $("#table_edit_pengecekan tbody").empty();
            $('select[name="survey_in2"]').find('option[disabled]').prop('selected', true);
            $('input[name="jumlah_kerusakan3"]').val("");
            e.preventDefault();
            $("#id_pengecekan2").val($(this).val());
            $("#id_penghubung2").val($(this).data('id'));
            $("#edit-pengecekan-modal").find(".modal-title").text("Edit Pengecekan | No.Petikemas " + $(this).data("nopetikemas"));
            console.log($(this).val());
            $("#jumlah_kerusakan").on("change", function() {
                var rowCount = parseInt($(this).val());
                var lengthTable = $("#table_edit_pengecekan tbody tr").length;
                if (rowCount > 0) {
                    if (rowCount > lengthTable) {
                        for (var i = 0; i < (rowCount - lengthTable); i++) {
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
                                '<select class="form-select" aria-label="Default select example" name="metode[]">' +
                                '<option selected disabled>Open this select menu</option>' +
                                '<option value="1">One</option>' +
                                '<option value="2">Two</option>' +
                                '<option value="3">Three</option>' +
                                '</select>' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<input type="file" name="foto_pengecekan[]" id="foto_pengecekan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                                '<input type="hidden" name="foto_pengecekan_name[]"/>' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '</tr>');
                            $("#table_edit_pengecekan tbody").append(rowObject); // Append new rows
                        }
                        $('input[type="file"][name="foto_pengecekan[]"]').on('change', function() {
                            // Get the selected file name
                            var fileName = $(this).val().split('\\').pop();
                            if (fileName === '') {
                                fileName = 'No file chosen';
                            }
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(fileName);
                        });
                        $('select[name="metode[]"]').on('change', function() {
                            // Get the selected file name
                            var selectedOptionval = $(this).find('option:selected').val();
                            console.log(selectedOptionval);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                        });
                    } else if (rowCount < lengthTable) { // This is the corrected part
                        for (var i = 0; i < (lengthTable - rowCount); i++) {
                            $("#table_edit_pengecekan tbody tr:last-child").remove();
                        }
                    }
                    $("#table_edit_pengecekan").show();
                    $("#text-kerusakan-edit").show();
                } else {
                    $("#table_edit_pengecekan").hide();
                    $("#table_edit_pengecekan tbody").empty();
                    $("#text-kerusakan-edit").hide();
                }
                jumlah_kerusakan3_value = $(this).val();
            });

            console.log($(this).data('ajax'));


            $.ajax({
                url: '/transaksi/indexkerusakan',
                type: 'POST',
                data: {
                    id_pengecekan: $(this).val(),
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    $('select[name="survey_in2"]').find('option[value="' + response.pengecekan.survey_in + '"]').prop('selected', true);
                    $('input[name="jumlah_kerusakan3"]').val(response.pengecekan.jumlah_kerusakan);
                    if ($("#jumlah_kerusakan").val() > 0) {

                        $.each(response.kerusakan, function(index, item) {
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
                                '<input type="hidden" name="metode_value[]" value="' + item.metode + '"/>' +
                                '<select class="form-select" aria-label="Default select example" name="metode[]">' +

                                '<option selected disabled>Open this select menu</option>' +
                                '<option value="1">One</option>' +
                                '<option value="2">Two</option>' +
                                '<option value="3">Three</option>' +
                                '</select>' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<input type="hidden" value="' + item.foto_pengecekan + '" name="url_foto[]">' +
                                '<div class="d-flex gap-2">' +
                                ' <div class="input-group">' +
                                '<span class="input-group-text" style="height: fit-content">Pilih File</span>' +
                                '<label tabindex="0" class="form-control text-start" style="height:2.3rem">' +
                                '<span class="file-name">' + item.foto_pengecekan_name + '</span>' +
                                '<input type="file" name="foto_pengecekan[]" id="" class="invisible" accept="image/png, image/jpeg, image/jpg"  data-index="' + index + '" style="height:fit-content">' +
                                '<input type="hidden" name="foto_pengecekan_name[]" value="' + item.foto_pengecekan_name + '"/>' +
                                '</label>' +
                                '</div>' +
                                '<a href="/storage/' + item.foto_pengecekan + '" target="_blank" class="bg-info p-2 rounded-2 text-white text-decoration-none my-auto" id="preview_' + index + '">Preview</a>' +
                                '</div>' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '</tr>');
                            $(rowObject).find('input[name="lokasi_kerusakan[]"]').val(item.lokasi_kerusakan);
                            $(rowObject).find('input[name="komponen[]"]').val(item.komponen);
                            $(rowObject).find('select[name="metode[]"]').val(item.metode).find('option[value="' + item.metode + '"]').prop('selected', true);

                            $("#table_edit_pengecekan tbody").append(
                                rowObject);
                        });
                        $('input[type="file"][name="foto_pengecekan[]"]').on('change', function() {
                            // Get the selected file name
                            var fileName = $(this).val().split('\\').pop();
                            if (fileName === '') {
                                fileName = 'No file chosen';
                            }
                            // Update the label with the selected file name
                            $(this).siblings('.file-name').text(fileName);
                            $(this).siblings('input[type="hidden"]').val(fileName);
                        });
                        $('select[name="metode[]"]').on('change', function() {
                            // Get the selected file name
                            var selectedOptionval = $(this).find('option:selected').val();
                            console.log(selectedOptionval);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                        });

                    }

                },
                error: function(xhr, status, error) {
                    console.error(error);
                },
            });



            $("#edit_form_pengecekan").submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
                event.preventDefault();
                const selectedOption = $(
                    "#id_penghubung option:selected"); // Select the selected option using jQuery
                if (selectedOption.length) {
                    selectedOption.attr("data-submit-check", "sudah submit"); // Remove the selected option
                }

                var formData = new FormData(this);
                $.ajax({
                    url: "{{ route('transaksi.editpengecekan') }}", // Ganti dengan endpoint Anda
                    type: 'POST',
                    data: formData,
                    processData: false, // Mengatur false, karena kita menggunakan FormData
                    contentType: false, // Mengatur false, karena kita menggunakan FormData
                    success: function(response) {
                        // Handle response sukses
                        $('#edit-pengecekan-modal').modal('hide');
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

                        $('#edit_form_pengecekan').find('.is-invalid').removeClass('is-invalid');
                        $('#edit_form_pengecekan').find('.invalid-feedback').text('');

                        $.each(errors, function(key, value) {
                            const element = $('#edit_form_pengecekan').find('[name="' + key + '"]');


                            var cleanInputName = key.replace(/\.\d+/g, '');
                            var cleanAngka = value[0].replace(/\.\d+/g, '');
                            element.addClass('is-invalid');
                            element.next('.invalid-feedback').text(value[0]);
                            console.log(key + '[]');
                            const elementArray = $('#edit_form_pengecekan').find('[name="' + cleanInputName + '[]"]');
                            elementArray.addClass('is-invalid');
                            elementArray.next('.invalid-feedback').text(cleanAngka);
                        });

                    }
                });
            });
        });

    });
</script>