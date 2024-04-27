<div class="modal fade fade " tabindex="-1" id="create-pengecekan" aria-labelledby="create-pengecekan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengecekan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="no peti kemas" class="form-label">No Peti Kemas</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="peti a">Peti A</option>
                                <option value="peti b">Peti B</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size & type" class="form-label">Size & Type:</label>
                            <input type="text" class="form-control" id="size & type" placeholder="Size & Type"
                                name="size & type" required>     
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
                            <input type="number" min="1" class="form-control" id="jumlahkerusakan2" placeholder="Jumlah Kerusakan" name="jumlah kerusakan" required>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-center" id="myTable2">
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
                                        <input class="form-control" type="text">

                                    </td>
                                    <td class="text-center">
                                        <input class="form-control" type="text">

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
                                            <input type="number" class="form-control">
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

                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#jumlahkerusakan2").on("change", function () {
          var rowCount = parseInt($(this).val());
          console.log(rowCount);
          var rowData = $("#myTable2 tbody tr:first").html();
          $("#myTable2 tbody").empty();
          for (var i = 0; i < rowCount; i++) {
            $("#myTable2 tbody").append("<tr>" + rowData + "</tr>");
          }
        });
      });
</script>
