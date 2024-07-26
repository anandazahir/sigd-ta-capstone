<style>
    select.disabled:disabled,
    input.disabled:disabled {
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
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp



<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-10 m-0 p-0">Peminjaman</h2>
            @can('mengelola transaksi')
            <button class="btn bg-white p-1 col-lg-2 mt-3 mt-lg-0" style="width: fit-content;" id="button-edit">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Mengubah data">
                    <i class="fa-solid fa-pen-to-square text-primary   my-1" style="font-size:21px"></i>
                    <span class="fw-semibold fs-6 my-1 text-primary">Edit Data</span>
                </div>
            </button>

            <button class="btn bg-white p-1 col-lg-2 mt-3 mt-lg-0" id="button-tambah-entry" style="width: fit-content;">
                <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah data peti kemas">
                    <i class="fa-solid fa-circle-plus text-primary my-2" style="font-size:25px"></i>
                    <span class="fw-semibold fs-6 my-2 text-primary">Tambah Baris Baru</span>
                </div>
            </button>
            @endcan
        </div>

        
        @php
        $count = $data->pembayaran->where('status_cetak_spk','belum cetak')->count();
        @endphp
        @if ($count > 0)
        <div class="alert alert-info rounded-3 mt-2 position-relative p-0 d-flex alert-dismissible fade show" style="height:3.5rem">
            <div class="bg-info rounded-3 rounded-end-0 p-2 position-absolute z-1 d-flex h-100" style="width: 9.5vh;">
                <i class="fa-solid fa-circle-info text-white mx-auto my-auto" style="font-size: 25px;"></i>

            </div>
          
            <p class="my-3" style="margin-left:80px;"><strong>INFO!</strong> Terdapat <b>{{$count}} Peti kemas</b> yang belum cetak SPK</p>
            
            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
       
        <form method="POST" @can ('mengelola transaksi') action="{{ route($cleaned . '.transaksi.editentrydata', $data->id) }}" @endcan id="edit-entrydata-form" novalidate>
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
                                <select class="form-select mx-auto disabled" name="no_petikemas[]" required style="width: fit-content" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();" disabled>
                                    <option disabled>Pilih Opsi Ini</option>
                                    <option selected value="{{$petikemas->id}}">{{$petikemas->no_petikemas}}</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <input type="text" name="jenis_ukuran" required readonly value="{{$petikemas->jenis_ukuran}}" class="form-control mx-auto disabled" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center" style="width:fit-content">
                                <input type="text" name="pelayaran" required readonly value="{{$petikemas->pelayaran}}" class="form-control mx-auto disabled" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <a class="btn bg-{{ $pembayaran->status_cetak_spk == 'sudah cetak' && $pembayaran->status_pembayaran == 'sudah lunas' ? 'primary disabled' : 'danger' }} text-white rounded-3 {{ $pembayaran->status_pembayaran == 'sudah lunas' ? '' : 'disabled' }}" id="cetak_spk" data-id="{{ $pembayaran->penghubung_id }}" data-status="{{ $pembayaran->status_cetak_spk }}">
                                    <div class="d-flex gap-2">
                                        <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-spk"></span>
                                        <span>{{ $pembayaran->status_cetak_spk }}</span>

                                    </div>
                                </a>
                            </td>
                            @can('mengelola transaksi')
                            <td class="text-center">
                                <button class="btn btn-danger text-white rounded-3" id="deleteentrydata" value="{{ $pembayaran->penghubung_id }}"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                            </td>
                            @endcan
                        </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>
            @can('mengelola transaksi')
            <div class="mt-3 text-center">
                <button type="submit" class="btn btn-info text-white rounded-3 mx-auto" id="button-submit">
                    <div class="d-flex gap-2">
                        <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-entrydata"></span>
                        <span class="fw-semibold text-white">Simpan Data</span>
                    </div>
                </button>
            </div>
            @endcan
        </form>

    </div>
</div>
@can('mengelola transaksi')
<x-modal-form-delete route="/{{$cleaned}}/transaksi/deleteentrydata" />
@endcan

@push('table-entrydata')
<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}";
        if (role == 'direktur' || role == 'mops') {
            const $button_tambah_entry = $("#button-tambah-entry");
            const jenis_kegiatan = "{{$data->jenis_kegiatan}}";
            const $button_submit = $("#button-submit");
            const $button_edit = $("#button-edit");
            console.log($("#table_entrydata tbody tr").length);

            $('.tabs').click(function() {
                if ($('#EntryData').hasClass('d-none')) {
                    $button_edit.show();
                    $button_submit.hide();
                    $button_tambah_entry.hide();

                    $('select[name="no_petikemas[]"]').addClass("disabled");
                    $('input[name="pelayaran"]').addClass("disabled");
                    $('select[name="no_petikemas[]"]').prop("disabled", true);
                    $('input[name="jenis_ukuran"]').addClass("disabled");
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
                        url: "{{ route($cleaned . '.petikemas.filter') }}",
                        type: 'GET',
                        data: {
                            jenis_transaksi: jenis_kegiatan,
                        },
                        success: function(response) {
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
                    url: "{{ route($cleaned . '.petikemas.filter') }}",
                    type: 'GET',
                    data: {
                        id: value,
                        jenis_transaksi: jenis_kegiatan,
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
            console.log("hai");
            $button_edit.on("click", function(e) {
                e.preventDefault();
                $('select[name="no_petikemas[]"]').prop("disabled", false);
                $('select[name="no_petikemas[]"]').removeClass("disabled");
                $('input[name="pelayaran"]').removeClass("disabled");
                $('input[name="jenis_ukuran"]').removeClass("disabled");
                $button_edit.hide();
                $button_tambah_entry.show();
                $button_submit.show();
                $("#table_entrydata thead tr th:nth-child(4)").hide();
                $("#table_entrydata thead tr th:last-child").hide();
                $("#table_entrydata tbody tr td:nth-child(4)").hide();
                $("#table_entrydata tbody tr td:last-child").hide();
                fetchPetikemasOptions();
            });
            $('#loading-button-entrydata').hide();


            $button_tambah_entry.on("click", function(e) {
                e.preventDefault();
                const newRow = $('<tr>' +
                    '<td class="text-center">' +
                    '<select class="form-select mx-auto" name="no_petikemas[]" required style="width:fit-content" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">' +
                    '<option selected disabled>Pilih Opsi Ini</option>' +
                    '</select>' +
                    '<div class="invalid-feedback"></div>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<input type="text" name="jenis_ukuran" required disabled value="" class="form-control mx-auto" style="width:fit-content">' +
                    '<div class="invalid-feedback"></div>' +
                    '</td>' +
                    '<td class="text-center">' +
                    '<input type="text" name="pelayaran" required disabled value="" class="form-control mx-auto" style="width:fit-content">' +
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

            $('#edit-entrydata-form').on('submit', function(e) {
                e.preventDefault();
                handleFormSubmission(this);
            });
        }
        $("#table_entrydata tbody tr").each(function(index, row) {
            $(this).find('#loading-button-spk').hide()

            function showLoadingButton() {
                $(this).find('#loading-button-spk').show();

            }

            function hideLoadingButton() {
                $(this).find('#loading-button-spk').hide();

            }
            $(this).find("#cetak_spk").on("click", function(e) {
                $(this).attr('data-status', 'sudah cetak');
                console.log($(this).attr("data-id"));

                $.ajax({
                    url: "{{ route($cleaned . '.transaksi.cetakspk', $data->id) }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: $(this).attr("data-status"),
                        id_penghubung: $(this).attr("data-id"),
                    },
                    beforeSend: showLoadingButton(),
                    xhrFields: {
                        responseType: 'blob'
                    },
                    success: function(blob) {
                        hideLoadingButton();
                        var url = window.URL.createObjectURL(blob);
                        window.open(url, '_blank');
                        showAlert('Data Berhasil Dicetak!');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    });
</script>

@endpush