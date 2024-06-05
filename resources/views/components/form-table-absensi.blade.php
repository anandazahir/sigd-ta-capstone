<div class="modal fade" tabindex="-1" id="form-table-absensi" aria-labelledby="form-table-absensi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Absensi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">

                    <div class="mb-3 form-group">
                        <label for="nama" class="form-label">Waktu Masuk</label>
                        <input type="time" class="form-control" id="nama" placeholder="Nama" name="nama" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="nip" class="form-label">Keterangan Masuk</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>Plih Opsi Ini</option>
                            <option value="absen">Absen</option>
                            <option value="terlambat">Terlambat</option>
                            <option value="cuti">Cuti</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="nama" class="form-label">Waktu Pulang</label>
                        <input type="time" class="form-control" id="nama" placeholder="Nama" name="nama" required>
                    </div>
                    <div class="mb-3 form-group">
                        <label for="nip" class="form-label">Keterangan Pulang</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option selected>Plih Opsi Ini</option>
                            <option value="absen">Absen</option>
                            <option value="terlambat">Terlambat</option>
                            <option value="cuti">Cuti</option>
                            <option value="izin">Izin</option>
                        </select>
                    </div>
                    <button type="submit" class="btn bg-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>