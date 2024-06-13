<form action="{{route('pegawai.update', $data->id)}}" method="post">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nama" class="form-label">Nama Panjang</label>
            <input type="text" class="form-control" id="nama" placeholder="Nama" name="nama" value="{{ $data->nama }}" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="nip" class="form-label">NIP</label>
            <input type="text" class="form-control" id="nip" placeholder="NIP" name="nip" value="{{ $data->nip }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{ $data->email }}" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_hp" class="form-label">No Telepon</label>
            <input type="text" class="form-control" id="no_hp" placeholder="Nomor Telepon" name="no_hp" value="{{ $data->no_hp }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nik" class="form-label">NIK</label>
            <input type="text" class="form-control" id="nik" placeholder="NIK" name="nik" value="{{ $data->nik }}" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
            <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir" required>
                <option value="" disabled>Pilih Opsi Ini</option>
                @foreach(['SMA', 'D1', 'D2', 'D3', 'D4', 'S1', 'S2', 'S3'] as $pendidikan)
                <option value="{{ $pendidikan }}" {{ $data->pendidikan_terakhir == $pendidikan ? 'selected' : '' }}>{{ $pendidikan }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="status_menikah" class="form-label">Status Pernikahan</label>
            <select class="form-select" id="status_menikah" name="status_menikah" required>
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="sudah menikah" {{ $data->status_menikah == 'sudah menikah' ? 'selected' : '' }}>Sudah Menikah</option>
                <option value="belum menikah" {{ $data->status_menikah == 'belum menikah' ? 'selected' : '' }}>Belum Menikah</option>
            </select>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="jabatan" class="form-label">Jabatan</label>
            <select class="form-select" id="jabatan" name="jabatan" required>
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="mops" {{ $data->jabatan == 'mops' ? 'selected' : '' }}>Manajer Operasional</option>
                <option value="inventory" {{ $data->jabatan == 'inventory' ? 'selected' : '' }}>Inventory</option>
                <option value="kasir" {{ $data->jabatan == 'kasir' ? 'selected' : '' }}>Kasir</option>
                <option value="survey in" {{ $data->jabatan == 'survey in' ? 'selected' : '' }}>Survey In</option>
                <option value="estimator" {{ $data->jabatan == 'estimator' ? 'selected' : '' }}>Estimator</option>
                <option value="repair" {{ $data->jabatan == 'repair' ? 'selected' : '' }}>Repair</option>
                <option value="tally" {{ $data->jabatan == 'tally' ? 'selected' : '' }}>Tally</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="JK" class="form-label">Gender</label>
            <select class="form-select" id="JK" name="JK" required>
                <option value="" disabled>Pilih Opsi Ini</option>
                <option value="pria" {{ $data->JK == 'pria' ? 'selected' : '' }}>Pria</option>
                <option value="wanita" {{ $data->JK == 'wanita' ? 'selected' : '' }}>Wanita</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="agama" class="form-label">Agama</label>
            <input type="text" class="form-control" id="agama" placeholder="Agama" name="agama" value="{{ $data->agama }}" required>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" placeholder="ex: rizal" name="username" value="{{ $data->username }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" rows="3" name="alamat" required>{{ $data->alamat }}</textarea>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white">Submit</button>
</form>