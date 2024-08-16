@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<form data-id="{{ $id }}" method="POST" id="edit_form_perbaikan_{{ $data->id }}" action="{{route($cleaned.'.transaksi.editperbaikan')}}" enctype="multipart/form-data" novalidate>
    @csrf
    <div class="row">
        <div class="col-lg-12 mb-3 form-group">
            <label for="Repair" class="form-label">
                <span>Repair</span>
            </label>
            @if (auth()->user()->username == 'direktur' || auth()->user()->username == 'mops')
            <select name="repair" class="form-select" aria-label="Default select example" required>
                <option selected disabled>Pilih Opsi Ini</option>
                @foreach ($user as $item)
                @if ($item->hasRole('repair'))
                <option value="{{$item->username}}" {{ $perbaikan->repair == $item->username ? 'selected' : '' }}>{{($item->username)}}</option>
                @endif
                @endforeach
            </select>
            @else
            <input type="hidden" name="repair" value="{{auth()->user()->username}}" id="">
            @endif

            <div class="invalid-feedback"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mb-3">
            <label for="jumlah kerusakan" class="form-label">Jumlah Kerusakan</label>
            <input type="number" min="0" class="form-control" id="jumlah_kerusakan" placeholder="Jumlah Kerusakan" name="jumlah_perbaikan" required value="{{ $perbaikan->jumlah_perbaikan }}">
            <input type="hidden" name="id_perbaikan" id="id_perbaikan" value="{{ $data->id }}">
            <input type="hidden" name="id_penghubung" id="id_penghubung2" value="{{ $data->penghubung_id }}">
            <div class="invalid-feedback"></div>
        </div>
    </div>

    <h5 id="text-perbaikan-edit">List Perbaikan</h5>

    <div class="table-responsive">
        <table class="table text-center" id="table_edit_perbaikan">
            <thead>
                <tr>
                    <th scope="col">Lokasi Kerusakan</th>
                    <th scope="col">Jenis Kerusakan</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Status</th>
                    <th scope="col" id="last-kolom-header">Foto Perbaikan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data->kerusakan as $index => $item)
                @if ($item->status === "damage")
                <tr>
                    <td class="text-center">
                    <select class="form-select" name="lokasi_kerusakan[]" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">
            <option selected disabled>Open this select menu</option>
            <option value="EXTERIOR BOTTOM SECTION" {{ $item->lokasi_kerusakan == 'EXTERIOR BOTTOM SECTION' ? 'selected' : '' }}>EXTERIOR BOTTOM SECTION</option>
            <option value="EXTERIOR RIGHT SECTION" {{ $item->lokasi_kerusakan == 'EXTERIOR RIGHT SECTION' ? 'selected' : '' }}>EXTERIOR RIGHT SECTION</option>
            <option value="EXTERIOR LEFT SECTION" {{ $item->lokasi_kerusakan == 'EXTERIOR LEFT SECTION' ? 'selected' : '' }}>EXTERIOR LEFT SECTION</option>
            <option value="EXTERIOR TOP SECTION" {{ $item->lokasi_kerusakan == 'EXTERIOR TOP SECTION' ? 'selected' : '' }}>EXTERIOR TOP SECTION</option>
            <option value="INTERIOR BOTTOM SECTION" {{ $item->lokasi_kerusakan == 'INTERIOR BOTTOM SECTION' ? 'selected' : '' }}>INTERIOR BOTTOM SECTION</option>
            <option value="INTERIOR RIGHT SECTION" {{ $item->lokasi_kerusakan == 'INTERIOR RIGHT SECTION' ? 'selected' : '' }}>INTERIOR RIGHT SECTION</option>
            <option value="INTERIOR LEFT SECTION" {{ $item->lokasi_kerusakan == 'INTERIOR LEFT SECTION' ? 'selected' : '' }}>INTERIOR LEFT SECTION</option>
            <option value="INTERIOR TOP SECTION" {{ $item->lokasi_kerusakan == 'INTERIOR TOP SECTION' ? 'selected' : '' }}>INTERIOR TOP SECTION</option>
            <option value="DOOR" {{ $item->lokasi_kerusakan == 'DOOR' ? 'selected' : '' }}>DOOR</option>
        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                    <select class="form-select" name="komponen[]" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">
            <option selected disabled>Open this select menu</option>
            <option value="BENT" {{ $item->komponen == 'BENT' ? 'selected' : '' }}>BENT</option>
            <option value="BROKEN" {{ $item->komponen == 'BROKEN' ? 'selected' : '' }}>BROKEN</option>
            <option value="CASINGTREAD" {{ $item->komponen == 'CASINGTREAD' ? 'selected' : '' }}>CASING/TREAD</option>
            <option value="CONTAMINATED" {{ $item->komponen == 'CONTAMINATED' ? 'selected' : '' }}>CONTAMINATED</option>
            <option value="CORRODED" {{ $item->komponen == 'CORRODED' ? 'selected' : '' }}>CORRODED</option>
            <option value="CORRODED HOLED" {{ $item->komponen == 'CORRODED HOLED' ? 'selected' : '' }}>CORRODED/HOLED</option>
            <option value="CRACKED" {{ $item->komponen == 'CRACKED' ? 'selected' : '' }}>CRACKED</option>
            <option value="CUT" {{ $item->komponen == 'CUT' ? 'selected' : '' }}>CUT</option>
            <option value="DEBRIS" {{ $item->komponen == 'DEBRIS' ? 'selected' : '' }}>DEBRIS</option>
            <option value="DELAMINATED" {{ $item->komponen == 'DELAMINATED' ? 'selected' : '' }}>DELAMINATED</option>
            <option value="DENT" {{ $item->komponen == 'DENT' ? 'selected' : '' }}>DENT</option>
            <option value="DENTEDHOLED" {{ $item->komponen == 'DENTEDHOLED' ? 'selected' : '' }}>DENTED AND HOLED</option>
            <option value="EQUIPMENT FAILURE" {{ $item->komponen == 'EQUIPMENT FAILURE' ? 'selected' : '' }}>EQUIPMENT FAILURE</option>
            <option value="FAILURE" {{ $item->komponen == 'FAILURE' ? 'selected' : '' }}>FAILURE</option>
            <option value="FROZEN" {{ $item->komponen == 'FROZEN' ? 'selected' : '' }}>FROZEN</option>
            <option value="GOUGED" {{ $item->komponen == 'GOUGED' ? 'selected' : '' }}>GOUGED</option>
            <option value="GRAFFITI" {{ $item->komponen == 'GRAFFITI' ? 'selected' : '' }}>GRAFFITI</option>
            <option value="HIGH PRESSURE SAFETY" {{ $item->komponen == 'HIGH PRESSURE SAFETY' ? 'selected' : '' }}>HIGH PRESSURE SAFETY</option>
            <option value="HOLED" {{ $item->komponen == 'HOLED' ? 'selected' : '' }}>HOLED</option>
            <option value="IMPROPER REPAIR" {{ $item->komponen == 'IMPROPER REPAIR' ? 'selected' : '' }}>IMPROPER REPAIR</option>
            <option value="LEAKING" {{ $item->komponen == 'LEAKING' ? 'selected' : '' }}>LEAKING</option>
            <option value="LOOSE" {{ $item->komponen == 'LOOSE' ? 'selected' : '' }}>LOOSE</option>
            <option value="MISALIGNED" {{ $item->komponen == 'MISALIGNED' ? 'selected' : '' }}>MISALIGNED</option>
            <option value="MISPRESSURE" {{ $item->komponen == 'MISPRESSURE' ? 'selected' : '' }}>MISPRESSURE</option>
            <option value="MISSING" {{ $item->komponen == 'MISSING' ? 'selected' : '' }}>MISSING</option>
            <option value="OILSTAIN" {{ $item->komponen == 'OILSTAIN' ? 'selected' : '' }}>OILSTAIN</option>
            <option value="OVERLAY PLYWOOD" {{ $item->komponen == 'OVERLAY PLYWOOD' ? 'selected' : '' }}>OVERLAY PLYWOOD</option>
            <option value="REMOVE" {{ $item->komponen == 'REMOVE' ? 'selected' : '' }}>REMOVE</option>
            <option value="ROTTED" {{ $item->komponen == 'ROTTED' ? 'selected' : '' }}>ROTTED</option>
        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td class="text-center">
                        <input type="hidden" name="metode_perbaikan_value[]" value="{{ $item->metode }}">
                        <select class="form-select" aria-label="Default select example" name="metode_perbaikan[]" id="metode">
                        <option selected disabled>Open this select menu</option>
            <option value="ABRASSIN AND GCOAT" {{ $item->metode == 'ABRASSIN AND GCOAT' ? 'selected' : '' }}>ABRASSING & COAT</option>
            <option value="CORNERFITTING" {{ $item->metode == 'CORNERFITTING' ? 'selected' : '' }}>CORNER FITTING</option>
            <option value="EVAQUATION SERVICE" {{ $item->metode == 'EVAQUATION SERVICE' ? 'selected' : '' }}>EVAQUATION SERVICE</option>
            <option value="FREE" {{ $item->metode == 'FREE' ? 'selected' : '' }}>FREE</option>
            <option value="GOUGED" {{ $item->metode == 'GOUGED' ? 'selected' : '' }}>GOUGED</option>
            <option value="GRIND" {{ $item->metode == 'GRIND' ? 'selected' : '' }}>GRIND</option>
            <option value="GRIND FLOOR" {{ $item->metode == 'GRIND FLOOR' ? 'selected' : '' }}>GRIND FLOOR</option>
            <option value="INSERT" {{ $item->metode == 'INSERT' ? 'selected' : '' }}>INSERT</option>
            <option value="INSTALL" {{ $item->metode == 'INSTALL' ? 'selected' : '' }}>INSTALL</option>
            <option value="LUBRICATE" {{ $item->metode == 'LUBRICATE' ? 'selected' : '' }}>LUBRICATE</option>
            <option value="OIL CLEANING" {{ $item->metode == 'OIL CLEANING' ? 'selected' : '' }}>OIL CLEANING</option>
            <option value="OVERLAY" {{ $item->metode == 'OVERLAY' ? 'selected' : '' }}>OVERLAY</option>
            <option value="PAINT" {{ $item->metode == 'PAINT' ? 'selected' : '' }}>PAINT</option>
            <option value="PATCH" {{ $item->metode == 'PATCH' ? 'selected' : '' }}>PATCH</option>
            <option value="PRE TRIP INSPECTION" {{ $item->metode == 'PRE TRIP INSPECTION' ? 'selected' : '' }}>PRE TRIP INSPECTION</option>
            <option value="RE-ALIGN" {{ $item->metode == 'RE-ALIGN' ? 'selected' : '' }}>RE-ALIGN</option>
            <option value="RECHARGE" {{ $item->metode == 'RECHARGE' ? 'selected' : '' }}>RECHARGE</option>
            <option value="REFIT" {{ $item->metode == 'REFIT' ? 'selected' : '' }}>REFIT</option>
            <option value="REMOVE AND REINSTALL" {{ $item->metode == 'REMOVE AND REINSTALL' ? 'selected' : '' }}>Remove and Reinstall</option>
            <option value="REMOVE COMPONENT" {{ $item->metode == 'REMOVE COMPONENT' ? 'selected' : '' }}>REMOVE COMPONENT</option>
            <option value="REPLACE" {{ $item->metode == 'REPLACE' ? 'selected' : '' }}>REPLACE</option>
            <option value="RESEAL" {{ $item->metode == 'RESEAL' ? 'selected' : '' }}>RESEAL</option>
            <option value="RESECURE" {{ $item->metode == 'RESECURE' ? 'selected' : '' }}>RESECURE</option>
            <option value="SAND" {{ $item->metode == 'SAND' ? 'selected' : '' }}>SAND</option>
            <option value="SEAL OR RESEAL" {{ $item->metode == 'SEAL OR RESEAL' ? 'selected' : '' }}>SEAL OR RESEAL</option>
            <option value="SECTION" {{ $item->metode == 'SECTION' ? 'selected' : '' }}>SECTION</option>
            <option value="STRAIGHTEN" {{ $item->metode == 'STRAIGHTEN' ? 'selected' : '' }}>STRAIGHTEN</option>
            <option value="STRAIGHTEN AND WELD" {{ $item->metode == 'STRAIGHTEN AND WELD' ? 'selected' : '' }}>STRAIGHTEN AND WELD</option>
            <option value="VACUUMIZE" {{ $item->metode == 'VACUUMIZE' ? 'selected' : '' }}>VACUUMIZE</option>
            <option value="WELD" {{ $item->metode == 'WELD' ? 'selected' : '' }}>WELD</option>
 
                        </select>
                        <div class="invalid-feedback"></div>
                    </td>
                    <td>
                        <input type="hidden" name="status_value[]" value="{{$item->status}}">
                        <select class="form-select" aria-label="Default select example" name="status[]" id="status_perbaikan" value="{{ $item->status }}">
                            <option selected disabled>Pilih Status</option>
                            <option value="fix" {{ $item->status == 'fix' ? 'selected' : '' }}>FIX</option>
                            <option value="damage" {{ $item->status == 'damage' ? 'selected' : '' }}>DAMAGE</option>
                        </select>
                    </td>
                    @if ($item->status == 'fix')
                    <td class="text-center" id="last-kolom">
                        <input type="hidden" value="{{ $item->foto_perbaikan }}" name="url_foto[]">
                        <div class="d-flex gap-2">
                            <div class="input-group">
                                <span class="input-group-text" style="height: fit-content;">Pilih File</span>
                                <label tabindex="0" class="form-control text-start p-1" style="height: 2.3rem;">
                                    <span class="file-name">{{ $item->foto_perbaikan_name ?? 'tidak ada file dipilih' }}</span>
                                    <input type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="invisible" accept="image/png, image/jpeg, image/jpg" style="height: fit-content;">
                                    <input type="hidden" name="foto_perbaikan_name[]" value="{{ $item->foto_perbaikan_name }}">
                                </label>
                            </div>
                           
                            @if ($item->foto_perbaikan)
                            <a href="/storage/{{ $item->foto_perbaikan }}" target="_blank" class="bg-primary p-2 rounded-2 text-white text-decoration-none my-auto" id="preview_{{ $index }}">Preview</a>
                            @endif
                        </div>
                        <div class="invalid-feedback"></div>
                    </td>
                    @endif
                </tr>
                @endif

                @endforeach
            </tbody>
        </table>
    </div>
    <div class="alert alert-warning rounded-3 mt-2 position-relative p-0 d-flex alert-dismissible fade show d-none" style="height:3.5rem" id="alert-kerusakan">
        <div class="bg-warning rounded-3 rounded-end-0 p-2 position-absolute z-1 d-flex h-100" style="width: 9.5vh;">

            <i class="fa-solid fa-triangle-exclamation text-white mx-auto my-auto" style="font-size: 25px;"></i>
        </div>
        <p class="my-3" style="margin-left:80px;"><strong>PERINGATAN!</strong> Mohon Untuk Melunasi / Mencetak SPK Data Peti kemas</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <h5 id="text-perbaikan-tambahan-edit">Data Perbaikan Tambahan</h5>
    <div class="table-responsive">
        <table class="table text-center" id="table_perbaikan_tambahan">
            <thead>
                <tr>
                    <th scope="col">Lokasi</th>
                    <th scope="col">Jenis Kerusakan</th>
                    <th scope="col">Metode</th>
                    <th scope="col">Foto Pengecekan</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
    <button type="submit" class="btn shadow bg-primary text-white">
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" id="loading-button-editperbaikan"></span>
        <span>Submit</span>

    </button>
</form>
@push('form-edit-perbaikan')
<script>
    $(document).ready(function() {
        let formId = "edit_form_perbaikan_{{$data->id}}";
        let $form = $("#" + formId);
        const loadingButton = $('#loading-button-editperbaikan');
        console.log($form);
        if ($form.find("#jumlah_kerusakan").val() > 0) {
            $form.find("#table_edit_perbaikan").show();
            $form.find("#text-perbaikan-edit").show();
        } else {
            $form.find("#table_edit_perbaikan").hide();
            $form.find("#text-perbaikan-edit").hide();
        }
        $form.find("#table_perbaikan_tambahan").hide();
        $form.find("#text-perbaikan-tambahan-edit").hide();


        $form.find("#jumlah_kerusakan").on("change", function() {
            console.log("hai")
            var rowCount = parseInt($(this).val());
            var lengthTable = $form.find("#table_edit_perbaikan tbody tr").length;
            let damageCount = $form.find("#table_edit_perbaikan tbody tr").filter(function() {
                return $(this).find('select[name="status[]"]').val() === 'damage';
            }).length;
            var lengthTableTambahan = $form.find("#table_perbaikan_tambahan tbody tr").length;
            if (rowCount > 0) {
                if (rowCount > damageCount) {
                    $form.find("#table_perbaikan_tambahan").show();
                    $form.find("#alert-kerusakan").removeClass("d-none");
                    $form.find("#text-perbaikan-tambahan-edit").show();
                    $form.find("#table_perbaikan_tambahan tbody").empty();
                    for (var i = 0; i < (rowCount - damageCount); i++) {
                        let rowObject = $('<tr>' +
                            '<td class="text-center">' +
                            '<select class="form-select"  name="lokasi_kerusakan[]" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">' +
                        '<option selected disabled>Open this select menu</option>' +
                        '<option value="EXTERIOR BOTTOM SECTION">EXTERIOR BOTTOM SECTION</option>' +
                        '<option value="EXTERIOR RIGHT SECTION">EXTERIOR RIGHT SECTION</option>' +
                        '<option value="EXTERIOR LEFT SECTION">EXTERIOR LEFT SECTION</option>' +
                        '<option value="EXTERIOR TOP SECTION">EXTERIOR TOP SECTION</option>' +
                        '<option value="INTERIOR BOTTOM SECTION">INTERIOR BOTTOM SECTION</option>' +
                        '<option value="INTERIOR RIGHT SECTION">INTERIOR RIGHT SECTION</option>' +
                        '<option value="INTERIOR LEFT SECTION">INTERIOR LEFT SECTION</option>' +
                        '<option value="INTERIOR TOP SECTION">INTERIOR TOP SECTION</option>' +
                        '<option value=""DOOR">DOOR</option>' +
                        '</select>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<select class="form-select"  name="komponen[]" onfocus="this.size=5;" onblur="this.size=1;" onchange="this.size=1; this.blur();">' +
                        '<option selected disabled>Open this select menu</option>' +
                        '<option value="BENT">BENT</option>' +
'<option value="BROKEN">BROKEN</option>' +
'<option value="CASINGTREAD">CASING/TREAD</option>' +
'<option value="CONTAMINATED">CONTAMINATED</option>' +
'<option value="CORRODED">CORRODED</option>' +
'<option value="CORRODED HOLED">CORRODED/HOLED</option>' +
'<option value="CRACKED">CRACKED</option>' +
'<option value="CUT">CUT</option>' +
'<option value="DEBRIS">DEBRIS</option>' +
'<option value="DELAMINATED">DELAMINATED</option>' +
'<option value="DENT">DENT</option>' +
'<option value="DENTEDHOLED">DENTED AND HOLED</option>' +
'<option value="EQUIPMENT FAILURE">EQUIPMENT FAILURE</option>' +
'<option value="FAILURE">FAILURE</option>' +
'<option value="FROZEN">FROZEN</option>' +
'<option value="GOUGED">GOUGED</option>' +
'<option value="GRAFFITI">GRAFFITI</option>' +
'<option value="HIGH PRESSURE SAFETY">HIGH PRESSURE SAFETY</option>' +
'<option value="HOLED">HOLED</option>' +
'<option value="IMPROPER REPAIR">IMPROPER REPAIR</option>' +
'<option value="LEAKING">LEAKING</option>' +
'<option value="LOOSE">LOOSE</option>' +
'<option value="MISALIGNED">MISALIGNED</option>' +
'<option value="MISPRESSURE">MISPRESSURE</option>' +
'<option value="MISSING">MISSING</option>' +
'<option value="OILSTAIN">OILSTAIN</option>' +
'<option value="OVERLAY PLYWOOD">OVERLAY PLYWOOD</option>' +
'<option value="REMOVE">REMOVE</option>' +
'<option value="ROTTED">ROTTED</option>' +   
                        '</select>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<input type="hidden" name="metode_perbaikan_value[]"/>' +
                            '<select class="form-select" aria-label="Default select example" name="metode_perbaikan[]" id="metode">' +
                            '<option selected disabled>Open this select menu</option>' +
                        '<option value="ABRASSIN AND GCOAT">ABRASSING & COAT</option>' +
'<option value="CORNERFITTING">CORNER FITTING</option>' +
'<option value="EVAQUATION SERVICE">EVAQUATION SERVICE</option>' +
'<option value="FREE">FREE</option>' +
'<option value="GOUGED">GOUGED</option>' +
'<option value="GRIND">GRIND</option>' +
'<option value="GRIND FLOOR">GRIND FLOOR</option>' +
'<option value="INSERT">INSERT</option>' +
'<option value="INSTALL">INSTALL</option>' +
'<option value="LUBRICATE">LUBRICATE</option>' +
'<option value="OIL CLEANING">OIL CLEANING</option>' +
'<option value="OVERLAY">OVERLAY</option>' +
'<option value="PAINT">PAINT</option>' +
'<option value="PATCH">PATCH</option>' +
'<option value="PRE TRIP INSPECTION">PRE TRIP INSPECTION</option>' +
'<option value="RE-ALIGN">RE-ALIGN</option>' +
'<option value="RECHARGE">RECHARGE</option>' +
'<option value="REFIT">REFIT</option>' +
'<option value="REMOVE AND REINSTALL">Remove and Reinstall</option>' +
'<option value="REMOVE COMPONENT">REMOVE COMPONENT</option>' +
'<option value="REPLACE">REPLACE</option>' +
'<option value="RESEAL">RESEAL</option>' +
'<option value="RESECURE">RESECURE</option>' +
'<option value="SAND">SAND</option>' +
'<option value="SEAL OR RESEAL">SEAL OR RESEAL</option>' +
'<option value="SECTION">SECTION</option>' +
'<option value="STRAIGHTEN">STRAIGHTEN</option>' +
'<option value="STRAIGHTEN AND WELD">STRAIGHTEN AND WELD</option>' +
'<option value="VACUUMIZE">VACUUMIZE</option>' +
'<option value="WELD">WELD</option>'+
                                                   '</select>' +
                            '<div class="invalid-feedback"></div>' +
                            '</td>' +
                            '<td class="text-center">' +
                            '<input type="hidden" name="foto_pengecekan_name[]"/>' +
                            '<input type="file" name="foto_pengecekan[]" id="foto_perbaikan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                            '<div class="invalid-feedback"></div>' +
                            '<div class="text-start form-label"><label >min: 2048 KB</label></div>'+
                            '</td>' +
                            '</tr>');
                        $form.find("#table_perbaikan_tambahan tbody").append(rowObject); // Append new rows
                    }
                    $form.find("#table_perbaikan_tambahan tbody tr").each(function(index) {
                        let $metodeId = $(this).find('select[name="metode_perbaikan[]"]');
                        let $fotoPerbaikanId = $(this).find('input[name="foto_pengecekan[]"]');

                        $fotoPerbaikanId.on('change', function() {
                            // Get the selected file name
                            var fileName = $(this).val().split('\\').pop();
                            if (fileName === '') {
                                fileName = 'No file chosen';
                            }
                            console.log($fotoPerbaikanId);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(fileName);
                            $(this).siblings('.file-name').text(fileName);
                        });
                        $metodeId.on('change', function() {
                            // Get the selected file name
                            var selectedOptionval = $(this).find('option:selected').val();
                            console.log(selectedOptionval);
                            // Update the label with the selected file name
                            $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                        });

                    });


                } else if (rowCount < (damageCount + lengthTableTambahan)) {
                    if ($form.find("#table_perbaikan_tambahan").is(":visible")) {
                        for (var i = 0; i < ((damageCount + lengthTableTambahan) - rowCount); i++) {
                            $form.find("#table_perbaikan_tambahan tbody tr:last-child").remove();
                        }
                    } else {
                        for (var i = 0; i < (lengthTable - rowCount); i++) {
                            $form.find("#table_edit_perbaikan tbody tr:last-child").remove();
                        }
                    }
                    if (lengthTableTambahan == 1) {
                        $form.find("#table_perbaikan_tambahan").hide();
                        $form.find("#text-perbaikan-tambahan-edit").hide();
                        $form.find("#alert-kerusakan").addClass("d-none");

                    }

                }
                if (lengthTable > 0) {
                    $form.find("#table_edit_perbaikan").show();
                    $form.find("#text-perbaikan-edit").show();

                }

            } else {
                $form.find("#table_edit_perbaikan").hide();
                $form.find("#table_edit_perbaikan tbody").empty();
                $form.find("#text-perbaikan-edit").hide();
                $form.find("#alert-kerusakan").addClass("d-none");
                $form.find("#table_perbaikan_tambahan").hide();
                $form.find("#text-perbaikan-tambahan-edit").hide();
            }
            jumlah_kerusakan3_value = $(this).val();
        });
        $form.find('input[name="foto_perbaikan[]"]').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName === '') {
                fileName = 'No file chosen';
            }
            $(this).siblings('input[type="hidden"]').val(fileName);
            $(this).siblings('.file-name').text(fileName);
        });
        $form.find('select[name="metode_perbaikan[]"]').on('change', function() {
            var selectedOptionval = $(this).find('option:selected').val();
            console.log(selectedOptionval);
            $(this).siblings('input[type="hidden"]').val(selectedOptionval);


        });

        $form.find("#table_edit_perbaikan tbody tr").each(function(index) {
            let $row = $(this);
            $(this).find('select[name="status[]"]').on('change', function() {
                var selectedOptionval = $(this).find('option:selected').val();
                console.log(selectedOptionval);

                $(this).siblings('input[type="hidden"]').val(selectedOptionval);
                if ($(this).val() == 'fix') {
                    let formfoto = $('<td class="text-center">' +
                        '<input type="hidden" name="foto_perbaikan_name[]"/>' +
                        '<input type="file" name="foto_perbaikan[]" id="foto_perbaikan" class="form-control" accept="image/png, image/jpeg, image/jpg">' +
                        '<div class="invalid-feedback"></div>' +
                        '</td>');
                    $row.append(formfoto);
                    jumlahKerusakan = $form.find("#jumlah_kerusakan").val();
                    var currentValue = parseInt(jumlahKerusakan);
                    console.log(currentValue);
                    if (currentValue > 0) {
                        $form.find("#jumlah_kerusakan").val(currentValue - 1);
                    }
                    $form.find("#jumlah_kerusakan")

                    $row.find('input[name="foto_perbaikan[]"]').on('change', function() {
                        var fileName = $(this).val().split('\\').pop();
                        if (fileName === '') {
                            fileName = 'No file chosen';
                        }

                        $(this).siblings('input[type="hidden"]').val(fileName);
                        $(this).siblings('.file-name').text(fileName);
                    });
                } else {

                    $row.children(':last-child').remove();
                    jumlahKerusakan = $form.find("#jumlah_kerusakan").val();
                    var currentValue = parseInt(jumlahKerusakan);
                    console.log(currentValue);
                    if (currentValue > 0) {
                        $form.find("#jumlah_kerusakan").val(currentValue + 1);
                    }
                }

            });

        });
        loadingButton.hide();

        $form.submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            var modalId = $(this).data('id');
            $.ajax({
                url: "{{ route($cleaned.'.transaksi.editperbaikan') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function() {
                    loadingButton.show();
                },
                success: function(response) {

                    $('#' + modalId).modal('hide');
                    loadingButton.hide();
                    showAlert(response.message);
                    console.log('Success:', response);
                },

                error: function(xhr, status, error) {
                    loadingButton.hide();
                    const errors = xhr.responseJSON.errors;
                    if (xhr.status === 500) {
                        alert("Kolom Unik Tidak Boleh Sama!")
                    } else if (xhr.status === 404) {
                        alert("Data Tidak Ditemukan!");
                    }

                    $form.find('.is-invalid').removeClass('is-invalid');
                    $form.find('.invalid-feedback').text('');

                    $.each(errors, function(key, value) {
                        const element = $form.find('[name="' + key + '"]');
                        var cleanInputName = key.replace(/\.\d+/g, '');
                        var cleanAngka = value[0].replace(/\.\d+/g, '');
                        element.addClass('is-invalid');
                        element.next('.invalid-feedback').text(value[0]);
                        console.log(key + '[]');
                        const elementArray = $form.find('[name="' + cleanInputName + '[]"]');
                        if (cleanInputName.includes("name")) {
                            const index = cleanInputName.replace(/_name/i, "");
                            console.log(index);
                            const elements = $form.find('[name="' + index + '[]"]');
                            elements.addClass('is-invalid');
                            elements.next('.invalid-feedback').text(cleanAngka);
                        } else if (cleanInputName.includes("value")) {
                            const index = cleanInputName.replace(/_value/i, "");
                            console.log(index);
                            const elements = $form.find('[name="' + index + '[]"]');
                            elements.addClass('is-invalid');
                            elements.next('.invalid-feedback').text(cleanAngka);
                        }
                        elementArray.addClass('is-invalid');
                        elementArray.next('.invalid-feedback').text(cleanAngka);
                    });

                }
            });

        });

    });
</script>
@endpush