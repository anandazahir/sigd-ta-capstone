@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
$semuaBelumCetak = true;
foreach($data->pengecekanhistories as $penghubung) {
if($penghubung->tanggal_pengecekan) {
$semuaBelumCetak = false;
break;
}
}
@endphp
<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container position-relative">
        <h2 class="text-white fw-semibold">Riwayat Pengecekan</h2>
        <div class="btn bg-white rounded-circle btn date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Berdasarkan Tanggal">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="date_pengecekanhistory">
        </div>

        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">No Data Found</h3>
            </div>
            @endif
            <div class="text-center">
                <div class="spinner-grow text-primary mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-table-pengecekan">
                </div>
            </div>
            <h1 class="text-center mt-3 text-black" id="text-error"></h1>
            <table class="table-variations-3  text-center" id="table_pengecekanhistory">
                <thead>
                    <tr>
                        @foreach ($data->pengecekanhistories as $penghubung)
                        @if ($penghubung->tanggal_pengecekan)
                        <th scope="col" class="fw-semibold">Tanggal Pengecekan</th>
                        <th scope="col" class="fw-semibold">Jumlah Kerusakan</th>
                        <th scope="col" class="fw-semibold">List Kerusakan</th>
                        <th scope="col" class="fw-semibold">Kondisi</th>
                        <th scope="col" class="fw-semibold">Survey In</th>
                        <th scope="col" class="fw-semibold"></th>
                        @endif
                        @break
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data->pengecekanhistories as $penghubung)
                    @if ($penghubung->tanggal_pengecekan)
                    <tr>
                        <td class="text-center m-0 p-0">
                            {{ $penghubung->tanggal_pengecekan }}
                        </td>
                        <td class="text-center">
                            {{ $penghubung->jumlah_kerusakan }}
                        </td>
                        <td class="text-center">
                            <button class="btn bg-primary mx-auto" id="button-listkerusakan-pengecekan-{{ $penghubung->id }}" value="{{ $penghubung->id }}" data-bs-toggle="modal" data-bs-target="#table-kerusakan-pengecekan-{{ $penghubung->id }}">
                                <span class="fs-semibold text-white">LIST KERUSAKAN</span>
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
                            <button class="btn btn-danger text-white rounded-3" id="button_delete_kerusakan" value="{{ $penghubung->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
                                <i class="fa-solid fa-trash-can fa-lg my-1"></i>
                            </button>
                        </td>
                        @endif
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

@push('table-pengecekanhistory-script')
<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}";
        $('#loading-table-pengecekan').hide();

        function showLoadingSpinner() {
            $('#loading-table-pengecekan').show();
            $('#table_pengecekanhistory').hide()
            $('#text-error').hide()
        }

        function hideLoadingSpinner() {
            $('#loading-table-pengecekan').hide();

        }
        $('#date_pengecekanhistory').change(function() {
            $.ajax({
                url: '/{{$cleaned}}/peti-kemas/pengecekanhistory/filter',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tanggal_pengecekanhistory: $(this).val(),
                },
                beforeSend: showLoadingSpinner(),
                success: function(response) {

                    hideLoadingSpinner();
                    let deleteButton = '';

                    $('#table_pengecekanhistory').show();

                    $('#table_pengecekanhistory tbody').empty();
                    $.each(response.Data, function(index, item) {
                        if (role === 'direktur' || role === 'mops') {
                            deleteButton = `<button class="btn btn-danger text-white p-0 rounded-3" id="button_delete_pengecekanhistory" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                                    <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i>
                                    </button>`;
                        }
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
                            '<span class="fs-semibold text-white">LIST KERUSAKAN</span>' +
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
                        let Id = "button-listkerusakan-pengecekan-" + item.id;
                        let tableId = "table-kerusakan-pengecekan-" + item.id;
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
@stack('table-listkerusakan-script')
@endpush