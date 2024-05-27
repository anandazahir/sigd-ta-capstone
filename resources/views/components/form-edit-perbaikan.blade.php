<form data-id="{{ $id }}" method="POST" id="edit_form_perbaikan_{{$data->id}}" action="/transaksi/editperbaikan" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        {{--  <div class="col-lg-6 mb-3 form-group">
            <label for="estimator" class="form-label">Estimator</label>
            <select name="estimator" class="form-select" aria-label="Default select example" required>
                <option selected>Plih Opsi Ini</option>
                <option value="estimator 1">estimator 1</option>
                <option value="estimator 2">estimator 2</option>
            </select>
        </div>  --}}
        <div class="col-lg-6 mb-3 form-group">
            <label for="status pernikahan" class="form-label">
                <span>Repair</span>
                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
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
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan" placeholder="Jumlah Kerusakan" name="jumlah_perbaikan" required value="{{$data->jumlah_kerusakan}}">
            <input type="hidden" name="id_perbaikan" id="id_perbaikan" value="{{$data->id}}">
            <input type="hidden" name="id_penghubung" id="id_penghubung2" value="{{$data->penghubung_id}}">
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
                        <input class="form-control" type="text" name="lokasi_kerusakan[]" value="{{$item->lokasi_kerusakan}}">
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input class="form-control" type="text" name="komponen[]" value="{{$item->komponen}}">
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
                        <div class="input-group mb-3">
                            {{--  <span class="input-group-text">Rp.</span>  --}}
                            <input type="number" class="form-control" name="harga_kerusakan[]">
                            {{--  <span class="input-group-text">.00</span>  --}}
                        </div>
                    </td>
                    <td>
                        <input type="hidden" name="status_value[]" value="">
                        <select class="form-select" aria-label="Default select example" name="status[]" id="status_perbaikan">
                            <option selected disabled>Pilih Status</option>
                            <option value="fix">FIX</option>
                            <option value="damage">DAMAGE</option>
                        </select>
                    </td>
                    <td class="text-center">
                        <input type="hidden" value="{{ $item->foto_perbaikan }}" name="url_foto[]">
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 100%;">
                                <span class="input-group-text" style="height: fit-content; width: 20%;">Pilih File</span>
                                <label tabindex="0" class="form-control text-start p-1" style="height: 2.3rem; width: 80%;">
                                    <span class="file-name">{{ $item->foto_perbaikan_name }}</span>
                                    <input style="width: 20rem" type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="invisible" accept="image/png, image/jpeg, image/jpg" data-index="{{ $index }}" style="height: fit-content;">
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
        if ($("#" + formId).find("#jumlah_kerusakan").val() > 0) {
            $("#" + formId).find("#table_edit_perbaikan").show();
            $("#" + formId).find("#text-perbaikan-edit").show();
        } else {
            $("#" + formId).find("#table_edit_perbaikan").hide();
            $("#" + formId).find("#text-perbaikan-edit").hide();
        }
        $("#" + formId).find("#jumlah_kerusakan").on("change", function() {
            console.log("hai")
            var rowCount = parseInt($(this).val());
            var lengthTable = $("#" + formId).find("#table_edit_perbaikan tbody tr").length;
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
                            '<input type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                            '<input type="hidden" name="foto_perbaikan_name[]"/>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '</tr>');
                        $("#" + formId).find("#table_edit_perbaikan tbody").append(rowObject); // Append new rows
                    }
                    $("#" + formId).find('#foto_perbaikan').on('change', function() {
                        // Get the selected file name
                        var fileName = $(this).val().split('\\').pop();
                        if (fileName === '') {
                            fileName = 'No file chosen';
                        }
                        // Update the label with the selected file name
                        $(this).siblings('input[type="hidden"]').val(fileName);
                        $(this).siblings('.file-name').text(fileName);
                    });
                    $("#" + formId).find('#metode').on('change', function() {
                        // Get the selected file name
                        var selectedOptionval = $(this).find('option:selected').val();
                        console.log(selectedOptionval);
                        // Update the label with the selected file name
                        $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                    });
                    $("#" + formId).find('#status_perbaikan').on('change', function() {
                        // Get the selected file name
                        var selectedOptionval = $(this).find('option:selected').val();
                        console.log(selectedOptionval);
                        // Update the label with the selected file name
                        $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                    });
                } else if (rowCount < lengthTable) { // This is the corrected part
                    for (var i = 0; i < (lengthTable - rowCount); i++) {
                        $("#" + formId).find("#table_edit_perbaikan tbody tr:last-child").remove();
                    }
                }
                $("#" + formId).find("#table_edit_perbaikan").show();
                $("#" + formId).find("#text-perbaikan-edit").show();
            } else {
                $("#" + formId).find("#table_edit_perbaikan").hide();
                $("#" + formId).find("#text-perbaikan-edit").hide();
                $("#" + formId).find("#table_edit_perbaikan tbody").empty();
            }
            jumlah_kerusakan3_value = $(this).val();
        });
        $("#" + formId).find('#foto_perbaikan').on('change', function() {
            // Get the selected file name
            var fileName = $(this).val().split('\\').pop();
            if (fileName === '') {
                fileName = 'No file chosen';
            }
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(fileName);
            $(this).siblings('.file-name').text(fileName);
        });
        $("#" + formId).find('#metode').on('change', function() {
            // Get the selected file name
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
        });
        $("#" + formId).find('#status_perbaikan').on('change', function() {
            // Get the selected file name
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
        });
        console.log( $("#" + formId).find('#status_perbaikan').length);
        /*$form.submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            var formData = new FormData(this);
            var modalId = $(this).data('id');
            $.ajax({
                url: "", // Ganti dengan endpoint Anda
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
        });*/
    });
</script>
