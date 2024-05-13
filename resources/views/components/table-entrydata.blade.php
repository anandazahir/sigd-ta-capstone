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
</style>
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
                        @foreach ($data->petikemas as $item)
                        <tr>
                            <td class="text-center">
                                <select class="form-select mx-auto" name="no_petikemas[]" required style="width: fit-content" disabled>
                                    <option disabled>Pilih Opsi Ini</option>
                                    <option selected value="{{$item->id}}">{{$item->no_petikemas}}</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <input type="text" name="jenis_ukuran" required readonly value="{{$item->jenis_ukuran}}" class="form-control mx-auto" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center" style="width:fit-content">
                                <input type="text" name="pelayaran" required readonly value="{{$item->pelayaran}}" class="form-control mx-auto" style="width:fit-content" disabled>
                                <div class="invalid-feedback"></div>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-danger text-white rounded-3" href="https://getbootstrap.com/docs/5.3/components/buttons/#disabled-state" id="cetak_spk" target="_blank"> Belum Cetak</a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger text-white rounded-3"> <i class="fa-solid fa-trash-can fa-lg my-1"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <button type="submit" class="btn btn-success text-white rounded-3 mt-3" id="button-submit"> Simpan Data</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        const $button_tambah_entry = $("#button-tambah-entry");
        const $button_submit = $("#button-submit");
        const $select_no_petikemas = $('select[name="no_petikemas[]"]');
        const $input_pelayaran = $('input[name="pelayaran"]');
        const $input_jenis_ukuran = $('input[name="jenis_ukuran"]');
        const $headercolumnhidden = $('#table_entrydata thead  tr th:nth-child(4)');
        const $columnhidden = $('#table_entrydata tbody  tr td:nth-child(4)');
        const $button_edit = $("#button-edit");

        $button_tambah_entry.hide();
        $button_submit.hide();

        $button_edit.on("click", function(e) {
            e.preventDefault();
            $select_no_petikemas.prop("disabled", false);
            $input_pelayaran.prop("disabled", false);
            $input_jenis_ukuran.prop("disabled", false);
            $button_edit.hide();
            $button_tambah_entry.show();
            $button_submit.show();
            $headercolumnhidden.hide();
            $columnhidden.hide();
            $("#table_entrydata tbody tr").each(function() {
                const $select = $(this).find($select_no_petikemas);
                $select.on('change', function(e) {
                    const value = $(this).val();
                    fetchPetikemasOptions($select_no_petikemas, $input_jenis_ukuran, $input_pelayaran, value);
                });
            });
            fetchPetikemasOptions($select_no_petikemas, $input_jenis_ukuran, $input_pelayaran);
        });
        $button_tambah_entry.on("click", function(e) {
            e.preventDefault();
            const newRow = $('<tr>' +
                '<td class="text-center">' +
                '<select class="form-select" name="no_petikemas[]" required>' +
                '<option selected disabled>Pilih Opsi Ini</option>' + // Add default option here
                '</select>' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="jenis_ukuran" required readonly value="" class="form-control">' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="pelayaran" required readonly value="" class="form-control">' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '</tr>');
            $("#table_entrydata tbody").append(newRow);
            const $select = newRow.find('select[name="no_petikemas[]"]');
            const $input = newRow.find('input[name="jenis_ukuran"]');
            const $input_2 = newRow.find('input[name="pelayanan"]');
            newRow.find('select[name="no_petikemas[]"]').on('change', function(e) {
                var value = $(this).val();
                fetchPetikemasOptions($select, $input, $input_2, value);
            });
            fetchPetikemasOptions($select, $input, $input_2);
        });

        function fetchPetikemasOptions($select_, $input_, $input2_, value) {
            $.ajax({
                url: '/peti-kemas/index',
                type: 'GET',
                data: {
                    id: value
                },
                success: function(response) {
                    const selectValuesArray = [];
                    console.log($("#table_entrydata tbody tr").find($input_jenis_ukuran).length)
                    $("#table_entrydata tbody tr").each(function() {
                        const $row = $(this);
                        const $select = $row.find($select_);
                        const $inputjenis_ukuran = $row.find($input_);
                        const $inputpelayaran = $row.find($input2_);
                        const selectval = $select.val();
                        selectValuesArray.push(selectval);
                        $.each(response.Data, function(index, item) {
                            const selected = (item.id == selectValuesArray[index]) ? 'selected' : '';
                            $select.append('<option value="' + item.id + '" ' + selected + '>' + item.no_petikemas + '</option>');

                        });
                        if ((response.count) !== (($select.find('option').length) - 1)) {
                            $select.children(':nth-child(2)').remove();
                        }


                        $.each(response.DataPetikemas, function(index, item) {
                            $inputjenis_ukuran.val(item.jenis_ukuran);
                            $inputpelayaran.val(item.pelayaran);
                        });
                    });

                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });
</script>