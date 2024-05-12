<div class="modal fade fade form-modal" tabindex="-1" id="{{$id}}" aria-labelledby="create-transaksi" aria-hidden="true">
    <div class="modal-dialog {{$size}} modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{$slot}}
            </div>
        </div>
    </div>
</div>
<script>
    function handleFormSubmission(formElement) {
        event.preventDefault();
        let form = $(formElement);
        const formData = form.serialize();
        const modalId = "#" + form.closest('.form-modal').attr('id');
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: formData,
            success: function(response) {
                $(modalId).modal('hide');
                console.log(response.message);
                showAlert(response.message);
            },
            error: function(xhr, status, error) {
                const errors = xhr.responseJSON.errors;
                if (xhr.status === 500) {
                    alert("Kolom Unik Tidak Boleh Sama!")
                } else if (xhr.status === 404) {
                    alert("Data Tidak Ditemukan!");
                }

                form.find('.is-invalid').removeClass('is-invalid');
                form.find('.invalid-feedback').text('');

                $.each(errors, function(key, value) {
                    const element = form.find('[name="' + key + '"]');
                    element.addClass('is-invalid');
                    element.next('.invalid-feedback').text(value[0]);
                    const elementArray = form.find('[name="' + key + '[]"]');
                    elementArray.addClass('is-invalid');
                    elementArray.next('.invalid-feedback').text(value[0]);
                });

            }
        });
    }
</script>