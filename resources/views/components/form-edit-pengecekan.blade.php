@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" id="edit_form_pengecekan_{{$data->id}}" action="{{ route($cleaned.'.transaksi.editpengecekan') }}" enctype="multipart/form-data" novalidate data-id="{{$id}}">
    @csrf
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="Survey In" class="form-label">
                <span>Survey In</span>
                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
            </label>
            <select name="survey_in" class="form-select" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($user as $item )
                @if ($item->hasRole('surveyin'))
                <option value="{{$item->username}}" {{ $data->survey_in == $item->username ? 'selected' : '' }}>{{($item->username)}}</option>
                @endif
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan" required value="{{$data->jumlah_kerusakan}}">
            <div class="invalid-feedback"></div>
            <input type="hidden" name="id_pengecekan" id="id_pengecekan2" value="{{$data->id}}">
            <input type="hidden" name="id_penghubung" id="id_penghubung2" value="{{$data->penghubung_id}}">
        </div>

    </div>
    <h5 id="text-kerusakan-edit">List Kerusakan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_edit_pengecekan">
            <thead>
                <tr>
                    <th scope="col">Lokasi Kerusakan</th>
                    <th scope="col">Jenis Kerusakan</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Foto Pengecekan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data->kerusakan as $index => $item)
                @if ($item->status === "damage")
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
                        <input type="hidden" name="metode_pengecekan_value[]" value="{{ $item->metode }}">
                        <select class="form-select" aria-label="Default select example" name="metode_pengecekan[]" id="metode" onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                            <option selected disabled>Open this select menu</option>
                            <option value="1" {{ $item->metode == '1' ? 'selected' : '' }}>One</option>
                            <option value="2" {{ $item->metode == '2' ? 'selected' : '' }}>Two</option>
                            <option value="3" {{ $item->metode == '3' ? 'selected' : '' }}>Three</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="hidden" value="{{ $item->foto_pengecekan }}" name="url_foto[]">
                        <div class="d-flex gap-2">
                            <div class="input-group">
                                <span class="input-group-text" style="height: fit-content">Pilih File</span>
                                <label tabindex="0" class="form-control text-start" style="height:2.3rem">
                                    <span class="file-name">{{ $item->foto_pengecekan_name }}</span>
                                    <input type="file" name="foto_pengecekan[]" id="foto_pengecekan" class="invisible" accept="image/png, image/jpeg, image/jpg" data-index="{{ $index }}" style="height:fit-content">
                                    <input type="hidden" name="foto_pengecekan_name[]" value="{{ $item->foto_pengecekan_name }}">
                                </label>
                            </div>
                            <a href="/storage/{{ $item->foto_pengecekan }}" target="_blank" class="bg-primary p-2 rounded-2 text-white text-decoration-none my-auto" id="preview_{{ $index }}">Preview</a>
                        </div>
                        <div class="invalid-feedback"></div>
                    </td>
                </tr>
                @endif
                @endforeach
            </tbody>

        </table>
    </div>
    <button type="submit" class="btn bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-editpengecekan"></span>
            <span>Submit</span>
        </div>
    </button>
</form>

@push('form-edit-pengecekan')
<script>
    $(document).ready(function() {
        let formId = "edit_form_pengecekan_{{$data->id}}";
        let $form = $("#" + formId);
        if ($("#" + formId).find("#jumlah_kerusakan").val() > 0) {
            $("#" + formId).find("#table_edit_pengecekan").show();
            $("#" + formId).find("#text-kerusakan-edit").show();
        } else {
            $("#" + formId).find("#table_edit_pengecekan").hide();
            $("#" + formId).find("#text-kerusakan-edit").hide();
        }
        $form.find('#loading-button-editpengecekan').hide();

        $("#" + formId).find("#jumlah_kerusakan").on("change", function() {
            console.log("hai")
            var rowCount = parseInt($(this).val());
            var lengthTable = $("#" + formId).find("#table_edit_pengecekan tbody tr").length;
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
                            '<input type="hidden" name="metode_pengecekan_value[]"/>' +
                            '<select class="form-select" aria-label="Default select example" name="metode_pengecekan[]" id="metode" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">' +
                            '<option selected disabled>Open this select menu</option>' +
                            '<option value="1">One</option>' +
                            '<option value="2">Two</option>' +
                            '<option value="3">Three</option>' +
                            '<option value="4">Four</option>' +
                            '</select>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<input type="hidden" name="foto_pengecekan_name[]"/>' +
                            '<input type="file" name="foto_pengecekan[]" id="foto_pengecekan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '</tr>');
                        $("#" + formId).find("#table_edit_pengecekan tbody").append(rowObject);

                    }
                    $("#" + formId).find("#table_edit_pengecekan tbody tr").each(function(index) {
                        let $metodeId = $(this).find('select[name="metode_pengecekan[]"]');
                        let $fotoPengecekanId = $(this).find('input[name="foto_pengecekan[]"]');
                        $fotoPengecekanId.on('change', function() {
                            // Get the selected file name
                            var fileName = $(this).val().split('\\').pop();
                            if (fileName === '') {
                                fileName = 'No file chosen';
                            }
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
                    });

                } else if (rowCount < lengthTable) { // This is the corrected part
                    for (var i = 0; i < (lengthTable - rowCount); i++) {
                        $("#" + formId).find("#table_edit_pengecekan tbody tr:last-child").remove();
                    }
                }
                $("#" + formId).find("#table_edit_pengecekan").show();
                $("#" + formId).find("#text-kerusakan-edit").show();
            } else {
                $("#" + formId).find("#table_edit_pengecekan").hide();
                $("#" + formId).find("#table_edit_pengecekan tbody").empty();
                $("#" + formId).find("#text-kerusakan-edit").hide();

            }
            jumlah_kerusakan3_value = $(this).val();
        });
        $("#" + formId).find('input[name="foto_pengecekan[]"]').on('change', function() {
            // Get the selected file name
            var fileName = $(this).val().split('\\').pop();
            if (fileName === '') {
                fileName = 'No file chosen';
            }
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(fileName);
            $(this).siblings('.file-name').text(fileName);
        });
        $("#" + formId).find('select[name="metode_pengecekan[]"]').on('change', function() {
            // Get the selected file name
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
        });

        $form.submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            var formData = new FormData(this);
            var modalId = $(this).data('id');
            $.ajax({
                url: "{{ route($cleaned.'.transaksi.editpengecekan') }}", // Ganti dengan endpoint Anda
                type: 'POST',
                data: formData,
                processData: false, // Mengatur false, karena kita menggunakan FormData
                contentType: false,
                beforeSend: function() {
                    $form.find('#loading-button-editpengecekan').show();
                },
                success: function(response) {
                    $form.find('#loading-button-editpengecekan').hide();

                    // Handle response sukses
                    $('#' + modalId).modal('hide');
                    showAlert(response.message);
                },

                error: function(xhr, status, error) {
                    $form.find('#loading-button-editpengecekan').hide();

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
                        if (cleanInputName.includes("name")) {
                            const index = cleanInputName.replace(/_name/i, "");
                            console.log(index);
                            const elements = $form.find('[name="' + index + '[]"]');
                            elements.addClass('is-invalid');
                            elements.next('.invalid-feedback').text(cleanAngka);
                        } else if (cleanInputName.includes("value")) {
                            const index = cleanInputName.replace(/_value/i, "");
                            console.log(index);
                            const elements = $form.find('[name="' + index + '[]"]');
                            elements.addClass('is-invalid');
                            elements.next('.invalid-feedback').text(cleanAngka);
                        }
                        elementArray.addClass('is-invalid');
                        elementArray.next('.invalid-feedback').text(cleanAngka);
                    });

                }
            });
        });

    });
</script>
@endpush()