<div class="modal fade fade " tabindex="-1" id="create-petikemas" aria-labelledby="create-petikemas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Peti kemas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/petikemas">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nama" class="form-label">Pelayaran</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nip" class="form-label">Size & Type </label>
                            <input type="nip" class="form-control" id="nip" placeholder="Nip" name="nip" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nip" class="form-label">Status Kondisi</label>
                            <input type="nip" class="form-control" id="nip" placeholder="Nip" name="nip" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nip" class="form-label">Status Ketersediaan</label>
                            <input type="nip" class="form-control" id="nip" placeholder="Nip" name="nip" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>