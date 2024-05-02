<form method="POST" action="{{ route('petikemas.petikemasstore') }}" id="create-petikemas-form" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no_petikemas" class="form-label">Nomor Peti Kemas</label>
            <input type="text" class="form-control" id="no_petikemas" placeholder="Nomor Peti Kemas" name="no_petikemas" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="pelataran" class="form-label">Pelayaran</label>
            <input type="text" class="form-control" id="pelayaran" placeholder="Pelayaran" name="pelayaran" required>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-12 mb-3 form-group">
            <label for="jenis dan ukuran" class="form-label">Jenis & Ukuran </label>
            <input type="text" class="form-control" id="jenis_ukuran" placeholder="Jenis dan Ukuran" name="jenis_ukuran" required>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary text-white">Submit</button>
</form>
<script>
    $(document).ready(function() {
        $('#create-petikemas-form').submit(function(event) {
            handleFormSubmission(this);
        });
    });
</script>