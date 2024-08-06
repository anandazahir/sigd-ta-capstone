@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp

<form method="POST" id="create_form_pengecekan" action="{{ route($cleaned.'.transaksi.storepengecekan') }}" enctype="multipart/form-data" novalidate>
    @csrf
    @foreach ($data->penghubungs as $penghubung)
    @if (
    $penghubung->pembayaran->status_pembayaran === 'belum lunas' &&
    $penghubung->pembayaran->status_cetak_spk === 'belum cetak' )
    <div class="alert alert-warning rounded-3 mt-2 position-relative p-0 d-flex alert-dismissible fade show" style="height:3.5rem">
        <div class="bg-warning rounded-3 rounded-end-0 p-2 position-absolute z-1 d-flex h-100" style="width: 9.5vh;">

            <i class="fa-solid fa-triangle-exclamation text-white mx-auto my-auto" style="font-size: 25px;"></i>
        </div>
        <p class="my-3" style="margin-left:80px;"><strong>PERINGATAN!</strong> Mohon Untuk Melunasi / Mencetak SPK Data Peti kemas</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    @break
    @endforeach
    @php
    $count = $data->pengecekan->where('survey_in', '' )->count();
    @endphp
    
    <div class="alert alert-info rounded-3 mt-2 position-relative p-0 d-flex alert-dismissible fade show" style="height:3.5rem">
            <div class="bg-info rounded-3 rounded-end-0 p-2 position-absolute z-1 d-flex h-100" style="width: 9.5vh;">
                <i class="fa-solid fa-circle-info text-white mx-auto my-auto" style="font-size: 25px;"></i>

            </div>
          
            <p class="my-3" style="margin-left:80px;"><strong>INFO!</strong> Terdapat <b>{{$count}} Peti kemas</b> yang belum dicek</p>
            
            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
 

    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="no peti kemas" class="form-label">No Peti Kemas</label>
            <select name="no_petikemas" class="form-select" id="id_penghubung" aria-label="Default select example" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($data->penghubungs as $penghubung)
                @if (
                $penghubung->pembayaran->status_pembayaran === 'sudah lunas' &&
                $penghubung->pembayaran->status_cetak_spk === 'sudah cetak' &&
                $penghubung->pengecekan->survey_in === null)
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}" data-url-spk="{{$penghubung->pembayaran->url_file}}">
                    {{ $penghubung->petikemas->no_petikemas }}
                </option>
                @endif
                @endforeach
            </select>
            <div class="invalid-feedback"></div>
            <a style="background-color: transparent; border:none;" class="text-info" id="button-spk" href="">Lihat SPK</a>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="jenis_ukuran_pengecekan" placeholder="Size & Type" name="jenis_ukuran_pengecekan" required disabled>
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlahkerusakan2" placeholder="Jumlah Kerusakan" name="jumlah_kerusakan" required value="0">
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <h5 id="text-between">List Kerusakan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_create_pengecekan">
            <thead>
                <tr>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Component</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Foto Pengecekan</th>
                </tr>
            </thead>
            <tbody>

            </tbody>

        </table>
    </div>
    <button type="submit" class="btn bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-createpengecekan"></span>
            <span>Submit</span>

        </div>
    </button>
</form>


<script>
    $(document).ready(function() {

        $("#table_create_pengecekan").hide();
        $("#text-between").hide();
        $('#loading-button-createpengecekan').hide();
        const loadingButton = $('#loading-button-createpengecekan');
        $("#jumlahkerusakan2").on("change", function() {
            var rowCount = parseInt($(this).val());
            if (rowCount > 0) {
                $("#table_create_pengecekan").show();
                $("#text-between").show();
                $("#table_create_pengecekan tbody").empty();

                for (var i = 0; i < rowCount; i++) {
                    let rowObject = $('<tr>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text" name="lokasi_kerusakan[]"> ' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input class="form-control" type="text" name="komponen[]"> ' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input type="hidden" name="metode_value[]"/>' +
                        '<select class="form-select"  name="metodes[]" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">' +
                        '<option selected disabled>Open this select menu</option>' +
                        '<option value="1">One</option>' +
                        '<option value="2">Two</option>' +
                        '<option value="3">Three</option>' +
                        '</select>' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>' +
                        '<td class="text-center">' +
                        '<input type="hidden" name="foto_pengecekan_name[]">' +
                        
                        '<input type="file" name="foto_pengecekan[]" id="" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                        '<div class="invalid-feedback"></div>' +
                        '<div class="text-start form-label"><label >min: 2048 KB</label></div>'+
                        
                        '</td>' +
                        '</tr>');
                    $("#table_create_pengecekan tbody").append(
                        rowObject); // Append new rows using rowObject as a template
                }
                $('input[type="file"][name="foto_pengecekan[]"]').on('change', function() {
                    // Get the selected file name
                    var fileName = $(this).val().split('\\').pop();
                    console.log(fileName);
                    // Update the label with the selected file name
                    $(this).siblings('input[type="hidden"]').val(fileName);
                });
                $('select[name="metodes[]"]').on('change', function() {
                    // Get the selected file name
                    var selectedOptionval = $(this).find('option:selected').val();
                    console.log(selectedOptionval);
                    // Update the label with the selected file name
                    $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                });
            } else {
                $("#table_create_pengecekan").hide();
                $("#table_create_pengecekan tbody").empty();
                $("#text-between").hide();
            }
        });

        $('#id_penghubung').change(function(e) {
            e.preventDefault();
            var selectedOption = $(this).find('option:selected');
            var jenisUkuran = selectedOption.data('jenis-ukuran');
            $('#jenis_ukuran_pengecekan').val(jenisUkuran || '');
            var urlFile = selectedOption.data('url-spk');
            console.log(urlFile);
         
            $('#button-spk').attr('href', urlFile);
        });


        $("#create_form_pengecekan").submit(function(
            event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            const selectedOption = $(
                "#id_penghubung option:selected"); // Select the selected option using jQuery
            if (selectedOption.length) {
                selectedOption.attr("data-submit-check", "sudah submit"); // Remove the selected option
            }

            var formData = new FormData(this);
            $.ajax({
                url: "{{ route($cleaned.'.transaksi.storepengecekan') }}", // Ganti dengan endpoint Anda
                type: 'POST',
                data: formData,
                processData: false, // Mengatur false, karena kita menggunakan FormData
                contentType: false,
                beforeSend: function() {
                    loadingButton.show();
                },
                success: function(response) {
                    // Handle response sukses
                    $('#create-pengecekan-modal').modal('hide');
                    showAlert(response.message);
                    console.log('Success:', response);
                },

                error: function(xhr, status, error) {
                    loadingButton.hide();
                    const errors = xhr.responseJSON.errors;
                    if (xhr.status === 500) {
                        alert("Kolom Unik Tidak Boleh Sama!")
                    } else if (xhr.status === 404) {
                        alert("Data Tidak Ditemukan!");
                    }

                    $('#create_form_pengecekan').find('.is-invalid').removeClass('is-invalid');
                    $('#create_form_pengecekan').find('.invalid-feedback').text('');

                    $.each(errors, function(key, value) {
                        const element = $('#create_form_pengecekan').find('[name="' + key + '"]');


                        var cleanInputName = key.replace(/\.\d+/g, '');
                        var cleanAngka = value[0].replace(/\.\d+/g, '');
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').text(value[0]);
                        console.log(key + '[]');
                        const elementArray = $('#create_form_pengecekan').find('[name="' + cleanInputName + '[]"]');
                        elementArray.addClass('is-invalid');
                        elementArray.next('.invalid-feedback').text(cleanAngka);
                    });

                }
            });
        });

    });
</script>