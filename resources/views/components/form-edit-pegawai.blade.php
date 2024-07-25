<form action="{{route('pegawai.update', $data->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nama" class="form-label">Nama Panjang</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="{{ $data->nama }}">
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="{{ $data->nip }}">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $data->email }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">

            <label for="no_hp" class="form-label">No Telepon</label>
            <div class="input-group">
                <span class="input-group-text">+62</span>
                <input type="text" class="form-control" id="no_hp" placeholder="Nomor Telepon" name="no_hp" value="{{ str_replace('0','',$data->no_hp) }}">
            </div>
            <div class="invalid-feedback"></div>
            <label class="text-muted">cth: 81266666</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" value="{{ $data->nik }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option value="" disabled>Pilih Opsi Ini</option>
                @foreach(['SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $pendidikan)
                <option value="{{ $pendidikan }}" {{ $data->pendidikan_terakhir == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="status_menikah" class="form-label">Status Pernikahan</label>
            <select class="form-select" id="status_menikah" name="status_menikah">
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="sudah menikah" {{ $data->status_menikah == 'sudah menikah' ? 'selected' : '' }}>Sudah Menikah</option>
                <option value="belum menikah" {{ $data->status_menikah == 'belum menikah' ? 'selected' : '' }}>Belum Menikah</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan">
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="mops" {{ $data->jabatan == 'mops' ? 'selected' : '' }}>Manajer Operasional</option>
                <option value="inventory" {{ $data->jabatan == 'inventory' ? 'selected' : '' }}>Inventory</option>
                <option value="kasir" {{ $data->jabatan == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="surveyin" {{ $data->jabatan == 'surveyin' ? 'selected' : '' }}>Survey In</option>
                <option value="estimator" {{ $data->jabatan == 'estimator' ? 'selected' : '' }}>Estimator</option>
                <option value="repair" {{ $data->jabatan == 'repair' ? 'selected' : '' }}>Repair</option>
                <option value="tally" {{ $data->jabatan == 'tally' ? 'selected' : '' }}>Tally</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="JK" class="form-label">Gender</label>
            <select class="form-select" id="JK" name="JK">
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="pria" {{ $data->JK == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ $data->JK == 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" class="form-control" id="agama" placeholder="Agama" name="agama" value="{{ $data->agama }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="ex: rizal" name="username" value="{{ $data->username }}">
            <div class="invalid-feedback"></div>
            <label class="form-label text-muted">cth: rizal</label>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ $data->alamat }}</textarea>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-edit-pengajuan"></span>
            <span>Submit</span>
        </div>
    </button>
</form>
<script>
    $('#loading-button-edit-pegawai').hide();
    $('#edit-pegawai').submit(function(event) {
        handleFormSubmission(this);
    });
</script>