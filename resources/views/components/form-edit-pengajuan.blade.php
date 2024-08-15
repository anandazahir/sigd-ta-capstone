@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form method="POST" id="edit_form_pengajuan_{{$pengajuan->id}}" action="{{ route($cleaned.'.pengajuan.edit') }}" enctype="multipart/form-data" novalidate data-id="{{$id}}">
    @csrf
    <div class="mb-3 form-group">
        <label for="jenispengajuan" class="form-label">Status Pengajuan</label>
        <select class="form-select" aria-label="Default select example" required name="status">
            <option selected disabled>Plih Opsi Ini</option>
            <option value="acc" {{$pengajuan->status == 'acc' ? 'selected' : ''}}>ACC</option>
            <option value="tolak" {{$pengajuan->status == 'tolak' ? 'selected' : ''}}>TOLAK</option>
            <option value="pending" {{$pengajuan->status == 'pending' ? 'selected' : ''}}>PENDING</option>
        </select>
        <div class="invalid-feedback"></div>
        <input type="hidden" name="id" value="{{$pengajuan->id}}">
    </div>
    <div class="mb-3 form-group">
        <label for="jenispengajuan" class="form-label">Ganti Surat Pengajuan</label>
        <div class="input-group">
            <span class="input-group-text" style="height: fit-content">Pilih File</span>
            <label tabindex="0" class="form-control text-start" style="height:2.3rem" id="myFile_label">
                <span class="file-name">{{ $pengajuan->file_name }}</span>
                <input type="file" name="myfile" id="myfile" class="invisible" accept="application/pdf" style="height:fit-content">
                <input type="hidden" name="myfile_name" value="{{ $pengajuan->file_name  }}">
            </label>
        </div>
        <p class="text-danger" id="error"></p>
    </div>
    <button type="submit" class="btn shadow bg-primary text-white">
        <div class="d-flex gap-2">
            <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-editpengajuan"></span>
            <span>Submit</span>
        </div>
    </button>
</form>


<script>
    $(document).ready(function() {
        let formId = "edit_form_pengajuan_{{$pengajuan->id}}";
        let $form = $("#" + formId);

        $form.find('#loading-button-editpengajuan').hide();

        $("#" + formId).find('input[name="myfile"]').on('change', function() {
            // Get the selected file name
            var fileName = $(this).val().split('\\').pop();
            if (fileName === '') {
                fileName = 'No file chosen';
            }
            // Update the label with the selected file name
            $(this).siblings('input[type="hidden"]').val(fileName);
            $(this).siblings('.file-name').text(fileName);
        });

/*
        $form.submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            var formData = new FormData(this);
            var modalId = $(this).data('id');
           /* $.ajax({
                url: "{{ route($cleaned.'.pengajuan.edit') }}", // Ganti dengan endpoint Anda
                type: 'POST',
                data: formData,
                processData: false, // Mengatur false, karena kita menggunakan FormData
                contentType: false,
                beforeSend: function() {
                    $form.find('#loading-button-editpengajuan').show();
                },
                success: function(response) {
                    $form.find('#loading-button-editpengajuan').hide();

                    // Handle response sukses
                    $('#' + modalId).modal('hide');
                    showAlert(response.message);
                },

                error: function(xhr, status, error) {
                    $form.find('#loading-button-editpengajuan').hide();

                    const errors = xhr.responseJSON.errors;
                    if (xhr.status === 500) {
                        alert("Kolom Unik Tidak Boleh Sama!")
                    } else if (xhr.status === 404) {
                        alert("Data Tidak Ditemukan!");
                    }

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.invalid-feedback').text('');

                    $.each(errors, function(key, value) {
                        const element = $form.find('[name="' + key + '"]');
                        var cleanInputName = key.replace(/\.\d+/g, '');
                        var cleanAngka = value[0].replace(/\.\d+/g, '');
                        if (cleanInputName.includes("name")) {
                            const index = cleanInputName.replace(/_name/i, "");
                            console.log(index);
                            const elements = $form.find('[id="myFile_label"]');
                            console.log(elements);
                            elements.addClass('is-invalid');
                            $('#error').text(cleanAngka);
                        }
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').text(value[0]);
                    });

                }
            });
        });
        */
    });
</script>