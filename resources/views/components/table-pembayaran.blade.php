<style>
    select.form-select:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
    }

    input.form-control:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
    }

    input[type="checkbox"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background-color: #f09259;
        /* Ubah ke warna yang Anda inginkan */
        /* Ganti ke warna yang Anda inginkan */
        border-radius: 3px;
        cursor: pointer;
        vertical-align: middle;
    }

    /* Optional: Untuk mengubah warna dari centang di dalam checkbox */
    input[type="checkbox"]:checked::before {

        display: inline-block;
        font-size: 16px;
        color: white;
        /* Ganti ke warna yang Anda inginkan */
        line-height: 20px;
        text-align: center;
    }
</style>
@php

$petikemas = $data->penghubungs->map(function ($penghubung) {
return [
'petikemas' => $penghubung->petikemas,
'pembayaran' => $penghubung->pembayaran,
];
});

@endphp

<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class="container">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pembayaran</h2>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" style="width: fit-content;" id="button-edit2">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data">
                    <i class="fa-solid fa-pen-to-square text-white my-1" style="font-size:21px"></i>
                    <span class="fw-semibold fs-6 my-1">Edit Pembayaran</span>
                </div>
            </button>

        </div>
        <form action="{{route('transaksi.editpembayaran')}}" id="edit-form-pembayaran" method="POST">
            @csrf
            <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                <table class="table-variations-3 text-center" id="table_pembayaran">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-semibold">Checkbox</th>
                            <th scope="col" class="fw-semibold">No Peti Kemas</th>
                            <th scope="col" class="fw-semibold">Size & Type</th>
                            <th scope="col" class="fw-semibold">Metode</th>
                            <th scope="col" class="fw-semibold">Biaya</th>
                            <th scope="col" class="fw-semibold" id="hide-tanggal">Tanggal Pembayaran</th>
                            <th scope="col" class="fw-semibold" id="hide-kwitansi">Cetak Kwitansi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($petikemas as $item)
                        @php
                        $petikemas = $item['petikemas'];
                        $pembayaran = $item['pembayaran'];
                        @endphp
                        <tr>
                            <td class="text-center">
                                <input class="form-check-input" type="checkbox" value="{{ $pembayaran->penghubung_id }}" id="pembayaran_checkbox" name="id_penghubung[]">
                            </td>
                            <td class="text-center">
                                <input type="text" name="no_petikemas" required readonly value="{{ $petikemas->no_petikemas }}" class="form-control mx-auto" style="width:fit-content" disabled>

                            </td>
                            <td class="text-center">
                                <input type="text" name="jenis_ukuranpembayaran" required readonly value="{{ $petikemas->jenis_ukuran }}" class="form-control mx-auto" style="width:fit-content" disabled>

                            </td>
                            <td class="text-center">
                                <select class="form-select mx-auto" name="metode[]" style="width: fit-content;" disabled required>
                                    <option selected disabled>Pilih Opsi Ini</option>
                                    <option value="BCA" {{ $pembayaran->metode == 'BCA' ? 'selected' : '' }}>Transfer BCA
                                    </option>
                                    <option value="BRI" {{ $pembayaran->metode == 'BRI' ? 'selected' : '' }}>Transfer BRI
                                    </option>
                                    <option value="Mandiri" {{ $pembayaran->metode == 'Mandiri' ? 'selected' : '' }}>Transfer Mandiri</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <input type="text" name="harga" required readonly value="{{ $petikemas->harga }}" class="form-control mx-auto" style="width:fit-content" disabled>

                            </td>
                            <td class="text-center" id="tanggal_pembayaran">
                                <span style="font-size: 16px;">
                                    17-4-2024
                                </span>
                            </td>
                            <td class="text-center" id="cetak-kwitansi">
                                <span class="bg-{{ $pembayaran->status_pembayaran == 'sudah lunas' ? 'success' : 'danger' }} text-white p-1 rounded-2 fs-6">{{ $pembayaran->status_pembayaran}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <button type="submit" class="btn btn-success text-white rounded-3 mt-3" id="button-submit2">
                Simpan Data
            </button>
    </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        const $button_edit = $("#button-edit2");
        const $button_cetak = $("#button-cetak2");
        const $button_submit = $("#button-submit2");
        $button_submit.hide();
        $("#table_pembayaran tbody tr td:first-child").hide();
        $("#table_pembayaran thead tr th:first-child").hide();
        $button_edit.on("click", function(e) {
            e.preventDefault();
            $('input[name="no_petikemas"]').prop("disabled", false);
            $('input[name="jenis_ukuranpembayaran"]').prop("disabled", false);
            $('input[name="harga"]').prop("disabled", false);
            $button_edit.hide();
            $button_cetak.show();
            $button_submit.show();
            $button_submit.prop("disabled", true);
            $("#table_pembayaran thead tr th:nth-child(6)").hide();
            $("#table_pembayaran thead tr th:last-child").hide();
            $("#table_pembayaran tbody tr td:nth-child(6)").hide();
            $("#table_pembayaran tbody tr td:last-child").hide();
            $("#table_pembayaran tbody tr td:first-child").show();
            $("#table_pembayaran thead tr th:first-child").show();
        });



        $("#table_pembayaran tbody tr").each(function(index, row) {
            const $row = $(this);
            $row.find('input[name="id_penghubung[]"]').on("change", function(e) {
                let $atLeastOneChecked = false;
                $row.find('select[name="metode[]"]').prop("disabled", !this.checked);
                if ($(this).prop("checked")) {
                    atLeastOneChecked = true;
                }
                if (!$(this).prop("checked")) {
                    atLeastOneChecked = false;
                }
                $button_submit.prop("disabled", !atLeastOneChecked);
                $row.find('.invalid-feedback').text('');
                $row.find('select[name="metode[]"]').removeClass('is-invalid');
            });
        });
        $('#edit-form-pembayaran').on('submit', function(e) {
            const formData = $(this).serialize();
            $("#table_pembayaran tbody tr").each(function(index, row) {
                e.preventDefault();
                const $row = $(this);
                const $checkbox = $row.find('input[name="id_penghubung[]"]');
                const $select = $row.find('select[name="metode[]"]');
                if ($checkbox.prop("checked")) {

                    if (!$select.val()) {

                        $select.addClass('is-invalid');
                        $row.find('.invalid-feedback').text('Please select a method.');
                    }
                }
            });
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>