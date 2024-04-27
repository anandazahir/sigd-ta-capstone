<div class="modal fade" tabindex="-1" id="edit-penempatan" aria-labelledby="edit-penempatan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Lokasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/penempatan">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nomor" class="form-label">No Peti Kemas</label>

                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="impor">Peti Kemas A</option>
                                <option value="ekspor">Peti Kemas B</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size" class="form-label">Lokasi </label>
                            <input type="text" class="form-control" id="lokasi" placeholder="Lokasi"
                                name="lokasi" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size & type" class="form-label">Size & Type:</label>
                            <input type="text" class="form-control" id="size & type" placeholder="Size & Type"
                                name="size & type" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="tanggal penempatan" class="form-label">Tanggal Penempatan</label>
                            <input type="date" class="form-control" name="tanggal-penempatan" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3 form-group">
                            <label for="operator alat berat" class="form-label">Operator alat berat </label>
                            <input type="text" class="form-control" id="operatoralatberat"
                                placeholder="Operator Alat Berat" name="operator alat berat" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
