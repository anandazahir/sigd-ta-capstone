<form method="POST" id="edit_form_pengecekan" action="{{ route('transaksi.editpengecekan') }}"
    enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">

        <div class="col-lg-6 mb-3 form-group">
            <label for="status pernikahan" class="form-label">
                <span>Survey In</span>
                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
            </label>
            <select name="survey_in" class="form-select" aria-label="Default select example" required>
                <option selected>Pilih Opsi Ini</option>
                <option value="survey in 1">Survey in 1</option>
                <option value="survey in 2">Survey in 2</option>
                <option value="survey in 3">Survey in 3</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan"
                placeholder="Jumlah Kerusakan" name="jumlah_kerusakan3" required>
        </div>
    </div>

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
            $("#jumlah_kerusakan").on("change", function() {
                handlerAjax('#edit_form_pengecekan', $('select[name = "survey_in"]'), $('input[name = "jumlah_kerusakan3"]') );

                var rowCount = parseInt($(this).val());
                if (rowCount > 0) {
                    $("#table_edit_pengecekan tbody tr")
                        .show(); // Show the first 'rowCount' rows
                    if (rowCount > $("#table_edit_pengecekan tbody tr").length) {
                        var $firstRow = $("#table_edit_pengecekan tbody tr:first");
                        for (var i = $("#table_edit_pengecekan tbody tr").length; i <
                            rowCount; i++) {
                            var newRow = $firstRow.clone(); // Clone the first row
                            newRow.find(".form-control").val(
                                ""); // Clear input values in the cloned row
                            newRow.find("select").prop("selectedIndex",
                                0); // Reset select values in the cloned row
                            $("#table_edit_pengecekan tbody").append(
                                newRow); // Append the clone
                        }
                    } else if (rowCount < $("#table_edit_pengecekan tbody tr").length) {
                        $("#table_edit_pengecekan tbody tr:gt(" + (rowCount - 1) + ")")
                            .remove(); // Remove excess rows
                    }
                } else {
                    $("#table_edit_pengecekan tbody tr").find(".form-control").val("");
                    $("#table_edit_pengecekan tbody tr").find("select").prop("selectedIndex",
                        0);
                    $("#table_edit_pengecekan tbody tr").hide();
                }

            });
            e.preventDefault();

            function handlerAjax(form, $survey_in, $jumlah_kerusakan) {
                var formData = new FormData(form);
                var forms = $(form);
                $.ajax({
                    url: "{{ route('transaksi.editpengecekan') }}", // Ganti dengan endpoint Anda
                    type: 'POST',
                    data: formData,
                    processData: false, // Mengatur false, karena kita menggunakan FormData
                    contentType: false, // Mengatur false, karena kita menggunakan FormData
                    success: function(response) {
                        // Handle response sukses
                        /*$('#create-pengecekan-modal').modal('hide');*/
                        showAlert(response.message);
                        console.log('Success:', response);
                        // Mengatur nilai ke elemen formulir
                        survey_in.val(response.pengecekan.survey_in);
                        jumlah_kerusakan.val(response.pengecekan.jumlah_kerusakan);
                    },

                    error: function(xhr, status, error) {
                        const errors = xhr.responseJSON.errors;
                        if (xhr.status === 500) {
                            alert("Kolom Unik Tidak Boleh Sama!")
                        } else if (xhr.status === 404) {
                            alert("Data Tidak Ditemukan!");
                        }

                        forms.find('.is-invalid').removeClass(
                            'is-invalid');
                        forms.find('.invalid-feedback').text('');

                        $.each(errors, function(key, value) {
                            const element = forms.find(
                                '[name="' + key +
                                '"]');
                            /*const elementSelector = forms.find('[name="' + key + '"]');
                            if (kalimat.indexOf('.0') !== -1) {
                                
                            }*/
                            var cleanInputName = key.replace(/\.\d+/g, '');
                            var cleanAngka = value[0].replace(/\.\d+/g, '');
                            element.addClass('is-invalid');
                            element.next('.invalid-feedback').text(value[0]);
                            console.log(key + '[]');
                            const elementArray = forms.find(
                                '[name="' +
                                cleanInputName + '[]"]');
                            elementArray.addClass('is-invalid');
                            elementArray.next('.invalid-feedback').text(cleanAngka);
                        });

                    }
                });
            }

        });

    });
</script>
