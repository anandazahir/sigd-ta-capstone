<div class="modal fade fade " tabindex="-1" id="create-pegawai" aria-labelledby="create-pegawai" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/pegawai">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nama" class="form-label">Nama:</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="nip" class="form-label">NIP</label>
                            <input type="nip" class="form-control" id="nip" placeholder="Nip" name="nip" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="email" name="email" required>

                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="notlpn" class="form-label">No Telepon</label>
                            <input type="text" class="form-control" id="notlpn" placeholder="Nomor Telepon" name="notlpn" required>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="email" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="pendidikanterkahir" class="form-label">Pendidikan Terakhir</label>
                            <input type="text" class="form-control" id="pendidikanterakhir" placeholder="Pendidikan Terakhir" name="pendidikanterkahir" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="status pernikahan" class="form-label">Status Pernikahan</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="sudah menikah">Sudah Menikah</option>
                                <option value="belum menikah">Belum Menikah</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="status pernikahan" class="form-label">Jabatan</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Pilih Opsi Ini</option>
                                <option value="manajer operasional">Manajer Operasional</option>
                                <option value="inventory">Inventory</option>
                                <option value="kasir">Kasir</option>
                                <option value="survey in">Survey In</option>
                                <option value="estimator">Estimator</option>
                                <option value="repair">Repair</option>
                                <option value="tally">Tally</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="tanggal lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal-lahir" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group ">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Pilih Opsi Ini</option>
                                <option value="pria">Manajer Operasional</option>
                                <option value="wanita">Inventory</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" rows="3"></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>