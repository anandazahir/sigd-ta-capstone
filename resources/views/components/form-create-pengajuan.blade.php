@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" action="{{ route($cleaned.'.pengajuan.store') }}" id="create-pengajuan-form" novalidate>
    <div class="alert alert-info rounded-3 mt-2 position-relative p-0 d-flex alert-dismissible fade show" style="height:3.5rem">
        <div class="bg-info rounded-3 rounded-end-0 p-2 position-absolute z-1 d-flex h-100" style="width: 9.5vh;">
            <i class="fa-solid fa-circle-info text-white mx-auto my-auto" style="font-size: 25px;"></i>

        </div>

        <p class="my-3" style="margin-left:80px;"><strong>INFO!</strong> Jumlah Cuti Tahunan Anda Tersisa <b>{{auth()->user()->jumlah_cuti}}</b></p>


        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @csrf
    <div data-form="pengajuancuti">
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
                    <option value="cuti tahunan" {{auth()->user()->jumlah_cuti == 0 ? 'disabled' : ''}}>Cuti Tahunan</option>
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


    <button type="submit" class="btn shadow bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-create-pengajuan"></span>
            <span>Submit</span>
        </div>
    </button>
</form>
<script>
    $(document).ready(function() {
        $('#loading-button-create-pengajuan').hide();
        /*$('#create-pengajuan-form').submit(function(event) {
            handleFormSubmission(this);
        });*/

        $('.jenis-cuti').change(function() {

            if ($(this).val() === 'cuti tahunan') {

                $('.lainnyatextarea').show();
            } else {

                $('.lainnyatextarea').hide();
            }
        });
    });
</script>