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
                            <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="available">Available</option>
                                <option value="damage">Damage</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="status pernikahan" class="form-label">
                                <span>Survey In</span>
                                {{--  <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>  --}}
                            </label>
                            <select class="form-select" aria-label="Default select example" required>
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
                            <input type="number" min="1" class="form-control" id="jumlahkerusakan" placeholder="Jumlah Kerusakan" name="jumlah kerusakan" required>
                        </div>
                    </div>

                    <div class="p-1 rounded-4 onscroll table-responsive" style="height: 25rem;">
                        <table class="table-dashboard text-center" id="myTable">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Component</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        1
                                    </td>
                                    <td class="text-center">
                                        Door Section 1
                                    </td>
                                    <td class="text-center">
                                        Bottom Side Rail
                                    </td>
                                    <td class="text-center">
                                        Insert
                                    </td>
                                    <td class="text-center">
                                        Rp125.0000,00
                                    </td>
                                    <td>
                                        <div class="bg-success p-1 rounded-2 text-white my-1">
                                            <span>Fixed</span>

                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button class="bg-info p-2 rounded-2 text-white">Foto</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#jumlahkerusakan").on("change", function () {
          var rowCount = parseInt($(this).val());
          var rowData = $("#myTable tbody tr:first").html();
          $("#myTable tbody").empty();
          for (var i = 0; i < rowCount; i++) {
            $("#myTable tbody").append("<tr>" + rowData + "</tr>");
          }
        });
      });
</script>
