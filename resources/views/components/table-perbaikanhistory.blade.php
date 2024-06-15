@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
$semuaBelumCetak = true;
foreach($data->perbaikanhistories as $penghubung) {
if($penghubung->tanggal_perbaikan) {
$semuaBelumCetak = false;
break;
}
}
@endphp
<div class="modal fade fade form-modal" tabindex="-1" id="form-delete-perbaikanhistory" aria-labelledby="form-delete-perbaikanhistory" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fa-regular fa-circle-xmark text-danger mb-3" style="font-size: 100px;"></i>
                <h4>Apakah Anda Yakin Ingin Menghapus Data?</h4>
                <div class="btn-group gap-2">

                    <form action="/{{$cleaned}}/peti-kemas/perbaikanhistory/deletelistperbaikan" method="POST" id="delete-form-perbaikanhistory">
                        @csrf
                        <input type="hidden" name="id" id="input_form_delete_perbaikanhistory">
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
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Perbaikan</h2>
        <div class="btn bg-white rounded-circle btn date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="date_perbaikanhistory">
        </div>
        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">Data Peti Kemas Belum Lunas / Cetak SPK</h3>
            </div>
            @endif
            <table class="table-variations-3  text-center" id="table_perbaikanhistory">
                <thead>
                    <tr>
                        @foreach ($data->perbaikanhistories as $penghubung)
                        @if ($penghubung->tanggal_perbaikan)
                        <th scope="col" class="fw-semibold">Tanggal Perbaikan</th>
                        <th scope="col" class="fw-semibold">Jumlah Perbaikan</th>
                        <th scope="col" class="fw-semibold">List Perbaikan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Repair</th>
                        <th scope="col" class="fw-semibold"></th>
                        @endif
                        @break
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->perbaikanhistories as $penghubung)
                    @if ($penghubung->tanggal_perbaikan)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{ $penghubung->tanggal_perbaikan }}
                        </td>
                        <td class="text-center">
                            {{ $penghubung->jumlah_perbaikan }}
                        </td>
                        <td class="text-center">
                            <button class="btn bg-primary mx-auto" id="button-listkerusakan-perbaikan-{{ $penghubung->id }}" value="{{ $penghubung->id }}" data-bs-toggle="modal" data-bs-target="#table-kerusakan-perbaikan-{{ $penghubung->id }}">
                                <span class="fs-semibold">LIST PERBAIKAN</span>
                            </button>
                        </td>
                        <td>
                            <span class="{{ $penghubung->status_kondisi == 'available' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{ $penghubung->status_kondisi }}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-1 m-auto">
                            <div class="d-flex gap-1 mx-auto" style="width: fit-content;">
                                <i class="fa-solid fa-circle-user text-primary my-1 fa-l d-none d-lg-block"></i>
                                <span>{{ $penghubung->repair }}</span>
                            </div>
                        </td>
                        @can ('mengelola petikemas')
                        <td class="text-center gap-1">
                            <button class="btn btn-danger text-white rounded-3" id="button_delete_perbaikan" value="{{ $penghubung->id }}">
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



@foreach ($data->perbaikanhistories as $penghubung)
<x-table-listperbaikan data="{{ $penghubung->id }}" id="table-kerusakan-perbaikan-{{ $penghubung->id }}" text="List Perbaikan History | {{ $data->no_petikemas }}" />
@endforeach

<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}"; // Example role, replace with dynamic role value if needed
        $('#date_perbaikanhistory').change(function() {
            $.ajax({
                url: '/{{$cleaned}}/peti-kemas/perbaikanhistory/filter',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tanggal_perbaikanhistory: $(this).val(),
                },
                success: function(response) {
                    $('#table_perbaikanhistory').show();
                    $('#text-error-perbaikanhistory').hide();
                    $('#table_perbaikanhistory tbody').empty();
                    $.each(response.Data, function(index, item) {
                        let deleteButton = '';
                        if (role === 'direktur' || role === 'mops') {
                            deleteButton = `<button class="btn btn-danger text-white p-0 rounded-3" id="button_delete_perbaikanhistory" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                                    <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i>
                                    </button>`;
                        }
                        $('#table_perbaikanhistory tbody').append(
                            '<tr>' +
                            '<td class="text-center m-0 p-0">' + item
                            .tanggal_perbaikan + '</td>' +
                            '<td class="text-center">' + item.jumlah_perbaikan +
                            '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn bg-primary mx-auto" id="button-listkerusakan-perbaikan-' +
                            item.id + '" value="' + item.id +
                            '" data-bs-toggle="modal" data-bs-target="#table-kerusakan-perbaikan-' +
                            item.id + '">' +
                            '<span class="fs-semibold">LIST PERBAIKAN</span>' +
                            '</button>' +
                            '</td>' +
                            '<td>' +
                            '<span class="' + (item.status_kondisi ==
                                'available' ? 'bg-primary' : 'bg-danger') +
                            ' p-1 rounded-2 text-white">' +
                            item.status_kondisi +
                            '</span>' +
                            '</td>' +
                            '<td class="text-center d-flex gap-1">' +
                            '<i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block"></i>' +
                            '<span>' + item.repair + '</span>' +
                            '</td>' +
                            '<td class="text-center gap-1">' +
                            deleteButton +
                            '</td>' +
                            '</tr>'
                        );
                    });

                    // Event handler untuk tombol delete
                    $(document).on('click', '#button_delete_perbaikanhistory', function(e) {
                        e.preventDefault();
                        $("#form-delete-perbaikanhistory").modal('show');
                        $("#input_form_delete_perbaikanhistory").val($(this).val());
                        console.log($(this).val());
                    });

                    if (response.message) {
                        $('#table_perbaikanhistory').hide();
                        $('#text-error-perbaikanhistory').show();
                        $('#text-error-perbaikanhistory').text(response.message);

                    }

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('click', '#button_delete_perbaikan', function(e) {
            e.preventDefault();
            $("#form-delete-perbaikanhistory").modal('show');
            $("#input_form_delete_perbaikanhistory").val($(this).val());
            console.log($(this).val());
        });

        $('#delete-form-perbaikanhistory').submit(function(event) {
            event.preventDefault();
            let form = $(this);
            const formData = form.serialize();
            console.log(form.attr('action'));
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: formData,
                success: function(response) {
                    $("#form-delete-perbaikanhistory").modal('hide');
                    showAlert(response.message);
                    console.log($('#delete-form-perbaikanhistory').attr('action'));
                },
                error: function(xhr, status, error) {

                }
            });
        });
    });
</script>