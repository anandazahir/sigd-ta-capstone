<div class="modal fade" tabindex="-1" id="create-penempatan" aria-labelledby="create-penempatan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Lokasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/penempatan">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nomor" class="form-label">No Peti Kemas</label>
                            <input type="text" class="form-control" id="nomor" placeholder="Nomor" name="nomor" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size" class="form-label">Lokasi </label>
                            <input type="size" class="form-control" id="size" placeholder="size" name="size" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size" class="form-label">Operator alat berat </label>
                            <input type="size" class="form-control" id="size" placeholder="size" name="size" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
