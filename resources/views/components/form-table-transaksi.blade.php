<div class="modal fade fade" tabindex="-1" id="create-transaksi" aria-labelledby="create-transaksi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('transaksi.entrydatastore') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="jenis_transaksi" class="form-label">Jenis Transaksi</label>
                            <select class="form-select" id="jenis_kegiatan" name="jenis_kegiatan" required>
                                <option selected disabled>Pilih Opsi Ini</option>
                                <option value="impor">Impor</option>
                                <option value="ekspor">Ekspor</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="perusahaan" class="form-label">Perusahaan</label>
                            <select class="form-select" id="perusahaan" name="perusahaan" required>
                                <option selected disabled>Pilih Opsi Ini</option>
                                <option value="pt_anugrah_mulia">PT Anugrah Mulia</option>
                                <option value="pt_b">PT B</option>
                                <option value="pt_c">PT C</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="no_do" class="form-label">No. DO</label>
                            <input type="text" class="form-control" id="no_do" placeholder="No. DO" name="no_do" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="tanggal_DO_rilis" class="form-label">Tanggal DO Rilis</label>
                            <input type="date" class="form-control" id="tanggal_DO_rilis" name="tanggal_DO_rilis" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="cargo" class="form-label">Cargo:</label>
                            <input type="text" class="form-control" id="kapl" placeholder="Cargo" name="kapal" required>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="tanggal_DO_exp" class="form-label">Tanggal DO Expired</label>
                            <input type="date" class="form-control" id="tanggal_DO_exp" name="tanggal_DO_exp" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3 form-group">
                            <label for="emkl" class="form-label">EMKL</label>
                            <select class="form-select" id="emkl" name="emkl" required>
                                <option selected disabled>Pilih Opsi Ini</option>
                                <option value="EMKL A">EMKL A</option>
                                <option value="EMKL B">EMKL B</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3 form-group">
                            <label for="jumlah_petikemas" class="form-label">Jumlah Peti Kemas</label>
                            <input type="number" min="0" class="form-control" id="jumlah_petikemas" placeholder="Jumlah Peti Kemas" name="jumlah_petikemas" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white mb-3" style="width: fit-content; margin-left:15px;" id="#showAlert">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script></script>