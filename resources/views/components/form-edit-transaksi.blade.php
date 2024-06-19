@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" action="{{ route($cleaned.'.transaksi.update', $data->id) }}" id="edit-transaksi-form" novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="jenis_kegiatan" class="form-label">Jenis Transaksi</label>
            <select class="form-select" id="jenis_kegiatan" name="jenis_kegiatan" required disabled style="">
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="impor" {{ $data->jenis_kegiatan == 'impor' ? 'selected' : '' }}>Impor</option>
                <option value="ekspor" {{ $data->jenis_kegiatan == 'ekspor' ? 'selected' : '' }}>Ekspor</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="perusahaan" class="form-label">Perusahaan</label>
            <select class="form-select" id="perusahaan" name="perusahaan" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="PT Anugrah Mulia" {{ $data->perusahaan == 'PT Anugrah Mulia' ? 'selected' : '' }}>PT Anugrah Mulia</option>
                <option value="PT B" {{ $data->perusahaan == 'PT B' ? 'selected' : '' }}>PT B</option>
                <option value="PT C" {{ $data->perusahaan == 'PT C' ? 'selected' : '' }}>PT C</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_do" class="form-label">No. DO</label>
            <input type="text" class="form-control" id="no_do" placeholder="No. DO" name="no_do" required value="{{ old('no_do', $data->no_do) }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_DO_rilis" class="form-label">Tanggal DO Rilis</label>
            <input type="date" class="form-control" id="tanggal_DO_rilis" name="tanggal_DO_rilis" required value="{{ old('tanggal_DO_rilis', $data->tanggal_DO_rilis) }}">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="cargo" class="form-label">Cargo:</label>
            <input type="text" class="form-control" id="kapal" placeholder="Cargo" name="kapal" required value="{{ old('kapal', $data->kapal) }}">
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_DO_exp" class="form-label">Tanggal DO Expired</label>
            <input type="date" class="form-control" id="tanggal_DO_exp" name="tanggal_DO_exp" required value="{{ old('tanggal_DO_exp', $data->tanggal_DO_exp) }}">
        </div>
        <div class="invalid-feedback"></div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="emkl" class="form-label">EMKL</label>
            <select class="form-select" id="emkl" name="emkl" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="EMKL A" {{ $data->emkl == 'EMKL A' ? 'selected' : '' }}>EMKL A</option>
                <option value="EMKL B" {{ $data->emkl == 'EMKL B' ? 'selected' : '' }}>EMKL B</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" id="tanggal_transaksi" name="tanggal_transaksi" required value="{{ old('tanggal_transaksi', $data->tanggal_transaksi) }}">
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="jumlah_petikemas" class="form-label">Jumlah Peti Kemas</label>
            <input type="number" min="0" class="form-control" id="jumlah_petikemas" placeholder="Jumlah Peti Kemas" name="jumlah_petikemas" required value="{{ old('jumlah_petikemas', $data->jumlah_petikemas) }}" readonly>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="Inventory" class="form-label">Inventory</label>
            <select class="form-select" id="inventory" name="inventory" required>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="nanda" {{ $data->inventory == 'nanda' ? 'selected' : '' }}>nanda</option>
                <option value="rizal" {{ $data->inventory == 'rizal' ? 'selected' : '' }}>rizal</option>
                <option value="yoga" {{ $data->inventory == 'yoga' ? 'selected' : '' }}>yoga</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white mb-3" style="width: fit-content; margin-left:15px;">
        <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-edit-transaksi"></span>
        <span>Submit</span>
    </button>
</form>
@push('form-edit-transaksi')
<script>
    $(document).ready(function() {
        $('#loading-button-edit-transaksi').hide();
        $('#edit-transaksi-form').submit(function(event) {
            handleFormSubmission(this);
        });
    });
</script>
@endpush