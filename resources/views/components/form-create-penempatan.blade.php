<form action="/penempatan">
    <div class="row">
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">No Peti Kemas</label>
            <select name="id_penghubung" class="form-select" id="no_petikemas2" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($data->penghubungs as $penghubung)
                @php
                $sentence = $penghubung->petikemas->lokasi;
                $parts = explode('-', $sentence);
                @endphp
                @if (($data->jenis_kegiatan == "ekspor" && $penghubung->pembayaran->status_cetak_spk === 'sudah cetak'))
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}" data-jenis-kegiatan="{{$data->jenis_kegiatan}}" data-row="{{$parts[0]}}" data-blok="{{$parts[1]}}" data-tier="{{$parts[2]}}">
                    {{ $penghubung->petikemas->no_petikemas }}
                </option>
                @endif
                @if (($data->jenis_kegiatan == "impor" && $penghubung->petikemas->status_kondisi == "available"))
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}">
                    {{ $penghubung->petikemas->no_petikemas }}
                </option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="size_type" placeholder="Size & Type" name="size & type" required>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Operator alat berat </label>
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Operator Alat Berat" name="operator alat berat" required />
        </div>
    </div>
    <div class="row">
        <label for="nomor" class="form-label">Lokasi Peti Kemas</label>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Row</label>
            <select class="form-select" name="row" id="row" required>
                <option selected>Plih Opsi Ini</option>
                <option value="impor">A1</option>

            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="blok" class="form-label">Blok</label>
            <select class="form-select" name="blok" id="blok" required>
                <option selected>Plih Opsi Ini</option>
                <option value="impor">11</option>

            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Tier</label>
            <select class="form-select" name="tier" id="tier" required>
                <option selected>Plih Opsi Ini</option>
                <option value="impor">11</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary text-white">Submit</button>
</form>
<script>
    $(document).ready(function() {
        $("#no_petikemas2").on("change", function() {
            var jenis_ukuran = $("#no_petikemas2 option:selected").attr("data-jenis-ukuran");
            $("#size_type").val(jenis_ukuran);
            var jenis_kegiatan = $("#no_petikemas2 option:selected").attr("data-jenis-kegiatan");
            var row = $("#no_petikemas2 option:selected").attr("data-row");
            var blok = $("#no_petikemas2 option:selected").attr("data-blok");
            var tier = $("#no_petikemas2 option:selected").attr("data-tier");
            if (jenis_kegiatan) {
                $("#row").find("option[value=" + row + "]").attr("selected", true);
                $("#blok").find("option[value=" + blok + "]").attr("selected", true);
                $("#tier").find("option[value=" + tier + "]").attr("selected", true);
            }
        });

    });
</script>