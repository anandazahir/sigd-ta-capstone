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
                        <button type="submit" class="btn shadow btn-danger text-white rounded-3">
                            <div class="d-flex gap-2">
                                <span class="spinner-border spinner-border-sm text-white" aria-hidden="true" id="loading-button"></span>
                                <span>Ya</span>
                            </div>
                        </button>
                    </form>
                    <button class="btn shadow bg-primary text-white rounded-3" data-bs-dismiss="modal" aria-label="Close">Tidak</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container position-relative">
        <h2 class="text-white fw-semibold col-lg-9 m-0 p-0">Riwayat Penempatan</h2>
        <div class="btn bg-white rounded-circle btn shadow date-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Berdasarkan Tanggal">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="date" name="" id="date_penempatanhistory">
        </div>
        <div class="bg-white mt-4 p-1 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
            @if( $semuaBelumCetak)
            <div class="h-100 align-content-center">
                <h3 class="text-center">No Data Found</h3>
            </div>
            @endif
            <div class="text-center">
                <div class="spinner-grow text-primary mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-table-penempatan">
                </div>
            </div>
            <h1 class="text-center mt-3 text-black" id="text-error-penempatan"></h1>
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
                            <span class="{{ $penghubung->lokasi == 'out' ? 'bg-danger' : 'bg-primary' }} rounded-2 text-white" style="padding: 3px 10px 3px 10px">
                                {{ $penghubung->lokasi }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{ $penghubung->operator_alat_berat }}
                        </td>
                        <td>
                            <span class="{{ $penghubung->status_ketersediaan == 'in' ? 'bg-primary' : 'bg-danger' }} rounded-2 text-white" style="padding: 3px 10px 3px 10px">
                                {{ $penghubung->status_ketersediaan }}
                            </span>
                        </td>
                        <td class="text-center d-flex gap-1">
                            @if ($penghubung->foto_profil)
                            <img src="{{URL::asset('storage/'.$penghubung->foto_profil)}}" alt="" class="rounded-circle" width="27" height="27">
                            @else
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="25" height="25" class="rounded-circle">
                                <title>user-solid-svg</title>
                                <style>
                                    .s1 {
                                        fill: #ffffff
                                    }
                                </style>
                                <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
                                <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                            </svg>
                            @endif
                            <span>{{ $penghubung->tally }}</span>
                        </td>
                        @can ('mengelola petikemas')
                        <td class="text-center gap-1">
                            <button class="btn shadow btn-danger text-white rounded-3" id="button_delete_penempatan" value="{{ $penghubung->id }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
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

@push('table-penempatanhistory-script')
<script>
    $(document).ready(function() {
        const role = "{{$cleaned}}";
        $('#loading-table-penempatan').hide();

        function showLoadingSpinner() {
            $('#loading-table-penempatan').show();
            $('#table_penempatanhistory').hide()
            $('#text-error-penempatan').hide()
        }

        function hideLoadingSpinner() {
            $('#loading-table-penempatan').hide();

        }
        $('#date_penempatanhistory').change(function() {
            $.ajax({
                url: '/{{$cleaned}}/peti-kemas/penempatanhistory/filter',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    tanggal_penempatanhistory: $(this).val(),
                },
                beforeSend: showLoadingSpinner(),
                success: function(response) {
                    hideLoadingSpinner();
                    $('#table_penempatanhistory').show();
                    $('#table_penempatanhistory tbody').empty();
                    const baseUrl = "{{ asset('storage') }}";
                    $.each(response.Data, function(index, item) {
                        let deleteButton = '';
                        if (role === 'direktur' || role === 'mops') {
                            deleteButton = '<button class="btn shadow btn-danger text-white rounded-3" id="button_delete_penempatanhistory" value="' +
                                item.id + '">' +
                                '<i class="fa-solid fa-trash-can fa-lg my-1"></i>' +
                                '</button>';
                        }
                        const fotoprofilurl = baseUrl + '/' + item.foto_profil;
                        const profileContent = item.foto_profil == null ?
                            ` <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="25" height="25" class="rounded-circle">
              <title>user-solid-svg</title>
              <style>
                .s1 {
                  fill: #ffffff
                }
              </style>
              <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
              <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
            </svg>` :
                            `<img src="${fotoprofilurl}" alt="" class="rounded-circle" width="25" height="25">`;
                        $('#table_penempatanhistory tbody').append(
                            '<tr>' +
                            '<td class="text-center m-0 p-0">' + item
                            .tanggal_penempatan + '</td>' +
                            '<td class="text-center">' + '<span class="' + (item.lokasi ==
                                'out' ? 'bg-danger' : 'bg-primary') +
                            '  rounded-2 text-white" style="padding: 3px 10px 3px 10px">' +
                            item.lokasi +
                            ' </span>' +
                            '</td>' +
                            '<td class="text-center">' + item.operator_alat_berat +
                            '</td>' +
                            '<td>' +
                            '<span class="' + (item.status_ketersediaan ==
                                'in' ? 'bg-primary' : 'bg-danger') +
                            '  rounded-2 text-white" style="padding: 3px 10px 3px 10px">' +
                            item.status_ketersediaan +
                            ' </span>' +
                            '</td>' +
                            '<td class="text-center d-flex gap-1">' +
                            (profileContent) +
                            '<span>' + item.tally + '</span>' +
                            '</td>' +
                            '<td class="text-center gap-1">' +
                            deleteButton +
                            '</td>' +
                            '</tr>'
                        );


                    });
                    if (response.message) {
                        $('#table_penempatanhistory').hide();
                        $('#text-error-penempatan').show();
                        $('#text-error-penempatan').text(response.message);
                    }
                    // Event handler untuk tombol delete
                    $(document).on('click', '#button_delete_penempatanhistory', function(e) {
                        e.preventDefault();
                        $("#form-delete-penempatanhistory").modal('show');
                        $("#input_form_delete_penempatanhistory").val($(this).val());
                        console.log($(this).val());
                    });


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
        $('#loading-button').hide();

        function showLoadingButton() {
            $('#loading-button').show();
        }

        function hideLoadingButton() {
            $('#loading-button').hide();
        }

        $('#delete-form-penempatanhistory').submit(function(event) {
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
                    $("#form-delete-penempatanhistory").modal('hide');
                    showAlert(response.message);
                    console.log($('#delete-form-penempatanhistory').attr('action'));
                },
                error: function(xhr, status, error) {
                    hideLoadingButton();
                }
            });
        });
    });
</script>
@endpush