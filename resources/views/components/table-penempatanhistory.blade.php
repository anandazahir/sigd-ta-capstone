@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
$semuaBelumCetak = true;
foreach($data->penempatanhistories as $penghubung) {
if($penghubung->tanggal_penempatan) {
$semuaBelumCetak = false;
break;
}
}
@endphp
<div class="modal fade fade form-modal" tabindex="-1" id="form-delete-penempatanhistory" aria-labelledby="form-delete-penempatanhistory" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa-regular fa-circle-xmark text-danger mb-3" style="font-size: 100px;"></i>
                <h4>Apakah Anda Yakin Ingin Menghapus Data?</h4>
                <div class="btn-group gap-2">

                    <form action="{{$cleaned}}/peti-kemas/penempatanhistory/deletelistpenempatan" method="POST" id="delete-form-penempatanhistory">
                        @csrf
                        <input type="hidden" name="id" id="input_form_delete_penempatanhistory">
                        <button type="submit" class="btn btn-danger text-white rounded-3">Ya</button>
                    </form>
                    <button class="btn bg-primary text-white rounded-3" data-bs-dismiss="modal" aria-label="Close">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container position-relative">
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Penempatan</h2>
        <div class="btn bg-white rounded-circle btn date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="date_penempatanhistory">
        </div>
        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">Data Peti Kemas Belum Lunas / Cetak SPK</h3>
            </div>
            @endif
            <table class="table-variations-3  text-center" id="table_penempatanhistory">
                <thead>
                    <tr>
                        @foreach ($data->penempatanhistories as $penghubung)
                        @if ($penghubung->tanggal_penempatan)
                        <th scope="col" class="fw-semibold">Tanggal Penempatan</th>
                        <th scope="col" class="fw-semibold">Lokasi</th>
                        <th scope="col" class="fw-semibold">Operator Berat</th>
                        <th scope="col" class="fw-semibold">Status Ketersediaan</th>
                        <th scope="col" class="fw-semibold">Tally</th>
                        <th scope="col" class="fw-semibold"></th>
                        @endif
                        @break
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->penempatanhistories as $penghubung)
                    @if ($penghubung->tanggal_penempatan)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{ $penghubung->tanggal_penempatan }}
                        </td>
                        <td class="text-center">
                            {{ $penghubung->lokasi }}
                        </td>
                        <td class="text-center">
                            {{ $penghubung->operator_alat_berat }}
                        </td>
                        <td>
                            <span class="{{ $penghubung->status_ketersediaan == 'in' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{ $penghubung->status_ketersediaan }}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-1">
                            <i class="fa-solid fa-circle-user text-primary my-1 fa-l d-none d-lg-block"></i>
                            <span>{{ $penghubung->tally }}</span>
                        </td>
                        @can ('mengelola petikemas')
                        <td class="text-center gap-1">
                            <button class="btn btn-danger text-white rounded-3" id="button_delete_penempatan" value="{{ $penghubung->id }}">
                                <i class="fa-solid fa-trash-can fa-lg my-1"></i>
                            </button>
                        </td>
                        @endcan
                    </tr>
                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}";
        $('#date_penempatanhistory').change(function() {
            $.ajax({
                url: '/{{$cleaned}}/peti-kemas/penempatanhistory/filter',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tanggal_penempatanhistory: $(this).val(),
                },
                success: function(response) {
                    $('#table_penempatanhistory').show();
                    $('#text-error-penempatanhistory').hide();
                    $('#table_penempatanhistory tbody').empty();
                    $.each(response.Data, function(index, item) {
                        let deleteButton = '';
                        if (role === 'direktur' || role === 'mops') {
                            deleteButton = '<button class="btn btn-danger text-white rounded-3" id="button_delete_penempatanhistory" value="' +
                                item.id + '">' +
                                '<i class="fa-solid fa-trash-can fa-lg my-1"></i>' +
                                '</button>';
                        }
                        $('#table_penempatanhistory tbody').append(
                            '<tr>' +
                            '<td class="text-center m-0 p-0">' + item
                            .tanggal_penempatan + '</td>' +
                            '<td class="text-center">' + item.lokasi +
                            '</td>' +
                            '<td class="text-center">' + item.operator_alat_berat +
                            '</td>' +
                            '<td>' +
                            '<span class="' + (item.status_ketersediaan ==
                                'in' ? 'bg-primary' : 'bg-danger') +
                            ' p-1 rounded-2 text-white">' +
                            item.status_ketersediaan +
                            '</span>' +
                            '</td>' +
                            '<td class="text-center d-flex gap-1">' +
                            '<i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>' +
                            '<span>' + item.tally + '</span>' +
                            '</td>' +
                            '<td class="text-center gap-1">' +
                            deleteButton +
                            '</td>' +
                            '</tr>'
                        );
                    });

                    // Event handler untuk tombol delete
                    $(document).on('click', '#button_delete_penempatanhistory', function(e) {
                        e.preventDefault();
                        $("#form-delete-penempatanhistory").modal('show');
                        $("#input_form_delete_penempatanhistory").val($(this).val());
                        console.log($(this).val());
                    });

                    if (response.message) {
                        $('#table_penempatanhistory').hide();
                        $('#text-error-penempatanhistory').show();
                        $('#text-error-penempatanhistory').text(response.message);

                    }

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('click', '#button_delete_penempatan', function(e) {
            e.preventDefault();
            $("#form-delete-penempatanhistory").modal('show');
            $("#input_form_delete_penempatanhistory").val($(this).val());
            console.log($(this).val());
        });

        $('#delete-form-penempatanhistory').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            const formData = form.serialize();
            console.log(form.attr('action'));
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    $("#form-delete-penempatanhistory").modal('hide');
                    showAlert(response.message);
                    console.log($('#delete-form-penempatanhistory').attr('action'));
                },
                error: function(xhr, status, error) {

                }
            });
        });
    });
</script>