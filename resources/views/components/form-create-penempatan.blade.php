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
                <option value="{{ $penghubung->pengecekan->penghubung_id }}" data-jenis-ukuran="{{ $penghubung->petikemas->jenis_ukuran }}" data-jenis-kegiatan="{{$data->jenis_kegiatan}}" data-row="{{ ($penghubung->petikemas->lokasi === 'out' || $penghubung->petikemas->lokasi === 'pending') ? $penghubung->petikemas->lokasi : $parts[0] }}" data-blok="{{ ($penghubung->petikemas->lokasi === 'out' || $penghubung->petikemas->lokasi === 'pending') ? $penghubung->petikemas->lokasi : $parts[1] }}" data-tier="{{ ($penghubung->petikemas->lokasi === 'out' || $penghubung->petikemas->lokasi === 'pending') ? $penghubung->petikemas->lokasi : $parts[2] }}">
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
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Operator Alat Berat" name="operator alat berat" required placeholder="ex: Nanda" />
        </div>
    </div>
    <div class="row">
        <label for="nomor" class="form-label">Lokasi Peti Kemas</label>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Row</label>
            <select class="form-select" name="row" id="row" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="A1">A1</option>
                <option value="pending">Pending</option>
                <option value="out">Out</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="blok" class="form-label">Blok</label>
            <select class="form-select" name="blok" id="blok" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11">11</option>
                <option value="pending">Pending</option>
                <option value="out">Out</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Tier</label>
            <select class="form-select" name="tier" id="tier" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11">11</option>
                <option value="pending">Pending</option>
                <option value="out">Out</option>
            </select>
        </div>
    </div>
    <button type="submit" class="btn shadow bg-primary text-white">Submit</button>
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
            if (jenis_kegiatan == "ekspor") {
                $("#row").find('option[value="' + row + '"]').attr("selected", true);
                $("#tier").find('option[value="' + tier + '"]').attr("selected", true);
                $("#blok").find('option[value="' + blok + '"]').attr("selected", true);
            }
            $("#row").on("change", function() {
                $(this).parent().removeClass("col-lg-12");
                $(this).parent().addClass("col-lg-4");
                $("#tier").show();
                $("#blok").show();
                $("#tier").siblings("label").show();
                $("#blok").siblings("label").show();
                if ($("#tier").val() == "pending" || $("#row").val() == "pending") {
                    $("#tier").find('option[disabled]').prop("selected", true);
                    $("#blok").find('option[disabled]').prop("selected", true);
                }
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    $("#tier").hide();
                    $("#blok").hide();
                    $("#tier").siblings("label").hide();
                    $("#blok").siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4");
                    $(this).parent().addClass("col-lg-12");
                    $("#tier").find('option[value="' + value + '"]').prop("selected", true);
                    $("#blok").find('option[value="' + value + '"]').prop("selected", true);
                }
                console.log($("#blok").val());
            });
            $("#tier").on("change", function() {
                $(this).parent().removeClass("col-lg-12");
                $(this).parent().addClass("col-lg-4");
                $("#row").show();
                $("#blok").show();
                $("#row").siblings("label").show();
                $("#blok").siblings("label").show();
                if ($("#row").val() == "pending" || $("#row").val() == "pending") {
                    $("#row").find('option[disabled]').prop("selected", true);
                    $("#blok").find('option[disabled]').prop("selected", true);
                }
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    $("#row").hide();
                    $("#blok").hide();
                    $("#row").siblings("label").hide();
                    $("#blok").siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4");
                    $(this).parent().addClass("col-lg-12");
                    $("#row").find('option[value="' + value + '"]').prop("selected", true);
                    $("#blok").find('option[value="' + value + '"]').prop("selected", true);
                }
            });
            $("#blok").on("change", function() {
                $(this).parent().removeClass("col-lg-12");
                $(this).parent().addClass("col-lg-4");
                $("#row").show();
                $("#tier").show();
                $("#row").siblings("label").show();
                $("#tier").siblings("label").show();
                if ($("#row").val() == "pending" || $("#row").val() == "pending") {
                    $("#row").find('option[disabled]').prop("selected", true);
                    $("#tier").find('option[disabled]').prop("selected", true);
                }
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    $("#row").hide();
                    $("#tier").hide();
                    $("#row").siblings("label").hide();
                    $("#tier").siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4");
                    $(this).parent().addClass("col-lg-12");
                    $("#row").find('option[value="' + value + '"]').prop("selected", true);
                    $("#tier").find('option[value="' + value + '"]').prop("selected", true);
                }
            });
        });

    });
</script>