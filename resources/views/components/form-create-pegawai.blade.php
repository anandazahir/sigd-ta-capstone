<form action="/direktur/pegawai/store" method="POST" id="create-pegawai">
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nama" class="form-label">Nama Panjang</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_hp" class="form-label">No Telepon</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input type="text" class="form-control" id="no_hp" placeholder="Nomor Telepon" name="no_hp">

                <div class="invalid-feedback"></div>
            </div>
            <label class="text-muted">cth: 81266666</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikan_terakhir" placeholder="Pendidikan Terakhir" name="pendidikan_terakhir" onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="SMA">SMA</option>
                <option value="D1">D1</option>
                <option value="D2">D2</option>
                <option value="D3">D3</option>
                <option value="D4">D4</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
                <option value="S3">S3</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="status_menikah" class="form-label">Status Pernikahan</label>
            <select class="form-select" id="status_menikah" name="status_menikah">
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="sudah menikah">Sudah Menikah</option>
                <option value="belum menikah">Belum Menikah</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="mops">Manajer Operasional</option>
                <option value="inventory">Inventory</option>
                <option value="kasir">Kasir</option>
                <option value="surveyin">Survey In</option>
                <option value="repair">Repair</option>
                <option value="tally">Tally</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="JK" class="form-label">Gender</label>
            <select class="form-select" id="JK" name="JK">
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="username" name="username">
            <div class="invalid-feedback"></div>
            <label class="form-label text-muted">cth: rizal</label>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Agama</label>
            <input type="text" class="form-control" id="agama" placeholder="agama" name="agama">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat"></textarea>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn shadow bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-create-pegawai"></span>
            <span>Submit</span>
        </div>
    </button>
</form>
<script>
    $('#loading-button-create-pegawai').hide();
    /*$('#create-pegawai').submit(function(event) {
        handleFormSubmission(this);
    });*/
</script>