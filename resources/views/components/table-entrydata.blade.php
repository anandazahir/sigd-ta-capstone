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
        const $button_edit = $("#button-edit");
    
        $button_tambah_entry.hide();
        $button_submit.hide();
    
        function fetchPetikemasOptions() {
            const selectedValues = [];
            $select_no_petikemas.each(function() {
                const value = $(this).val();
                if (value) {
                    selectedValues.push(value);
                }
            });
    
            $select_no_petikemas.each(function() {
                const $select = $(this);
                const originalValue = $select.val(); // Menyimpan nilai asli
                $select.empty().append('<option selected disabled>Pilih Opsi Ini</option>'); // Mengosongkan dan menambahkan opsi default
                $.ajax({
                    url: '/peti-kemas/index',
                    type: 'GET',
                    success: function(response) {
                        $.each(response.Data, function(index, item) {
                            if (!selectedValues.includes(item.id.toString()) || originalValue == item.id) {
                                const selected = (originalValue == item.id) ? 'selected' : ''; // Memeriksa apakah nilai sama dengan nilai asli
                                $select.append('<option value="' + item.id + '" ' + selected + '>' + item.no_petikemas + '</option>');
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        }
    
        $button_edit.on("click", function(e) {
            e.preventDefault();
            $select_no_petikemas.prop("disabled", false);
            $input_pelayaran.prop("disabled", false);
            $input_jenis_ukuran.prop("disabled", false);
            $button_edit.hide();
            $button_tambah_entry.show();
            $button_submit.show();
            fetchPetikemasOptions();
        });

        $button_tambah_entry.on("click", function(e) {
            e.preventDefault();
            const newRow = $('<tr>' +
                '<td class="text-center">' +
                '<select class="form-select mx-auto" name="no_petikemas[]" required  style="width:fit-content">' +
                '<option selected disabled>Pilih Opsi Ini</option>' + // Add default option here
                '</select>' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="jenis_ukuran" required readonly value="" class="form-control mx-auto" style="width:fit-content">' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<input type="text" name="pelayaran" required readonly value="" class="form-control mx-auto"  style="width:fit-content">' +
                '<div class="invalid-feedback"></div>' +
                '</td>' +
                '<td class="text-center">' +
                '<button class="btn btn-danger text-white rounded-3"> <i class="fa-solid fa-trash-can fa-lg my-1"></i></button>' +
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
    
        $select_no_petikemas.each(function() {
            const $select = $(this);
            $select.on('change', function(e) {
                const value = $(this).val();
                const $row = $(this).closest('tr');
                fetchPetikemasOptions();
                fetchPetikemasDetails($row, value);
            });
        });
    
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
    });
    
</script>