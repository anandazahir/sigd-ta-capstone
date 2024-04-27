<div class="modal fade" tabindex="-1" id="edit-pengajuan" aria-labelledby="edit-pengajuan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="mb-3 form-group">
                        <label for="jenispengajuan" class="form-label">Status Pengajuan</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected value="pending">Plih Opsi Ini</option>
                            <option value="acc">ACC</option>
                            <option value="tolak">TOLAK</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="jenispengajuan" class="form-label">Ganti Surat Pengajuan</label>
                        <input type="file" class="form-control" id="myfile" name="myfile">
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>