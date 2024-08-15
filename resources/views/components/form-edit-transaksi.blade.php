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
            <select class="form-select" id="jenis_kegiatan" name="jenis_kegiatan" required disabled>
                <option selected disabled>Pilih Opsi Ini</option>
                <option value="impor" {{ $data->jenis_kegiatan == 'impor' ? 'selected' : '' }}>Impor</option>
                <option value="ekspor" {{ $data->jenis_kegiatan == 'ekspor' ? 'selected' : '' }}>Ekspor</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="perusahaan" class="form-label">Perusahaan</label>
            <input type="text" name="perusahaan" class="form-select" value="{{$data->perusahaan}}" id="">
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
            <input type="text" name="emkl" class="form-select" value="{{$data->emkl}}" id="">
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
            <input type="number" min="0" class="form-control" id="jumlah_petikemas" placeholder="Jumlah Peti Kemas" name="jumlah_petikemas" required value="{{ old('jumlah_petikemas', $data->jumlah_petikemas) }}" disabled>
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="Inventory" class="form-label">Inventory</label>
            <select class="form-select" id="inventory" name="inventory" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($user as $item)
                @if ($item->hasRole('inventory'))
                <option value="{{$item->username}}" {{ $data->inventory == $item->username ? 'selected' : '' }}>{{($item->username)}}</option>
                @endif
                @endforeach

            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn shadow bg-primary text-white mb-3" style="width: fit-content; margin-left:15px;">
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