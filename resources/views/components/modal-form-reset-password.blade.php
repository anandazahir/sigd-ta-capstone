<div class="modal fade fade form-modal" tabindex="-1" id="form-reset-password-modal" aria-labelledby="form-delete-data" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa-solid fa-triangle-exclamation text-warning mb-3" style="font-size: 100px;"></i>
                <h4>Apakah Anda Yakin Ingin Mengatur Ulang Kata Sandi?</h4>
                <div class="btn-group gap-2">
                    <form action="/direktur/pegawai/reset-password-pegawai" method="POST" id="form-reset-password">
                        @csrf
                        <input type="hidden" name="id" id="input-form-reset-password">

                        <button type="submit" class="btn btn-danger text-white rounded-3">
                            <div class="d-flex gap-2">
                                <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-resetpassword"></span>
                                <span>Ya</span>
                            </div>
                        </button>
                    </form>
                    <button class="btn bg-primary text-white rounded-3" data-bs-dismiss="modal" aria-label="Close">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#loading-button-resetpassword').hide();

        function showLoadingButton() {
            $('#loading-button-resetpassword').show();
        }

        function hideLoadingButton() {
            $('#loading-button-resetpassword').hide();
        }
        $('#form-reset-password').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            const formData = form.serialize();
            console.log(form.attr('action'));
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                beforeSend: showLoadingButton(),
                success: function(response) {
                    hideLoadingButton();
                    $("#form-reset-password-modal").modal('hide');
                    showAlert(response.message);
                    console.log($('#delete-form').attr('action'));
                },
                error: function(xhr, status, error) {
                    hideLoadingButton();
                }
            });
        });
    });
</script>