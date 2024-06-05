@php
$sentence = $data->petikemas->lokasi;
$row="";
$blok="";
$tier="";
$parts = '';
if($sentence == 'out'|| $sentence == 'pending'){
$parts = $sentence;
}else{
$parts = explode('-', $sentence);
$row=$parts[0];
$blok=$parts[1];
$tier=$parts[2];
}
@endphp
<form action="/penempatan" id="{{$id}}">
    <div class="row" id="section">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nomor" class="form-label">No Peti Kemas</label>
            @if (( $jenis == "ekspor" && $data->pembayaran->status_cetak_spk === 'sudah cetak'))
            <input type="text" name="id_penghubung" class="form-control" id="no_petikemas" required readonly value="  {{ $data->petikemas->no_petikemas }}">
            @elseif (( $jenis == "impor" && $data->petikemas->status_kondisi == "available"))
            <input type="text" name="id_penghubung" class="form-control" id="no_petikemas" required readonly value="  {{ $data->petikemas->no_petikemas }}">
            @endif
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="size_type" placeholder="Size & Type" name="size & type" required readonly value="{{$data->petikemas->jenis_ukuran}}">
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Operator alat berat </label>
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Operator Alat Berat" name="operator alat berat" required />
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Operator alat berat </label>
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Operator Alat Berat" name="operator alat berat" required />
        </div>
    </div>
    <div class="row">
        <label for="nomor" class="form-label">Lokasi Peti Kemas</label>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Row</label>
            <select class="form-select" name="row" id="row" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="A1" {{ $row == 'A1' ? 'selected' : '' }}>A1</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="blok" class="form-label">Blok</label>
            <select class="form-select" name="blok" id="blok" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11" {{ $blok == '11' ? 'selected' : '' }}>11</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Tier</label>
            <select class="form-select" name="tier" id="tier" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11" {{ $tier == '11' ? 'selected' : '' }}>11</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
        </div>

    </div>
    <button type="submit" class="btn bg-primary text-white">Submit</button>
</form>
<script>
    $(document).ready(function() {
        if ($("#row").find("option:selected").val() == "pending" || $("#row").find("option:selected").val() == "out") {
            $("#row").parent().removeClass("col-lg-4");
            $("#row").parent().addClass("col-lg-12");
            $("#tier").siblings("label").hide();
            $("#blok").siblings("label").hide();
            $("#tier").hide();
            $("#blok").hide();
        }

        $("#row").on("change", function() {
            console.log("hai");
            $(this).parent().removeClass("col-lg-12");
            $(this).parent().addClass("col-lg-4");
            $("#tier").show();
            $("#blok").show();
            $("#tier").siblings("label").show();
            $("#blok").siblings("label").show();
            if ($("#tier").val() == "pending" || $("#tier").val() == "out") {
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
            if ($("#row").val() == "pending" || $("#row").val() == "out") {
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
            if ($("#row").val() == "pending" || $("#row").val() == "out") {
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
</script>