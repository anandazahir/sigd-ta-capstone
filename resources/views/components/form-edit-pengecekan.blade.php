<div class="modal fade fade " tabindex="-1" id="edit-pengecekan" aria-labelledby="edit-pengecekan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengecekan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">

                        <div class="col-lg-6 mb-3 form-group">
                            <label for="status pernikahan" class="form-label">
                                <span>Survey In</span>
                                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
                            </label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Pilih Opsi Ini</option>
                                <option value="survey in 1">Survey in 1</option>
                                <option value="survey in 2">Survey in 2</option>
                                <option value="survey in 3">Survey in 3</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="tanggal pengecekan" class="form-label">Tanggal Pengecekan</label>
                            <input type="date" class="form-control" name="tanggal-pengecekan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
                            <input type="number" min="0" class="form-control" id="jumlahkerusakan" placeholder="Jumlah Kerusakan" name="jumlah kerusakan" required value="3">
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
                                <tr>
                                    <td class="text-center">
                                        <input class="form-control" type="text" value="Door Section 1">

                                    </td>
                                    <td class="text-center">
                                        <input class="form-control" type="text" value="Bottom Side Real">

                                    </td>
                                    <td class="text-center">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="file" name="" id="" class="form-control">
                                    </td>
                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#jumlahkerusakan").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#table_edit_pengecekan tbody tr").show(); // Show the first 'rowCount' rows
                if (rowCount > $("#table_edit_pengecekan tbody tr").length) {
                    var $firstRow = $("#table_edit_pengecekan tbody tr:first");
                    for (var i = $("#table_edit_pengecekan tbody tr").length; i < rowCount; i++) {
                        var newRow = $firstRow.clone(); // Clone the first row
                        newRow.find(".form-control").val(""); // Clear input values in the cloned row
                        newRow.find("select").prop("selectedIndex", 0); // Reset select values in the cloned row
                        $("#table_edit_pengecekan tbody").append(newRow); // Append the clone
                    }
                } else if (rowCount < $("#table_edit_pengecekan tbody tr").length) {
                    $("#table_edit_pengecekan tbody tr:gt(" + (rowCount - 1) + ")").remove(); // Remove excess rows
                }
            } else {
                $("#table_edit_pengecekan tbody tr").find(".form-control").val("");
                $("#table_edit_pengecekan tbody tr").find("select").prop("selectedIndex", 0);
                $("#table_edit_pengecekan tbody tr").hide();
            }

        });
    });
</script>