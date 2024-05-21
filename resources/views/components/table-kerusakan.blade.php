<div class="modal fade fade " tabindex="-1" id="show-kerusakan" aria-labelledby="show-kerusakan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">List Kerusakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="input_id_penghubung"></input>
                <div class="p-1 rounded-4  table-responsive" style="height: rem;">
                    <table class="table-variations-3  text-center" id="table_kerusakan_pengecekan">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No</th>
                                <th scope="col" class="fw-semibold">Lokasi</th>
                                <th scope="col" class="fw-semibold">Component</th>
                                <th scope="col" class="fw-semibold">Metode</th>
                                <th scope="col" class="fw-semibold">Status</th>
                                <th scope="col" class="fw-semibold">Foto Pengecekan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(document).on('click', '#button_listkerusakan_pengecekan', function(e) {
            e.preventDefault();
            $("#show-kerusakan").modal('show');
            $("#show-kerusakan").find(".modal-title").text("List Kerusakan | No.Petikemas " + $(this).data("nopetikemas"));
            $('#table_kerusakan_pengecekan tbody tr').empty();
            $("#input_id_penghubung").val($(this).val());
            $.ajax({
                url: '/transaksi/indexkerusakan',
                type: 'POST',
                data: {
                    id_pengecekan: $("#input_id_penghubung").val(),
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {

                    $.each(response.kerusakan, function(index, item) {
                        var i = 1;
                        var fotoLink = '{{ asset("storage/") }}' + '/' + item.foto_pengecekan;
                        var statusClass = item.status === 'damage' ? 'bg-danger' : 'bg-success';
                        var newRow = '<tr>' +
                            '<td class="text-center">' + (index + 1) + '</td>' +
                            '<td class="text-center">' + item.lokasi_kerusakan + '</td>' +
                            '<td class="text-center">' + item.komponen + '</td>' +
                            '<td class="text-center">' + item.metode + '</td>' +
                            '<td>' +
                            '<div class="' + statusClass + ' p-1 rounded-2 text-white my-1">' +
                            '<span>' + item.status + '</span>' +
                            '</div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<div class="my-2" style="height: fir-content">' +
                            '<a href="' + fotoLink + '" target="_blank" class="bg-info p-2 rounded-2 text-white text-decoration-none my-auto">Foto</a>' +
                            '</td>' +
                            '</div>' +
                            '<td class="text-center">' +
                            '<a class="btn btn-danger text-white rounded-3" value="' + item.id + '"> <i class="fa-solid fa-trash-can fa-lg my-1"></i></a>' +
                            '</td>' +
                            '</tr>';
                        $('#table_kerusakan_pengecekan').append(newRow);
                    });
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

    });
</script>