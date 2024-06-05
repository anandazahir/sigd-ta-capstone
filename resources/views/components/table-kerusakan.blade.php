<div class="modal fade fade " tabindex="-1" id="{{$id}}" aria-labelledby="show-kerusakan" aria-hidden="true" data-petikemas="{{$petikemas}}">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"> {{$text}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($data->jumlah_kerusakan > 0)
                <div class="p-1 rounded-4  table-responsive">
                    <table class="table-variations-3  text-center" id="table_kerusakan_pengecekan">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No</th>
                                <th scope="col" class="fw-semibold">Lokasi</th>
                                <th scope="col" class="fw-semibold">Component</th>
                                <th scope="col" class="fw-semibold">Metode</th>
                                <th scope="col" class="fw-semibold">Status</th>
                                @if ($test == "false")
                                <th scope="col" class="fw-semibold">Foto Pengecekan</th>
                                @endif
                                @if ($test == "true")
                                <th scope="col" class="fw-semibold">Foto Perbaikan</th>
                                @endif
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data->kerusakan as $index => $item)
                            @php
                            $foto_perbaikan = asset('storage') . '/' . $item['foto_perbaikan'];
                            $fotoLink = asset('storage') . '/' . $item['foto_pengecekan'];
                            $statusClass = $item['status'] === 'damage' ? 'bg-danger' : 'bg-primary';
                            @endphp
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $item['lokasi_kerusakan'] }}</td>
                                <td class="text-center">{{ $item['komponen'] }}</td>
                                <td class="text-center">{{ $item['metode'] }}</td>
                                <td>
                                    <div class="{{ $statusClass }} p-1 rounded-2 text-white my-1">
                                        <span>{{ $item['status'] }}</span>
                                    </div>
                                </td>
                                @if ($test == "false")
                                <td class="text-center">
                                    <div class="my-2" style="height: fit-content">
                                        <a href="{{ $fotoLink }}" target="_blank" class="bg-primary p-2 rounded-2 text-white text-decoration-none my-auto">Foto</a>
                                    </div>
                                </td>
                                @endif
                                @if ($test == "true")
                                <td class="text-center">
                                    <div class="my-2" style="height: fit-content">
                                        <a href="{{ $foto_perbaikan }}" target="_blank" class="bg-primary p-2 rounded-2 text-white text-decoration-none my-auto">Foto</a>
                                    </div>
                                </td>
                                @endif
                                <td class="text-center">
                                    <form action="/transaksi/deletekerusakan" method="POST">
                                        @csrf
                                        <input type="hidden" name="id_kerusakan" value="{{$item->id}}">
                                        <input type="hidden" name="id_petikemas" value="{{$petikemas}}">
                                        <button class="btn btn-danger text-white rounded-3" id="button_delete_kerusakan" value="{{ $item['id'] }}" data-bs-toggle="modal">
                                            <i class="fa-solid fa-trash-can fa-lg my-1"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                @else
                <h1 class="mx-auto text-center">Data Kerusakan Tidak Ada</h1>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let Id = "table-kerusakan-{{$data->id}}";
        let $modalId = $("#" + Id);
        $(document).on('click', '#button_delete_kerusakan', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/transaksi/deletekerusakan',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_kerusakan: $(this).val(),
                    id_petikemas: $modalId.data('petikemas'),
                },
                success: function(response) {
                    $("#show-kerusakan").modal('hide');
                    showAlert(response.message);
                    console.log(response.petikemas);
                },
                error: function(xhr, status, error) {}
            });
            console.log($(this).val());
        });

    });
</script>