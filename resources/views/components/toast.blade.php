<div class="modal shadow modal-auto-clear" tabindex="-1" id="toastModal" aria-labelledby="toastModalLabel" data-bs-backdrop="false">
    <div class="modal-dialog modal-sm mt-3">
        <div class=" modal-content">
            <div class="modal-body position-relative p-0 bg-success rounded-3">
                <div class="d-flex gap-2 align-content-center text-center">
                    <div class="bg-white rounded-3 rounded-end-0 p-2" style="width: fit-content; height: fit-content;">
                        <i class="fa-solid fa-check text-success" style="font-size: 30px;"></i>
                    </div>
                    <h5 class="text-white fw-bold my-2 text-center">Data Berhasil Disimpan</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#toastModal').on('show.bs.modal', function() {
            var myModal = $(this);
            clearTimeout(myModal.data('hideInterval'));
            myModal.data('hideInterval', setTimeout(function() {
                myModal.modal('hide');
            }, 1000));
        });
    });
</script>