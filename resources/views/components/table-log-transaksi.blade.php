
<div class="modal fade fade " tabindex="-1" id="table-log-transaksi" aria-labelledby="show-kerusakan" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{$title}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($data)
                <div class="p-1 rounded-4  table-responsive">
                    <table class="table-variations-3  text-center" id="table_kerusakan_pengecekan">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No</th>
                                <th scope="col" class="fw-semibold">No Petikemas</th>
                                <th scope="col" class="fw-semibold">Aksi</th>
                                <th scope="col" class="fw-semibold">User</th>
                                <th scope="col" class="fw-semibold">Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $item['no_petikemas'] }}</td>
                                <td class="text-center">{{ $item['aksi'] }}</td>
                                <td class="text-center">{{ $item['user'] }}</td>
                                <td class="text-center">{{ $item['waktu_perubahan'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <h1 class="mx-auto text-center">Data Log Tidak Ada</h1>
                @endif
            </div>
        </div>
    </div>
</div>