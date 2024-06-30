@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" action="{{ route($cleaned.'.pengajuan.store') }}" id="create-pengajuan-form" novalidate>
    @csrf
    <div class="mb-3 form-group">
        <label for="jenispengajuan" class="form-label">Jenis Pengajuan</label>
        <select id="jenispengajuan" class="form-select" aria-label="Default select example" required name="jenis_pengajuan">
            <option selected disabled>Plih Opsi Ini</option>
            <option value="pengajuan cuti">Pengajuan Cuti</option>
            <option value="kenaikan gaji">Kenaikan Gaji</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>
    <div data-form="pengajuancuti" style="display: none;">
        <div class="row">
            <div class="col-lg-12 form-group mb-3">
                <label for="Alamat" class="form-label">Alamat ketika cuti</label>
                <textarea class="form-control" rows="3" name="alamat_cuti"></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 form-group mb-3">
                <label for="mulaicuti" class="form-label">Mulai Cuti</label>
                <input type="date" class="form-control" name="mulai_cuti" required>
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-lg-6 form-group mb-3">
                <label for="selesaicuti" class="form-label">Selesai Cuti</label>
                <input type="date" class="form-control" name="selesai_cuti" required>
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="row">
            <div class="mb-3 form-group col-lg-12">
                <label for="jenispengajuan" class="form-label">Jenis Cuti</label>
                <select class="form-select jenis-cuti" aria-label="Default select example" required name="jenis_cuti">
                    <option selected disabled>Plih Opsi Ini</option>
                    <option value="cuti menikah">Cuti Menikah</option>
                    <option value="cuti melahirkan">Cuti Melahirkan</option>
                    <option value="cuti sakit">Cuti Sakit</option>
                    <option value="lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback"></div>
            </div>
            <div class="col-lg-12 form-group mb-3 lainnyatextarea" style="display: none;">
                <label for="alasan" class="form-label">Tulis Alasan Cuti</label>
                <textarea class="form-control" rows="3" name="alasan_cuti"></textarea>
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>

    <div data-form="kenaikangaji" style="display: none;">
        <div class="row mb-3 form-group">
            <label for="Alamat" class="form-label">Gaji Pokok Saat Ini</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="gaji_sekarang">
                <span class="input-group-text">,00</span>

                <div class="invalid-feedback"></div>
            </div>
            <label class="form-label text-muted">cth: 50000</label>
        </div>
        <div class="row mb-3 form-group">
            <label for="Alamat" class="form-label">Gaji Pokok Diajukan</label>
            <div class="input-group">
                <span class="input-group-text">Rp</span>
                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" name="gaji_diajukan">
                <span class="input-group-text">,00</span>

                <div class="invalid-feedback"></div>
            </div>
            <label class="form-label text-muted">cth: 50000</label>
        </div>
        <div class="row mb-3 form-group">
            <label for="Alasan" class="form-label">Alasan Kenaikan Gaji</label>
            <textarea class="form-control" rows="3" name="alasan_kenaikan_gaji"></textarea>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <button type="submit" class="btn bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-create-pengajuan"></span>
            <span>Submit</span>
        </div>
    </button>
</form>
<script>
    $(document).ready(function() {
        $('#loading-button-create-pengajuan').hide();
        $('#create-pengajuan-form').submit(function(event) {
            handleFormSubmission(this);
        });
        $('#jenispengajuan').change(function() {
            var selectedOption = $(this).val().replace(/\s+/g, '').toLowerCase();
            $('[data-form]').hide();
            $('[data-form="' + selectedOption + '"]').show();
        });
        $('.jenis-cuti').change(function() {

            if ($(this).val() === 'lainnya') {

                $('.lainnyatextarea').show();
            } else {

                $('.lainnyatextarea').hide();
            }
        });
    });
</script>