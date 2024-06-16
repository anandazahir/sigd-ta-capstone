@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="show-kerusakan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $text }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <div class="spinner-grow text-primary mx-auto my-auto" style="width: 2rem; height: 2rem;" role="status" id="loading-table">
                    </div>
                </div>
                <h1 class="mx-auto text-center" id="no-data-message"></h1>
                <div class="p-1 rounded-4 table-responsive">
                    <table class="table-variations-3 text-center" id="table_kerusakan_pengecekan">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No</th>
                                <th scope="col" class="fw-semibold">Lokasi</th>
                                <th scope="col" class="fw-semibold">Komponen</th>
                                <th scope="col" class="fw-semibold">Metode</th>
                                <th scope="col" class="fw-semibold">Status</th>
                                <th scope="col" class="fw-semibold">Foto Pengecekan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody id="kerusakan_tbody">
                            <!-- Data will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@push('table-listkerusakan-script')
<script>
    $(document).ready(function() {
        let Id = "button-listkerusakan-pengecekan-{{$data}}";
        let tableId = "table-kerusakan-pengecekan-{{$data}}";
        let tableID = $("#" + tableId);
        let buttonId = $("#" + Id);
        const $loadingTable = (tableID).find('#loading-table');
        console.log(Id);

        function showLoadingSpinner() {
            $loadingTable.show();
            $('#no-data-message').hide();
            var kerusakanTbody = (tableID).find('#table_kerusakan_pengecekan');
            kerusakanTbody.hide();

        }

        function hideLoadingSpinner() {
            var kerusakanTbody = (tableID).find('#table_kerusakan_pengecekan');
            kerusakanTbody.show();
            $loadingTable.hide();
        }
        console.log(tableID);
        console.log(buttonId);
        $(buttonId).on('click', function() {

            console.log('hai')
            var pengecekanhistoryId = $(this).val();
            console.log(pengecekanhistoryId);
            $.ajax({
                url: `/{{$cleaned}}/peti-kemas/pengecekanhistory/${pengecekanhistoryId}/kerusakan`,
                method: 'GET',
                beforeSend: showLoadingSpinner(),
                success: function(response) {
                    hideLoadingSpinner();
                    var kerusakanTbody = (tableID).find('#table_kerusakan_pengecekan tbody');
                    kerusakanTbody.empty();
                    console.log(kerusakanTbody);
                    (tableID).find('#no-data-message').hide();
                    var baseUrl = "{{ asset('storage') }}";
                    response.forEach((item, index) => {
                        var fotoPengecekan = baseUrl + '/' + item.foto_pengecekan;
                        var row = `
                            <tr>
                                <td class="text-center">${index + 1}</td>
                                <td class="text-center">${item.lokasi_kerusakan}</td>
                                <td class="text-center">${item.komponen}</td>
                                <td class="text-center">${item.metode}</td>
                                <td class="text-center">
                                    <div class="p-1 rounded-2 text-white my-1 ${item.status === 'damage' ? 'bg-danger' : 'bg-primary'}">
                                        <span>${item.status === 'damage' ? 'Damage' : 'Available'}</span>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="my-2" style="height: fit-content">
                                        <a href="${fotoPengecekan}" target="_blank" class="bg-info p-2 rounded-2 text-white text-decoration-none my-auto">Foto</a>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <input type="hidden" name="id_kerusakan" value="${item.id}">
                                    <input type="hidden" name="id_petikemas" value="${item.petikemas_id}">
                                </td>
                            </tr>
                        `;
                        kerusakanTbody.append(row);
                    });
                    if (response.message) {
                        var table = (tableID).find('#table_kerusakan_pengecekan');
                        kerusakanTbody.show();
                        table.hide();
                        $('#no-data-message').show();
                        $('#no-data-message').text(response.message);
                    }
                }
            });
        });
    });
</script>
@endpush