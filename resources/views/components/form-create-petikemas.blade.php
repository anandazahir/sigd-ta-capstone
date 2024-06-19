@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" action="{{ route($cleaned.'.petikemas.petikemasstore') }}" id="create-petikemas-form" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_petikemas" class="form-label">Nomor Peti Kemas</label>
            <input type="text" class="form-control" id="no_petikemas" placeholder="Nomor Peti Kemas" name="no_petikemas" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pelataran" class="form-label">Pelayaran</label>
            <select class="form-select" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();" name="pelayaran" id="pelayaran">
                <option selected disabled>Plih Opsi Ini</option>
                <option value="benline">BENLINE</option>
                <option value="wanhai">WANHAI</option>
                <option value="one">ONE</option>
                <option value="cosco">COSCO</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 mb-3 form-group">
            <label for="jenis dan ukuran" class="form-label">Jenis & Ukuran </label>
            <select class="form-select" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();" name="jenis_ukuran" id="jenis_ukuran">
                <option selected disabled>Plih Opsi Ini</option>
                <option value="20'GP">20'GP</option>
                <option value="20'RF">20'RF</option>
                <option value="20'FT">20'FT</option>
                <option value="20'OT">20'OT</option>
                <option value="20'TK">20'TK</option>
                <option value="40'GP">40'GP</option>
                <option value="40'RF">40'RF</option>
                <option value="40'FT">40'FT</option>
                <option value="40'OT">40'OT</option>
                <option value="40'HC">40'HC</option>
                <option value="40'RH">40'RH</option>
                <option value="40'TK">40'TK</option>
                <option value="45'HC">45'HC</option>
                <option value="45'U1">45'U1</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-create-petikemas"></span>
            <span>Submit</span>
        </div>
    </button>
</form>
<script>
    $(document).ready(function() {
        $('#loading-button-create-petikemas').hide();
        $('#create-petikemas-form').submit(function(event) {
            handleFormSubmission(this);
        });
    });
</script>