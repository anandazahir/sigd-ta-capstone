
<div class="modal fade fade " tabindex="-1" id="create-pengecekan" aria-labelledby="create-pengecekan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Pengecekan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method= "POST" id="create_form_pengecekan" action="{{ route('transaksi.storepengecekan', $data->id) }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="no peti kemas" class="form-label">No Peti Kemas</label>
                            <select name="id_penghubung" class="form-select" id="id_penghubung" aria-label="Default select example" required>
                                <option selected>Plih Opsi Ini</option>
                                @foreach ($data->penghubungs as $penghubung)
                                @if($penghubung->pembayaran->status_pembayaran === 'sudah lunas' && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak')
                                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}">{{ $penghubung->petikemas->no_petikemas }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-6 mb-3 form-group">
                            <label for="size & type" class="form-label">Size & Type:</label>     
                            <input type="text" class="form-control" id="jenis_ukuran_pengecekan" placeholder="Size & Type" name="jenis_ukuran_pengecekan" required readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
                            <input type="number" min="0" class="form-control" id="jumlahkerusakan2" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan" required value="0">
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-center" id="myTable2">
                            <thead>
                                <tr>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Component</th>
                                    <th scope="col">Metode</th>
                                    <th scope="col">Biaya</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Foto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">
                                        <input class="form-control" type="text">

                                    </td>
                                    <td class="text-center">
                                        <input class="form-control" type="text">

                                    </td>
                                    <td class="text-center">
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="1">One</option>
                                            <option value="2">Two</option>
                                            <option value="3">Three</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">Rp.</span>
                                            <input type="number" class="form-control">
                                            <span class="input-group-text">.00</span>
                                        </div>
                                    </td>
                                    <td>
                                        <select class="form-select" aria-label="Default select example">
                                            <option selected>Open this select menu</option>
                                            <option value="fix">FIX</option>
                                            <option value="damage">DAMAGE</option>
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <input type="file" name="" id="" class="form-control">
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                    <button type="submit" class="btn btn-primary text-white" data-bs-toggle="modal" data-bs-target="#toastModal">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#myTable2").hide();
        $("#jumlahkerusakan2").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#myTable2").show();

                var rowData = $("#myTable2 tbody tr:first").clone().html();
                $("#myTable2 tbody").empty(); // Empty the table body first
                // Clone row after emptying
                for (var i = 0; i < rowCount; i++) {
                    $("#myTable2 tbody").append("<tr>" + rowData + "</tr>"); // Append new rows using rowData as a template
                }
            } else {
                $("#myTable2").hide();
            }
        });

        $('#id_penghubung').change(function () {
            var selectedOption = $(this).find('option:selected');
            var jenisUkuran = selectedOption.data('jenis-ukuran');
            $('#jenis_ukuran_pengecekan').val(jenisUkuran || '');
        });

    });
</script>