<div class="modal fade fade" tabindex="-1" id="create-entrydata" aria-labelledby="create-entrydata" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peti kemas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/entrydata">
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
                            <label for="size" class="form-label">Size & Type </label>
                            <input type="size" class="form-control" id="size" placeholder="size" name="size" required>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>