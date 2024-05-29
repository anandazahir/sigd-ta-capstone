<form data-id="{{ $id }}" method="POST" id="edit_form_perbaikan_{{ $data->id }}" action="/transaksi/editperbaikan" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="Repair" class="form-label">
                <span>Repair</span>
            </label>
            <select name="repair" class="form-select" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="repair 1">Repair 1</option>
                <option value="repair 2">Repair 2</option>
                <option value="repair 3">Repair 3</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan" placeholder="Jumlah Kerusakan" name="jumlah_perbaikan" required value="{{ $data->jumlah_kerusakan }}">
            <input type="hidden" name="id_perbaikan" id="id_perbaikan" value="{{ $data->id }}">
            <input type="hidden" name="id_penghubung" id="id_penghubung2" value="{{ $data->penghubung_id }}">
        </div>
    </div>

    <h5 id="text-perbaikan-edit">List Perbaikan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_edit_perbaikan">
            <thead>
                <tr>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Component</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Biaya</th>
                    <th scope="col">Status</th>
                    <th scope="col">Foto</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kerusakan as $index => $item)
                <tr>
                    <td class="text-center">
                        <input class="form-control" type="text" name="lokasi_kerusakan[]" value="{{ $item->lokasi_kerusakan }}">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input class="form-control" type="text" name="komponen[]" value="{{ $item->komponen }}">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="metode_value[]" value="{{ $item->metode }}">
                        <select class="form-select" aria-label="Default select example" name="metode[]" id="metode">
                            <option selected disabled>Pilih Metode</option>
                            <option value="1" {{ $item->metode == '1' ? 'selected' : '' }}>One</option>
                            <option value="2" {{ $item->metode == '2' ? 'selected' : '' }}>Two</option>
                            <option value="3" {{ $item->metode == '3' ? 'selected' : '' }}>Three</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="number" class="form-control" name="harga_kerusakan[]" placeholder="ex: 10000" value="{{ $item->harga }}">
                    </td>
                    <td>
                        <input type="hidden" name="status_value[]" value="{{$item->status}}">
                        <select class="form-select" aria-label="Default select example" name="status[]" id="status_perbaikan" value="{{ $item->status }}">
                            <option selected disabled>Pilih Status</option>
                            <option value="fix" {{ $item->status == 'fix' ? 'selected' : '' }}>FIX</option>
                            <option value="damage" {{ $item->status == 'damage' ? 'selected' : '' }}>DAMAGE</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <input type="hidden" value="{{ $item->foto_perbaikan }}" name="url_foto[]">
                        <div class="d-flex gap-2">
                            <div class="input-group">
                                <span class="input-group-text" style="height: fit-content;">Pilih File</span>
                                <label tabindex="0" class="form-control text-start p-1" style="height: 2.3rem;">
                                    <span class="file-name">{{ $item->foto_perbaikan_name ?? 'tidak ada file dipilih' }}</span>
                                    <input type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="invisible" accept="image/png, image/jpeg, image/jpg" style="height: fit-content;">
                                    <input type="hidden" name="foto_perbaikan_name[]" value="{{ $item->foto_perbaikan_name }}">
                                </label>
                            </div>
                            @if ($item->foto_perbaikan)
                            <a href="/storage/{{ $item->foto_perbaikan }}" target="_blank" class="bg-info p-2 rounded-2 text-white text-decoration-none my-auto" id="preview_{{ $index }}">Preview</a>
                            @endif
                        </div>
                        <div class="invalid-feedback"></div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <button type="submit" class="btn btn-primary text-white">Submit</button>
</form>
<script>
    $(document).ready(function() {
        let formId = "edit_form_perbaikan_{{$data->id}}";
        let $form = $("#" + formId);
        console.log($form);
        if ($form.find("#jumlah_kerusakan").val() > 0) {
            $form.find("#table_edit_perbaikan").show();
            $form.find("#text-perbaikan-edit").show();
        } else {
            $form.find("#table_edit_perbaikan").hide();
            $form.find("#text-perbaikan-edit").hide();
        }
        $form.find("#jumlah_kerusakan").on("change", function() {
            console.log("hai")
            var rowCount = parseInt($(this).val());
            var lengthTable = $form.find("#table_edit_perbaikan tbody tr").length;
            console.log(rowCount, lengthTable);
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
                            '<select class="form-select" aria-label="Default select example" name="metode[]" id="metode">' +
                            '<option selected disabled>Pilih Metode</option>' +
                            '<option value="1">One</option>' +
                            '<option value="2">Two</option>' +
                            '<option value="3">Three</option>' +
                            '</select>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<div class="input-group mb-3">' +
                            '<input type="number" class="form-control" name="harga_kerusakan[]">' +
                            '</div>' +
                            '</td>' +
                            '<td>' +
                            '<input type="hidden" name="status_value[]"/>' +
                            '<select class="form-select" aria-label="Default select example" name="status[]" id="status_perbaikan">' +
                            '<option selected disabled>Pilih Status</option>' +
                            '<option value="fix">FIX</option>' +
                            '<option value="damage">DAMAGE</option>' +
                            '</select>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<input type="hidden" name="foto_perbaikan_name[]"/>' +
                            '<input type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '</tr>');
                        $form.find("#table_edit_perbaikan tbody").append(rowObject); // Append new rows
                    }
                    $form.find("#table_edit_perbaikan tbody tr").each(function(index) {
                        let $metodeId = $(this).find('select[name="metode[]"]');
                        let $fotoPerbaikanId = $(this).find('input[name="foto_perbaikan[]"]');
                        let $statusId = $(this).find('select[name="status[]"]');

                        $fotoPerbaikanId.on('change', function() {
                            // Get the selected file name
                            var fileName = $(this).val().split('\\').pop();
                            if (fileName === '') {
                                fileName = 'No file chosen';
                            }
                            console.log($fotoPerbaikanId);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(fileName);
                            $(this).siblings('.file-name').text(fileName);
                        });
                        $metodeId.on('change', function() {
                            // Get the selected file name
                            var selectedOptionval = $(this).find('option:selected').val();
                            console.log(selectedOptionval);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                        });
                        $statusId.on('change', function() {
                            var selectedOptionval = $(this).find('option:selected').val();
                            console.log(selectedOptionval);
                            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                        });
                    });


                } else if (rowCount < lengthTable) {
                    for (var i = 0; i < (lengthTable - rowCount); i++) {
                        $form.find("#table_edit_perbaikan tbody tr:last-child").remove();
                    }
                }
                $form.find("#table_edit_perbaikan").show();
                $form.find("#text-perbaikan-edit").show();
            } else {
                $form.find("#table_edit_perbaikan").hide();
                $form.find("#text-perbaikan-edit").hide();
                $form.find("#table_edit_perbaikan tbody").empty();
            }
            jumlah_kerusakan3_value = $(this).val();
        });
        $form.find('input[name="foto_perbaikan[]"]').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName === '') {
                fileName = 'No file chosen';
            }
            $(this).siblings('input[type="hidden"]').val(fileName);
            $(this).siblings('.file-name').text(fileName);
        });
        $form.find('select[name="metode[]"]').on('change', function() {
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
        });
        $form.find('select[name="status[]"]').on('change', function() {
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
        });
        $form.submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            var formData = new FormData(this);
            var modalId = $(this).data('id');
            $.ajax({
                url: "{{ route('transaksi.editperbaikan') }}", // Ganti dengan endpoint Anda
                type: 'POST',
                data: formData,
                processData: false, // Mengatur false, karena kita menggunakan FormData
                contentType: false, // Mengatur false, karena kita menggunakan FormData
                success: function(response) {
                    // Handle response sukses
                    $('#' + modalId).modal('hide');
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

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.invalid-feedback').text('');

                    $.each(errors, function(key, value) {
                        const element = $form.find('[name="' + key + '"]');
                        var cleanInputName = key.replace(/\.\d+/g, '');
                        var cleanAngka = value[0].replace(/\.\d+/g, '');
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').text(value[0]);
                        console.log(key + '[]');
                        const elementArray = $form.find('[name="' + cleanInputName + '[]"]');
                        elementArray.addClass('is-invalid');
                        elementArray.next('.invalid-feedback').text(cleanAngka);
                    });

                }
            });
        });
    });
</script>