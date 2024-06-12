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

$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);

@endphp
<form action="{{route($cleaned.".transaksi.editpenempatan", $petikemas)}}" method="POST" id="{{$id}}" class="form-edit-penempatan">
    @csrf
    <div class="row" id="section">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nomor" class="form-label">No Peti Kemas</label>
            @if (( $jenis == "ekspor" && $data->pembayaran->status_cetak_spk === 'sudah cetak'))
            <input type="text" name="no_petikemas_penempatan" class="form-control" id="no_petikemas_penempatan" required readonly value="  {{ $data->petikemas->no_petikemas }}">
            @elseif (( $jenis == "impor" && $data->petikemas->status_kondisi == "available"))
            <input type="text" name="no_petikemas_penempatan" class="form-control" id="no_petikemas_penempatan" required readonly value="  {{ $data->petikemas->no_petikemas }}">
            @endif
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="size_type" placeholder="Size & Type" name="jenis_ukuran_penempatan" required readonly value="{{$data->petikemas->jenis_ukuran}}">
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Operator alat berat </label>
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Operator Alat Berat" name="operator_alat_berat" required value="{{$operator}}" />
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Tally </label>
            <input type="text" class="form-control" id="operatoralatberat" placeholder="Tally" name="tally" required value="{{$tally}}" />
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="lokasi" value="{{$lokasi}}">
        <input type="hidden" name="id_penempatan" value="{{$value}}">
        <label for="nomor" class="form-label">Lokasi Peti Kemas</label>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Row</label>
            <select class="form-select" name="row" id="row-{{$value}}" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="A1" {{ $row == 'A1' ? 'selected' : '' }}>A1</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="blok" class="form-label">Blok</label>
            <select class="form-select" name="blok" id="blok-{{$value}}" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11" {{ $blok == '11' ? 'selected' : '' }}>11</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Tier</label>
            <select class="form-select" name="tier" id="tier-{{$value}}" required>
                <option selected disabled>Plih Opsi Ini</option>
                <option value="11" {{ $tier == '11' ? 'selected' : '' }}>11</option>
                <option value="pending" {{ $parts == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="out" {{ $parts == 'out' ? 'selected' : '' }}>Out</option>
            </select>
            <div class="invalid-feedback"></div>
        </div>

    </div>
    <button type="submit" class="btn bg-primary text-white">Submit</button>
</form>
<script>
    $(document).ready(function() {
        $('.form-edit-penempatan').each(function() {
            var form = $(this);
            var id = form.attr('id');
            var blok = form.find('[id^="blok-"]');
            var row = form.find('[id^="row-"]');
            var tier = form.find('[id^="tier-"]');

            if (row.find("option:selected").val() == "pending" || row.find("option:selected").val() == "out") {
                row.parent().removeClass("col-lg-4").addClass("col-lg-12");
                tier.siblings("label").hide();
                blok.siblings("label").hide();
                tier.hide();
                blok.hide();
            }

            row.on("change", function() {
                $(this).parent().removeClass("col-lg-12").addClass("col-lg-4");
                tier.show();
                blok.show();
                tier.siblings("label").show();
                blok.siblings("label").show();
                if (tier.val() == "pending" || tier.val() == "out") {
                    tier.find('option[disabled]').prop("selected", true);
                    blok.find('option[disabled]').prop("selected", true);
                }
                form.find('input[name="lokasi"]').val($(this).val() + "-" + blok.val() + "-" + tier.val());
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    tier.hide();
                    blok.hide();
                    tier.siblings("label").hide();
                    blok.siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4").addClass("col-lg-12");
                    tier.find('option[value="' + value + '"]').prop("selected", true);
                    blok.find('option[value="' + value + '"]').prop("selected", true);
                    form.find('input[name="lokasi"]').val($(this).val());
                }
            });

            blok.on("change", function() {
                $(this).parent().removeClass("col-lg-12").addClass("col-lg-4");
                row.show();
                tier.show();
                row.siblings("label").show();
                tier.siblings("label").show();
                if (row.val() == "pending" || row.val() == "out") {
                    row.find('option[disabled]').prop("selected", true);
                    tier.find('option[disabled]').prop("selected", true);
                }
                form.find('input[name="lokasi"]').val(row.val() + "-" + $(this).val() + "-" + tier.val());
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    row.hide();
                    tier.hide();
                    row.siblings("label").hide();
                    tier.siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4").addClass("col-lg-12");
                    row.find('option[value="' + value + '"]').prop("selected", true);
                    tier.find('option[value="' + value + '"]').prop("selected", true);
                    form.find('input[name="lokasi"]').val($(this).val());
                }
            });

            tier.on("change", function() {
                $(this).parent().removeClass("col-lg-12").addClass("col-lg-4");
                row.show();
                blok.show();
                row.siblings("label").show();
                blok.siblings("label").show();
                if (row.val() == "pending" || row.val() == "out") {
                    row.find('option[disabled]').prop("selected", true);
                    blok.find('option[disabled]').prop("selected", true);
                }
                form.find('input[name="lokasi"]').val(row.val() + "-" + blok.val() + "-" + $(this).val());
                var value = $(this).val();
                if (value == "pending" || value == "out") {
                    row.hide();
                    blok.hide();
                    row.siblings("label").hide();
                    blok.siblings("label").hide();
                    $(this).parent().removeClass("col-lg-4").addClass("col-lg-12");
                    row.find('option[value="' + value + '"]').prop("selected", true);
                    blok.find('option[value="' + value + '"]').prop("selected", true);
                    form.find('input[name="lokasi"]').val($(this).val());
                }
            });
            form.submit(function(event) {
                handleFormSubmission(this);
            });
        });

    });
</script>