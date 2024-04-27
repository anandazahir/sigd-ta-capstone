<div class="modal fade" tabindex="-1" id="create-pengajuan" aria-labelledby="create-pengajuan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengajuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3 form-group">
                        <label for="jenispengajuan" class="form-label">Jenis Pengajuan</label>
                        <select id="jenispengajuan" class="form-select" aria-label="Default select example" required>
                            <option selected>Plih Opsi Ini</option>
                            <option value="pengajuan cuti">Pengajuan Cuti</option>
                            <option value="kenaikan gaji">Kenaikan Gaji</option>
                        </select>
                    </div>
                    <div data-form="pengajuancuti" style="display: none;">
                        <div class="row">
                            <div class="col-lg-12 form-group mb-3">
                                <label for="Alamat" class="form-label">Alamat ketika cuti</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-group mb-3">
                                <label for="mulaicuti" class="form-label">Mulai Cuti</label>
                                <input type="date" class="form-control" name="tanggal-lahir" required>
                            </div>
                            <div class="col-lg-6 form-group mb-3">
                                <label for="selesaicuti" class="form-label">Selesai Cuti</label>
                                <input type="date" class="form-control" name="tanggal-lahir" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3 form-group col-lg-12">
                                <label for="jenispengajuan" class="form-label">Jenis Cuti</label>
                                <select class="form-select jenis-cuti" aria-label="Default select example" required>
                                    <option selected>Plih Opsi Ini</option>
                                    <option value="cuti menikah">Cuti Menikah</option>
                                    <option value="cuti melahirkan">Cuti Melahirkan</option>
                                    <option value="cuti sakit">Cuti Sakit</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-lg-12 form-group mb-3 lainnyatextarea" style="display: none;">
                                <label for="Alamat" class="form-label">Tulis Alasan Cuti</label>
                                <textarea class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div data-form="kenaikangaji" style="display: none;">
                        <div class="row mb-3 form-group">
                            <label for="Alamat" class="form-label">Gaji Pokok Saat Ini</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label for="Alamat" class="form-label">Gaji Pokok Diajukan</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">,00</span>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label for="Alamat" class="form-label">Alasan Kenaikan Gaji</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                    <a href="/pegawai" type="submit" class="btn btn-primary text-white">Submit</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

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