<div class="alert alert-success d-flex align-items-center position-absolute top-0 start-50 translate-middle-x d-none" role="alert" style="width: fit-content; padding:0px 10px 0px 0px; margin:10px;" id="alertContainer">
    <div class="d-flex gap-2 align-content-center text-center">
        <div class="bg-white rounded-3 rounded-end-0 p-2" style="width: fit-content; height: fit-content;">
            <i class="fa-solid fa-check text-success" style="font-size: 30px;"></i>
        </div>
        <h5 class="text-black fw-bold my-2 text-center" id="session-text"></h5>
    </div>
</div>
<script>
    function showAlert(text) {
        let alertContainer = $("#alertContainer");
        $("#session-text").text(text)
        alertContainer.removeClass('d-none').addClass('d-block');
        setTimeout(function() {
            location.reload();
        }, 1000);
    }
</script>