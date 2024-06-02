<style>
    select.form-select:disabled,
    input.form-control:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
        font-size: 1.2rem;
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
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-10 m-0 p-0">Entry Data</h2>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" style="width: fit-content;" id="button-edit">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data">
                    <i class="fa-solid fa-pen-to-square text-white   my-1" style="font-size:21px"></i>
                    <span class="fw-semibold fs-6 my-1">Edit Data</span>
                </div>
            </button>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" id="button-tambah-entry" style="width: fit-content;">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah data peti kemas">
                    <i class="fa-solid fa-circle-plus text-white my-2" style="font-size:25px"></i>
                    <span class="fw-semibold fs-6 my-2">Tambah Baris Baru</span>
                </div>
            </button>
        </div>
        <form method="POST" action="{{ route('transaksi.editentrydata',  $data->id) }}" id="edit-entrydata-form" novalidate>
            @csrf
            <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                <table class="table-variations-3  text-center" id="table_entrydata">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-semibold">No Peti Kemas</th>
                            <th scope="col" class="fw-semibold">Size & Type</th>
                            <th scope="col" class="fw-semibold">Pelayaran</th>
                            <th scope="col" class="fw-semibold">Cetak SPK</th>
                            <th scope="col"></th>
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
                                <select class="form-select mx-auto" name="no_petikemas[]" required style="width: fit-content" disabled>
                                    <option disabled>Pilih Opsi Ini</option>
                                    <option selected value="{{$petikemas->id}}">{{$petikemas->no_petikemas}}</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <input type="text" name="jenis_ukuran" required readonly value="{{$petikemas->jenis_ukuran}}" class="form-control mx-auto" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center" style="width:fit-content">
                                <input type="text" name="pelayaran" required readonly value="{{$petikemas->pelayaran}}" class="form-control mx-auto" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-{{ $pembayaran->status_cetak_spk == 'sudah cetak' && $pembayaran->status_pembayaran == 'sudah lunas' ? 'success disabled' : 'danger' }} text-white rounded-3 {{ $pembayaran->status_pembayaran == 'sudah lunas' ? '' : 'disabled' }}" id="cetak_spk" data-id="{{ $pembayaran->penghubung_id }}" data-status="{{ $pembayaran->status_cetak_spk }}"> {{ $pembayaran->status_cetak_spk }} </a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger text-white rounded-3" id="deleteentrydata" value="{{ $pembayaran->penghubung_id }}"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                            </td>
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-success text-white rounded-3 mx-auto" id="button-submit">Simpan Data</button>
            </div>
        </form>
    </div>
</div>
<x-modal-form-delete route="/transaksi/deleteentrydata" />
@push('transaksi-more-script')
<script>
    $(document).ready(function() {
        const $button_tambah_entry = $("#button-tambah-entry");
        const $button_submit = $("#button-submit");
        const $button_edit = $("#button-edit");
        console.log($("#table_entrydata tbody tr").length)
        $('.tabs').click(function() {
            if ($('#EntryData').hasClass('d-none')) {

                $button_edit.show();
                $button_submit.hide();
                $button_tambah_entry.hide();
                $('select[name="no_petikemas[]"]').prop("disabled", true);
                $('input[name="pelayaran"]').prop("disabled", true);
                $('input[name="jenis_ukuran"]').prop("disabled", true);
                $("#table_entrydata thead tr th:nth-child(4)").show();
                $("#table_entrydata thead tr th:last-child").show();
                $("#table_entrydata tbody tr td:nth-child(4)").show();
                $("#table_entrydata tbody tr td:last-child").show();

            }

        });
        $button_submit.hide();
        $button_tambah_entry.hide();

        function fetchPetikemasOptions($select = null) {
            const selectedValues = $('select[name="no_petikemas[]"]').map(function() {
                return $(this).val();
            }).get();

            const selects = $select ? $select : $('select[name="no_petikemas[]"]');

            selects.each(function() {
                const $selectElement = $(this);
                const originalValue = $selectElement.val();

                $.ajax({
                    url: '/peti-kemas/index',
                    type: 'GET',
                    success: function(response) {
                        $selectElement.empty().append('<option selected disabled>Pilih Opsi Ini</option>');
                        response.AllData.forEach(item => {
                            if (!selectedValues.includes(item.id) || item.id == originalValue) {
                                $selectElement.append(`<option value="${item.id}" ${item.id == originalValue ? 'selected' : ''}>${item.no_petikemas}</option>`);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        }

        function fetchPetikemasDetails($row, value) {
            $.ajax({
                url: '/peti-kemas/index',
                type: 'GET',
                data: {
                    id: value
                },
                success: function(response) {
                    const petikemas = response.DataPetikemas[0];
                    $row.find('input[name="jenis_ukuran"]').val(petikemas.jenis_ukuran);
                    $row.find('input[name="pelayaran"]').val(petikemas.pelayaran);
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }

        // Setiap baris berganti Sudah Cetak ketika ditekan
        $("#table_entrydata tbody tr").each(function(index, row) {
            $(this).find("#cetak_spk").on("click", function(e) {
                $(this).attr('data-status', 'sudah cetak');
                console.log($(this).attr("data-id"));
                $.ajax({
                    url: "{{route('transaksi.cetakspk', $data->id)}}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: $(this).attr("data-status"),
                        id_penghubung: $(this).attr("data-id"),

                    },
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(blob) {
                        var url = window.URL.createObjectURL(blob);
                        window.open(url, '_blank');
                        showAlert('Data Berhasil Dicetak!');
                    },
                    error: function(xhr, status, error) {

                    }
                });
            });
        });

        $button_edit.on("click", function(e) {
            e.preventDefault();
            $('select[name="no_petikemas[]"]').prop("disabled", false);
            $('input[name="pelayaran"]').prop("disabled", false);
            $('input[name="jenis_ukuran"]').prop("disabled", false);
            $button_edit.hide();
            $button_tambah_entry.show();
            $button_submit.show();
            $("#table_entrydata thead tr th:nth-child(4)").hide();
            $("#table_entrydata thead tr th:last-child").hide();
            $("#table_entrydata tbody tr td:nth-child(4)").hide();
            $("#table_entrydata tbody tr td:last-child").hide();
            fetchPetikemasOptions();
        });

        $button_tambah_entry.on("click", function(e) {
            e.preventDefault();
            const newRow = $('<tr>' +
                '<td class="text-center">' +
                '<select class="form-select mx-auto" name="no_petikemas[]" required style="width:fit-content">' +
                '<option selected disabled>Pilih Opsi Ini</option>' + // Add default option here
                '</select>' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="jenis_ukuran" required readonly value="" class="form-control mx-auto" style="width:fit-content">' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="pelayaran" required readonly value="" class="form-control mx-auto" style="width:fit-content">' +
                '<div class="invalid-feedback"></div>' +
                '</td></tr>');

            $("#table_entrydata tbody").append(newRow);
            const $select = newRow.find('select[name="no_petikemas[]"]');
            fetchPetikemasOptions($select);

            $select.on('change', function(e) {
                const value = $(this).val();
                const $row = $(this).closest('tr');
                fetchPetikemasDetails($row, value);
            });
        });

        $('select[name="no_petikemas[]"]').on('change', function() {
            const value = $(this).val();
            const $row = $(this).closest('tr');
            fetchPetikemasDetails($row, value);
        });

        $(document).on('click', '#deleteentrydata', function(e) {
            e.preventDefault();
            $("#form-delete-data").modal('show');
            $("#input_form_delete").val($(this).val());
            console.log($(this).val());
        });

        // Handle form submission
        $('#edit-entrydata-form').on('submit', function(e) {
            e.preventDefault()
            handleFormSubmission(this);
        });

    });
</script>
@endpush