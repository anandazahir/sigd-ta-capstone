<form action="/direktur/pegawai/store" method="POST">
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nama" class="form-label">Nama Panjang</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_hp" class="form-label">No Telepon</label>
            <input type="text" class="form-control" id="no_hp" placeholder="Nomor Telepon" name="no_hp" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir" name="pendidikan_terakhir" required>
                <option selected>Pilih Opsi Ini</option>
                <option value="SMA">SMA</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="status_menikah" class="form-label">Status Pernikahan</label>
            <select class="form-select" id="status_menikah" name="status_menikah" required>
                <option selected>Pilih Opsi Ini</option>
                <option value="sudah menikah">Sudah Menikah</option>
                <option value="belum menikah">Belum Menikah</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" required>
                <option selected>Pilih Opsi Ini</option>
                <option value="mops">Manajer Operasional</option>
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
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="JK" class="form-label">Gender</label>
            <select class="form-select" id="JK" name="JK" required>
                <option selected>Pilih Opsi Ini</option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="ex: rizal" name="username" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Agama</label>
            <input type="text" class="form-control" id="agama" placeholder="agama" name="agama" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat" required></textarea>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white">Submit</button>
</form>