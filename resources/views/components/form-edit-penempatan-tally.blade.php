<form action="{{route('tally.petikemas.editpenempatan')}}" method="POST" id="{{$id}}">

@csrf
    <div class="row" id="section">
        <div class="col-lg-6 mb-3 form-group">
            <label for="nomor" class="form-label">No Peti Kemas</label>
            <input type="hidden" class="form-control" id="value_{{$test}}" required readonly value="{{$test}}">
            <input type="text" name="no_petikemas_penempatan" class="form-control" id="no_petikemas_penempatan_{{$test}}" required readonly value="  ">

        </div>
        <div class="col-lg-6 mb-3 form-group">
            <label for="size & type" class="form-label">Size & Type:</label>
            <input type="text" class="form-control" id="size_type_{{$test}}" placeholder="Size & Type" name="jenis_ukuran_penempatan" required readonly>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="operator alat berat" class="form-label">Operator alat berat </label>
            <input type="text" class="form-control" id="operatoralatberat_{{$test}}" placeholder="Operator Alat Berat" name="operator_alat_berat" required value="" />
            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <input type="hidden" name="lokasi" id="lokasi_{{$test}}" value="">
        <input type="hidden" name="id" id="penempatan_id_{{$test}}">
        <label class="form-label">Lokasi Peti Kemas</label>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Row</label>
            <select class="form-select" name="row" id="row-{{$test}}" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Plih Opsi Ini</option>
                @php
                $letters = range('A', 'D');
                $numbers = range(1, 9);
                @endphp

                @foreach($letters as $letter)
                @foreach($numbers as $number)
                @php
                $test = $letter . $number;
                @endphp
                <option value="{{ $test }}">{{$test}}</option> </option>
                @endforeach
                @endforeach
                <option value="pending">Pending</option>

                <option value="out">Out</option>


            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="blok" class="form-label">Blok</label>
            <select class="form-select" name="blok" id="blok-{{$test}}" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Plih Opsi Ini</option>
                @for($i = 1; $i <= 99; $i++) @php $test=str_pad($i, 2, '0' , STR_PAD_LEFT); @endphp <option value="{{ $test }}">{{ $test }}</option>
                    @endfor

                    <option value="pending" >Pending</option>

                    <option value="out">Out</option>

            </select>
            <div class="invalid-feedback"></div>
        </div>
        <div class="col-lg-4 mb-3 form-group">
            <label for="nomor" class="form-label">Tier</label>
            <select class="form-select" name="tier" id="tier-{{$test}}" required onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                <option selected disabled>Plih Opsi Ini</option>
                @for($i = 1; $i <= 99; $i++) @php $test=str_pad($i, 2, '0' , STR_PAD_LEFT); @endphp <option value="{{ $test }}" >{{ $test }}</option>
                    @endfor
                    <option value="pending" >Pending</option>

                    <option value="out" >Out</option>

            </select>
            <div class="invalid-feedback"></div>
        </div>

    </div>
    <button type="submit" class="btn shadow bg-primary text-white">Submit</button>
</form>
@push('form-edit-penempatan')
<script>
    $(document).ready(function() {

        var form = $('#' + '{{$id}}');
        var blok = form.find('[id^="blok-"]');
        var row = form.find('[id^="row-"]');
        var tier = form.find('[id^="tier-"]');
        var id = form.find('[id^="value_"]').val();
        var petikemasId = '{{$test}}';
        var penempatan_id = form.find('[id^="penempatan_id_"]');
        var size_type = form.find('[id^="size_type_"]');
        var operator_alat_berat = form.find('[id^="operatoralatberat_"]');
        var lokasi = form.find('[id^="lokasi_"]');
        var no_petikemas_penempatan = form.find('[id^="no_petikemas_penempatan_"]');
console.log(id);
     

        var apiUrl = '/tally/peti-kemas/' + id + '/get-petikemas';

        $.ajax({
            url: apiUrl,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                penempatan_id.val(response.id);
                no_petikemas_penempatan.val(response.no_petikemas);
                size_type.val(response.jenis_ukuran);
                operator_alat_berat.val(response.operator_alat_berat);
                console.log(response.operator_alat_berat);
                row.find('option[value="' + response.row + '"]').prop('selected', true);
                if (row.find("option:selected").val() == "pending" || row.find("option:selected").val() == "out") {
                    row.parent().removeClass("col-lg-4").addClass("col-lg-12");
                    tier.siblings("label").hide();
                    blok.siblings("label").hide();
                    tier.hide();
                    blok.hide();
                    blok.find('option[value="' + response.row + '"]').prop('selected', true);
                    tier.find('option[value="' + response.row + '"]').prop('selected', true);
                } else {
                    blok.find('option[value="' + response.blok + '"]').prop('selected', true);
                    tier.find('option[value="' + response.tier + '"]').prop('selected', true);
                }
                lokasi.val(response.lokasi);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', error);
            }
        });


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
        form.submit(function(event) { // Attach submit event to form with ID "myForm" (replace with your form's ID)
            event.preventDefault();
            handleFormSubmission(this);
        });
    });
</script>
@endpush