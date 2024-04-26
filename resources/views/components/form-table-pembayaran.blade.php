<div class="modal fade fade " tabindex="-1" id="create-pembayaran" aria-labelledby="create-pembayaran" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah pembayaran</h5>
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
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="metode" class="form-label">Metode</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="BCA">BCA</option>
                                <option value="BRI">BRI</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="number" class="form-control" id="biaya"
                                placeholder="Biaya" name="biaya" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal"
                        data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
