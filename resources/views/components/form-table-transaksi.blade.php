<div class="modal fade fade" tabindex="-1" id="create-transaksi" aria-labelledby="create-transaksi" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/transaksi">
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="jenis transaksi" class="form-label">Jenis Transaksi</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                <option value="impor">Impor</option>
                                <option value="ekspor">Ekspor</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="perusahaan" class="form-label">Perusahaan</label>
                            <select class="form-select" aria-label="Default select example" required>
                                <option selected>Pilih Opsi Ini</option>
                                <option value="pt anugrah mulia">PT Anugrah Mulia</option>
                                <option value="pt b">PT B</option>
                                <option value="pt c">PT c</option>
                                {{-- <option value="pt d">pt d</option>
                                <option value="pt e">pt e</option>
                                <option value="pt f">pt f</option>
                                <option value="pt g">pt g</option>  --}}
                            </select>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-6 mb-3 form-group">
                                <label for="no. do" class="form-label">No. DO</label>
                                <input type="number" class="form-control" id="no. do" placeholder="No. DO" name="no. do" required>

                            </div>
                            <div class="col-lg-6 mb-3 form-group">
                                <label for="tanggal transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control" name="tanggal-transaksi" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3 form-group">
                                <label for="tanggal do rilis" class="form-label">Tanggal DO Rilis</label>
                                <input type="date" class="form-control" name="tanggal do rilis" required>
                            </div>
                            <div class="col-lg-6 mb-3 form-group">
                                <label for="tanggal do expired" class="form-label">Tanggal DO Expired</label>
                                <input type="date" class="form-control" name="tanggal do expired" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-3 form-group">
                                <label for="cargo" class="form-label">Cargo:</label>
                                <input type="text" class="form-control" id="cargo" placeholder="Cargo" name="cargo" required>
                            </div>
                            <div class="col-lg-6 mb-3 form-group ">
                                <label for="emkl" class="form-label">EMKL</label>
                                <select class="form-select" aria-label="Default select example" required>
                                    <option selected>Pilih Opsi Ini</option>
                                    <option value="EMKL A">EMKL A</option>
                                    <option value="EMKL B">EMKL B</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-group">
                                <label for="pelayaran" class="form-label">Pelayaran</label>
                                <select class="form-select" aria-label="Default select example" required>
                                    <option selected>Plih Opsi Ini</option>
                                    <option value="pelayaran a">Pelayaran A</option>
                                    <option value="pelayaran b">Pelayaran B</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3 form-group">
                                <label for="jumlah peti kemas" class="form-label">Jumlah Peti Kemas</label>
                                <input type="number" min="0" class="form-control" id="jumlahpetikemas" placeholder="Jumlah Peti Kemas" name="jumlah peti kemas" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script></script>