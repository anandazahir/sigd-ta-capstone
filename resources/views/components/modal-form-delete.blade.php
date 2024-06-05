<div class="modal fade fade form-modal" tabindex="-1" id="form-delete-data" aria-labelledby="form-delete-data" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa-regular fa-circle-xmark text-danger mb-3" style="font-size: 100px;"></i>
                <h4>Apakah Anda Yakin Ingin Menghapus Data?</h4>
                <div class="btn-group gap-2">
                    <form action="{{ $route }}" method="POST" id="delete-form">
                        @csrf
                        <input type="hidden" name="id" id="input_form_delete">
                        <button type="submit" class="btn btn-danger text-white rounded-3">Ya</button>
                    </form>
                    <button class="btn bg-primary text-white rounded-3" data-bs-dismiss="modal" aria-label="Close">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push ('form-delete')

<script>
    $(document).ready(function() {
        $('#delete-form').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            const formData = form.serialize();
            console.log(form.attr('action'));
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    $("#form-delete-data").modal('hide');
                    showAlert(response.message);
                    console.log($('#delete-form').attr('action'));
                },
                error: function(xhr, status, error) {

                }
            });
        });
    });
</script>
@endpush