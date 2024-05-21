<form method="POST" id="edit_form_pengecekan" action="{{ route('transaksi.editpengecekan') }}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="status pernikahan" class="form-label">
                <span>Survey In</span>
                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
            </label>
            <select name="survey_in" class="form-select" aria-label="Default select example" required>
                <option selected>Pilih Opsi Ini</option>
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
        var ajaxCompleted = true;
        $(document).on('click', '#edit_pengecekan_button', function(e) {
            e.preventDefault();
            $("#id_pengecekan2").val($(this).val());

            $("#edit-pengecekan-modal").find(".modal-title").text("Edit Pengecekan | No.Petikemas " + $(this).data("nopetikemas"));

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
                                '<select class="form-select" aria-label="Default select example" name="metode[]">' +
                                '<option selected disabled>Open this select menu</option>' +
                                '<option value="1">One</option>' +
                                '<option value="2">Two</option>' +
                                '<option value="3">Three</option>' +
                                '</select>' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '<td class="text-center">' +
                                '<input type="file" name="foto_pengecekan[]" id="" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                                '<div class="invalid-feedback"></div>' +
                                '</td>' +
                                '</tr>');
                            $("#table_edit_pengecekan tbody").append(rowObject); // Append new rows
                        }
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

            if (ajaxCompleted) {
                console.log(ajaxCompleted);
                $.ajax({
                    url: '/transaksi/indexkerusakan',
                    type: 'POST',
                    data: {
                        id_pengecekan: $("#edit_pengecekan_button").val(),
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        $('select[name="survey_in"]').find('option[value="' + response.pengecekan.survey_in + '"]').prop('selected', true);
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
                                    '<select class="form-select" aria-label="Default select example" name="metode[]">' +
                                    '<option selected disabled>Open this select menu</option>' +
                                    '<option value="1">One</option>' +
                                    '<option value="2">Two</option>' +
                                    '<option value="3">Three</option>' +
                                    '</select>' +
                                    '<div class="invalid-feedback"></div>' +
                                    '</td>' +
                                    '<td class="text-center">' +
                                    '<div class="d-flex gap-2">' +
                                    '<input type="file" name="foto_pengecekan[]" id="" class="form-control" accept="image/png, image/jpeg, image/jpg"  data-index="' + index + '">' +
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
                            $('input[type="file"]').on('change', function() {

                            });

                            ajaxCompleted = false;
                        }

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    },
                });
            }
        });

    });
</script>