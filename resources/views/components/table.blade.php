<table class="table-responsive text-center {{ $attributes->get('class') }}" rules="groups">
    <thead>
        <tr>
            @foreach ($attributes->get('tablecolumn') as $column)
            @if ($column !== "id" && $column !== "user")
            <th scope="col" class="fw-semibold">{{ strtoupper($column) }}</th>
            @endif
            @if ($column === "user")
            <th scope="col" class="fw-semibold">{{ $attributes->get('msg') }}</th>
            @endif
            @endforeach

            <th scope="col"></th>

        </tr>

    </thead>
    <tbody>
        @foreach ($attributes->get('tabledata') as $row)
        <tr>
            <!-- Tampilkan data sesuai dengan struktur tabel -->
            @foreach ($attributes->get('tablecolumn') as $column)
            @if ($column !== 'id' && $column!== 'user')
            <td>{{ $row[$column] }}</td>

            @endif
            @if ($column === "user")
            <td>
                <div class="d-flex gap-2 mx-auto" style="width: fit-content;">
                    <i class="fa-solid fa-circle-user text-{{$attributes->get('usericoncolor')}}  fa-l d-none d-lg-block" style="margin-top: 5.7px;"></i>
                    <span class="text-center">{{ $row[$column] }}</span>
                </div>
            </td>
            @endif

            @endforeach
            <td>
                {{$slot}}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>