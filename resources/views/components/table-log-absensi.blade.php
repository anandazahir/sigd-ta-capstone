<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="show-kerusakan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $text }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="spinner-grow text-primary mx-auto my-auto" style="width: 2rem; height: 2rem;" role="status" id="loading-table-log-absensi">
                    </div>
                </div>
                <h1 class="mx-auto text-center" id="no-data-message3"> </h1>
                <div class="p-1 rounded-4 table-responsive">
                    <table class="table-variations-3 text-center" id="table_log_absensi">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No</th>
                                <th scope="col" class="fw-semibold">Timestamp</th>
                                <th scope="col" class="fw-semibold">Pengubah</th>
                                <th scope="col" class="fw-semibold">Keterangan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // ID harus sesuai antara elemen HTML dan event handler
        let Id = "button-log-absensi-{{$data}}";
        let tableId = "table-log-absensi-{{$data}}";
        let tableID = $("#" + tableId);
        let buttonId = $("#" + Id);
        const $loadingTablelogabsensi = tableID.find('#loading-table-log-absensi');
        $loadingTablelogabsensi.hide();

        function showLoadingSpinner() {
            $loadingTablelogabsensi.show();
            $('#no-data-message3').hide()
            tableID.find('#table_log_absensi').hide();
        }

        function hideLoadingSpinner() {
            $loadingTablelogabsensi.hide();
            tableID.find('#table_log_absensi').show();
        }
        console.log(tableID);
        $(buttonId).on('click', function() {
            var absensihistoryId = $(this).val();
            console.log(absensihistoryId);

            $.ajax({
                url: `/direktur/absensi/log/${absensihistoryId}`,
                method: 'GET',
                beforeSend: showLoadingSpinner(),
                success: function(response) {
                    hideLoadingSpinner();
                    var kerusakanTbody = (tableID).find('#table_log_absensi tbody');
                    kerusakanTbody.empty();
                    console.log(kerusakanTbody);

                    var baseUrl = "{{ asset('storage') }}";
                    response.forEach((item, index) => {
                        
                        var row = `
                                <tr>
                                    <td class="text-center">${index + 1}</td>
                                    <td class="text-center">${item.waktu_perubahan}</td>
                                    <td class="text-center">${item.user}</td>
                                    <td class="text-center">Mengubah Absensi</td>
                                </tr>
                            `;
                        kerusakanTbody.append(row);

                        if (response.message) {
                            var table = (tableID).find('#table_kerusakan_pengecekan');
                            kerusakanTbody.show();
                            table.hide();
                            $('#no-data-message3').show();
                            $('#no-data-message3').text(response.message);
                        }
                    });

                }
            });
        });
    });
</script>
