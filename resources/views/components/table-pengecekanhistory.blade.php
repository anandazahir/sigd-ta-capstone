<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container position-relative">
        <h2 class="text-white fw-semibold">Riwayat Pengecekan</h2>
        <div class="btn bg-white rounded-circle btn date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="date_pengecekanhistory">
        </div>
        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            <h1 class="text-center mt-3 text-black" id="text-error"></h1>
            <table class="table-variations-3  text-center" id="table_pengecekanhistory">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Survey In</th>
                        <th scope="col" class="fw-semibold"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->pengecekanhistories as $penghubung)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{ $penghubung->tanggal_pengecekan }}
                        </td>
                        <td class="text-center">
                            {{ $penghubung->jumlah_kerusakan }}
                        </td>
                        <td class="text-center">
                            <button class="btn bg-primary mx-auto" id="button-listkerusakan-pengecekan-{{ $penghubung->id }}" value="{{ $penghubung->id }}" data-bs-toggle="modal" data-bs-target="#table-kerusakan-pengecekan-{{ $penghubung->id }}">
                                <span class="fs-semibold">LIST KERUSAKAN</span>
                            </button>
                        </td>
                        <td>
                            <span class="{{ $penghubung->status_kondisi == 'available' ? 'bg-primary' : 'bg-danger' }} p-1 rounded-2 text-white">
                                {{ $penghubung->status_kondisi }}
                            </span>
                        </td>
                        <td class="text-center ">
                            <div class="d-flex gap-1 mx-auto" style="width: fit-content;">
                                <i class="fa-solid fa-circle-user text-primary my-2 d-none d-lg-block text-center"></i>
                                <span class="mx-auto">{{ $penghubung->survey_in }}</span>
                            </div>

                        </td>
                        @can ('mengelola petikemas')
                        <td class="text-center gap-1">
                            <button class="btn btn-danger text-white rounded-3" id="button_delete_kerusaka" value="{{ $penghubung->id }}">
                                <i class="fa-solid fa-trash-can fa-lg my-1"></i>
                            </button>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<x-modal-form-delete route="/{{$cleaned}}/peti-kemas/pengecekanhistory/deletelistkerusakan" />

@foreach ($data->pengecekanhistories as $penghubung)
<x-table-listkerusakan data="{{ $penghubung->id }}" id="table-kerusakan-pengecekan-{{ $penghubung->id }}" text="List Kerusakan History | {{ $data->no_petikemas }}" />
@endforeach

<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}";
        $('#date_pengecekanhistory').change(function() {
            $.ajax({
                url: '/{{$cleaned}}/peti-kemas/pengecekanhistory/filter',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tanggal_pengecekanhistory: $(this).val(),
                },
                success: function(response) {

                    let deleteButton = '';
                    if (role === 'direktur') {
                        deleteButton = `<button class="btn btn-danger text-white p-0 rounded-3" id="button_delete_pengecekanhistory" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                                    <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i>
                                    </button>`;
                    }
                    $('#table_pengecekanhistory').show();
                    $('#text-error').hide();
                    $('#table_pengecekanhistory tbody').empty();
                    $.each(response.Data, function(index, item) {
                        $('#table_pengecekanhistory tbody').append(
                            '<tr>' +
                            '<td class="text-center m-0 p-0">' + item
                            .tanggal_pengecekan + '</td>' +
                            '<td class="text-center">' + item.jumlah_kerusakan +
                            '</td>' +
                            '<td class="text-center">' +
                            '<button class="btn bg-primary mx-auto" id="button-listkerusakan-pengecekan-' +
                            item.id + '" value="' + item.id +
                            '" data-bs-toggle="modal" data-bs-target="#table-kerusakan-pengecekan-' +
                            item.id + '">' +
                            '<span class="fs-semibold">LIST KERUSAKAN</span>' +
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
                            '<span>' + item.survey_in + '</span>' +
                            '</td>' +
                            '<td class="text-center gap-1">' +
                            '<button class="btn btn-danger text-white rounded-3" id="button_delete_pengecekanhistory" value="' +
                            item.id + '">' +
                            '<i class="fa-solid fa-trash-can fa-lg my-1"></i>' +
                            '</button>' +
                            '</td>' +
                            '</tr>'
                        );
                    });

                    // Event handler untuk tombol delete
                    $(document).on('click', '#button_delete_pengecekanhistory', function(e) {
                        e.preventDefault();
                        $("#form-delete-data").modal('show');
                        $("#input_form_delete").val($(this).val());
                        console.log($(this).val());
                    });

                    if (response.message) {
                        $('#table_pengecekanhistory').hide();
                        $('#text-error').show();
                        $('#text-error').text(response.message);

                    }

                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        $(document).on('click', '#button_delete_kerusakan', function(e) {
            e.preventDefault();
            $("#form-delete-data").modal('show');
            $("#input_form_delete").val($(this).val());
            console.log($(this).val());
        });
    });
</script>