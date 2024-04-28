<div class="modal fade fade " tabindex="-1" id="edit-perbaikan" aria-labelledby="edit-perbaikan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Perbaikan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="available">Available</option>
                                <option value="damage">Damage</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="status pernikahan" class="form-label">
                                <span>Repair</span>
                                {{-- <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
                            </label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Pilih Opsi Ini</option>
                                <option value="survey in 1">Repair 1</option>
                                <option value="survey in 2">Repair 2</option>
                                <option value="survey in 3">Repair 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="jumlah perbaikan" class="form-label">Jumlah Perbaikan</label>
                            <input type="number" min="0" class="form-control" id="jumlahperbaikan" placeholder="Jumlah Perbaikan" name="jumlah perbaikan" required value="3">
                        </div>
                    </div>

                    <div class="p-1 rounded-4 table-responsive">
                        <table class="table text-center" id="myTable3">
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
                                @for($i=0;$i<3;$i++) <tr>

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
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="number" class="form-control" value="125000">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="fix">FIX</option>
                                            <option value="damage">DAMAGE</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="file" name="" id="" class="form-control">
                                    </td>
                                    </tr>
                                    @endfor
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
        $("#jumlahperbaikan").on("change", function() {
            var rowCount = parseInt($(this).val());
            $("#myTable3 tbody tr").hide(); // Hide all rows

            if (rowCount > 0) {
                $("#myTable3 tbody tr").slice(0, rowCount).show(); // Show the first 'rowCount' rows

                if (rowCount > $("#myTable3 tbody tr").length) {
                    var $firstRow = $("#myTable3 tbody tr:first");
                    for (var i = $("#myTable3 tbody tr").length; i < rowCount; i++) {
                        var newRow = $firstRow.clone(); // Clone the first row
                        newRow.find(".form-control").val(""); // Clear input values in the cloned row
                        newRow.find("select").prop("selectedIndex", 0); // Reset select values in the cloned row
                        $("#myTable3 tbody").append(newRow); // Append the clone
                    }
                } else if (rowCount < $("#myTable3 tbody tr").length) {
                    $("#myTable3 tbody tr:gt(" + (rowCount - 1) + ")").remove(); // Remove excess rows
                }
            }
        });
    });
</script>