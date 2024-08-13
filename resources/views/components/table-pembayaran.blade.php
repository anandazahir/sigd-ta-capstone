@php

$petikemas = $data->penghubungs->map(function ($penghubung) {
return [
'petikemas' => $penghubung->petikemas,
'pembayaran' => $penghubung->pembayaran,
];

});
function formatRupiah($number)
{
return 'Rp. ' . number_format($number, 2, ',', '.');
}
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<style>
    select.pembayaran:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
        font-size: 20px;
    }

    input.pembayaran:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
        font-size: 20px;
    }

    input[type="checkbox"] {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        background-color: rgb(var(--bs-primary-rgb));
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

    input[type="checkbox"]:checked::before {

        display: inline-block;
        font-size: 16px;
        color: white;

        /* Ganti ke warna yang Anda inginkan */
        line-height: 20px;
        text-align: center;
    }
</style>


<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class="container">
        <div class="row justify-content-between p-0 m-0">
        <div class="d-flex gap-2">
            <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Pembayaran</h2>
                <button class="btn bg-white p-1 col-lg-2 mt-3 mt-lg-0 ms-auto" style="width: fit-content;" id="button-edit2">
                    <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data">
                        <i class="fa-solid fa-pen-to-square text-primary my-1" style="font-size:21px"></i>
                        <span class="fw-semibold fs-6 my-1 text-primary">Edit Pembayaran</span>
                    </div>
                </button> 
            </div>
            
        </div>
        <form action="{{route($cleaned.'.transaksi.editpembayaran', $data->id)}}" id="edit-form-pembayaran" method="POST">
            <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                <table class="table-variations-3 text-center" id="table_pembayaran">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-semibold">Checkbox</th>
                            <th scope="col" class="fw-semibold">No Peti Kemas</th>
                            <th scope="col" class="fw-semibold">Size & Type</th>
                            <th scope="col" class="fw-semibold">Metode</th>

                            <th scope="col" class="fw-semibold">Biaya</th>

                            @if ($data->tanggal_transaksi)
                            <th scope="col" class="fw-semibold">Tanggal Pembayaran</th>
                            @endif

                            <th scope="col" class="fw-semibold">Cetak Kwitansi</th>
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
                                <input class="form-check-input" type="checkbox" value="{{ $pembayaran->penghubung_id }}" id="pembayaran_checkbox" name="id_penghubung[]" {{ (auth()->user()->hasRole('kasir') && $pembayaran->metode !== null) ? 'disabled' : '' }}>
                            </td>
                            <td class="text-center">
                                <input type="text" name="no_petikemas" required disabled value="{{ $petikemas->no_petikemas }}" class="form-control mx-auto pembayaran" style="width:fit-content">

                            </td>
                            <td class="text-center">
                                <input type="text" name="jenis_ukuranpembayaran" required disabled value="{{ $petikemas->jenis_ukuran }}" class="form-control mx-auto pembayaran" style="width:fit-content">

                            </td>
                            <td class="text-center">
                                <select class="form-select mx-auto pembayaran" name="metode[]" style="width: fit-content;" required disabled>
                                    <option selected disabled></option>
                                    >
                                    <option value="Debit Mandiri" {{ $pembayaran->metode == 'Debit Mandiri' ? 'selected' : '' }}>Debit Mandiri</option>
                                    <option value="Debit BCA" {{ $pembayaran->metode == 'Debit BCA' ? 'selected' : '' }}>Debit BCA</option>
                                    <option value="Debit BRI" {{ $pembayaran->metode == 'Debit BRI' ? 'selected' : '' }}>Debit BRI</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">

                                <input type="text" name="harga" disabled readonly value="{{ formatRupiah($petikemas->harga) }}" class="form-control mx-auto pembayaran" style="width:fit-content">
                            </td>
                            @if ($data->tanggal_transaksi)
                            <td class="text-center" id="tanggal_pembayaran">
                                {{$pembayaran->tanggal_pembayaran}}
                            </td>
                            @endif
                            <td class="text-center" id="cetak-kwitansi">
                                <span class="bg-{{ $pembayaran->status_pembayaran == 'sudah lunas' ? 'primary' : 'danger' }} text-white p-1 rounded-2 fs-6">{{ $pembayaran->status_pembayaran}}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn rounded-3 mx-auto btn-info" id="button-submit2" value="{{$data->id}}">
                    <div class="d-flex gap-2">
                        <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-pembayaran"></span>
                        <span class="fw-semibold text-white"> Simpan Data & Cetak Kwitansi</span>
                    </div>

                </button>
            </div>
    </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        const $button_edit = $("#button-edit2");
        const $button_submit = $("#button-submit2");
       
        $button_submit.hide();

        $("#table_pembayaran tbody tr td:first-child").hide();
        $("#table_pembayaran thead tr th:first-child").hide();
        $('.tabs').click(function() {
            if ($('#Pembayaran').hasClass('d-none')) {
                $('input[name="no_petikemas"]').addClass("pembayaran");
                $('input[name="jenis_ukuranpembayaran"]').addClass("pembayaran");
                $('input[name="harga"]').addClass("pembayaran");
                $('select[name="metode[]"]').addClass("pembayaran");
                $('select[name="metode[]"]').prop("disabled", "true");
                $('input[name="id_penghubung[]"]').prop('checked', false);
                $("#button-edit2").show();
                $("#button-submit2").hide();
                $("#table_pembayaran thead tr th:nth-child(6)").show();
                $("#table_pembayaran thead tr th:last-child").show();
                $("#table_pembayaran tbody tr td:nth-child(6)").show();
                $("#table_pembayaran tbody tr td:last-child").show();
                $("#table_pembayaran tbody tr td:first-child").hide();
                $("#table_pembayaran thead tr th:first-child").hide();

            }
        });
        $button_edit.on("click", function(e) {
            e.preventDefault();
            $('input[name="no_petikemas"]').removeClass("pembayaran");
            $('input[name="jenis_ukuranpembayaran"]').removeClass("pembayaran");
            $('input[name="harga"]').removeClass("pembayaran");
            $('select[name="metode[]"]').removeClass("pembayaran");
            $button_edit.hide();
            $button_submit.show();
            $button_submit.prop("disabled", true);
            $("#table_pembayaran thead tr th:nth-child(6)").hide();
            $("#table_pembayaran thead tr th:last-child").hide();
            $("#table_pembayaran tbody tr td:nth-child(6)").hide();
            $("#table_pembayaran tbody tr td:last-child").hide();
            $("#table_pembayaran tbody tr td:first-child").show();
            $("#table_pembayaran thead tr th:first-child").show();
            $("#table_pembayaran tbody tr").each(function(index, row) {
                const $row = $(this);
                const $checkbox = $row.find('input[name="id_penghubung[]"]');
                if ($checkbox.prop("disabled")) {
                    $checkbox.hide();
                    $row.find('input[type="text"]').addClass("pembayaran");
                    $row.find('select').addClass("pembayaran");
                }
            });
        });



        $("#table_pembayaran tbody tr").each(function(index, row) {
            const $row = $(this);
            $row.find('input[name="id_penghubung[]"]').on("change", function(e) {
                $row.find('select[name="metode[]"]').prop("disabled", !this.checked);

                if ($(this).prop("checked")) {
                    $row.find('select[name="metode[]"] option[disabled]').text("Pilih Opsi Ini");
                } else {
                    $row.find('select[name="metode[]"] option[disabled]').text("");
                }
                let atLeastOneChecked = $('input[name="id_penghubung[]"]:checked').length > 0;
                $button_submit.prop("disabled", !atLeastOneChecked);
                $row.find('.invalid-feedback').text('');
                $row.find('select[name="metode[]"]').removeClass('is-invalid');
            });
        });
        $('#loading-button-pembayaran').hide();
        $('#edit-form-pembayaran').on('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission action

            const formData = $(this).serialize();
            let errorOccured = false; // Flag to track validation errors
            let checkboxval = [];
            let selectval = [];

            $("#table_pembayaran tbody tr").each(function(index, row) {
                const $row = $(this);
                const $checkbox = $row.find('input[name="id_penghubung[]"]');
                const $select = $row.find('select[name="metode[]"]');

                if ($checkbox.prop("checked") && !$select.val()) {
                    $select.addClass('is-invalid');
                    $row.find('.invalid-feedback').text('Please select a method.');
                    errorOccured = true;
                } else if ($checkbox.prop("checked") && $select.val()) {
                    checkboxval.push($checkbox.val());
                    selectval.push($select.val());
                }
            });


            function showLoadingButton() {
                $('#loading-button-pembayaran').show();

            }

            function hideLoadingButton() {
                $('#loading-button-pembayaran').hide();

            }
            if (!errorOccured) {
                // If no validation error, proceed with form submission
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_penghubung: checkboxval,
                        metode: selectval,
                    },
                    beforeSend: showLoadingButton(),
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(blob) {
                        hideLoadingButton()
                        var url = window.URL.createObjectURL(blob);
                        window.open(url, '_blank');
                        showAlert('Kwitansi Berhasil Dicetak!')
                    },
                    error: function(xhr, status, error) {
                        hideLoadingButton();
                        console.error(xhr.responseText);
                    }
                });
            }
        });
        
    });
</script>