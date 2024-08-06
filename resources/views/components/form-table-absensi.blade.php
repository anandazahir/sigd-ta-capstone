<form action="/direktur/absensi/edit/{{$absensi->id}}" method="POST" id="edit_form_absensi_{{$absensi->id}}" novalidate data-id="{{$id}}">
    @csrf
    <div class="mb-3 form-group">
        <label for="nama" class="form-label">Waktu Masuk</label>
        <input type="time" class="form-control" id="nama" placeholder="Nama" name="waktu_masuk" required value="{{\Carbon\Carbon::parse($absensi->waktu_masuk)->format('H:i') }}">
        <div class="invalid-feedback"></div>
    </div>
    <div class="mb-3 form-group">
        <label for="nip" class="form-label">Keterangan Masuk</label>
        <select class="form-select" aria-label="Default select example" required name="keterangan_masuk">
            <option selected disabled>Plih Opsi Ini</option>
            <option value="hadir" {{ $absensi->status_masuk == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="terlambat" {{ $absensi->status_masuk == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            <option value="cuti" {{ $absensi->status_masuk == 'cuti' ? 'selected' : '' }}>Cuti</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>
    <div class="mb-3 form-group">
        <label for="nama" class="form-label">Waktu Pulang</label>
        <input type="time" class="form-control" id="nama" placeholder="Nama" name="waktu_pulang" required value="{{ \Carbon\Carbon::parse($absensi->waktu_pulang)->format('H:i') }}">
        <div class="invalid-feedback"></div>
    </div>
    <div class="mb-3 form-group">
        <label for="nip" class="form-label">Keterangan Pulang</label>
        <select class="form-select" aria-label="Default select example" required name="keterangan_pulang">
            <option selected disabled>Plih Opsi Ini</option>
            <option value="hadir" {{ $absensi->status_pulang == 'hadir' ? 'selected' : '' }}>Hadir</option>
            <option value="terlambat" {{ $absensi->status_pulang == 'terlambat' ? 'selected' : '' }}>Terlambat</option>
            <option value="cuti" {{ $absensi->status_pulang == 'cuti' ? 'selected' : '' }}>Cuti</option>
        </select>
        <div class="invalid-feedback"></div>
    </div>
    <button type="submit" class="btn bg-primary text-white">Submit</button>
</form>
<script>
    /*
    $(document).ready(function() {
        let formId = "edit_form_absensi_{{$absensi->id}}";
        let $form = $("#" + formId);

        $form.submit(function(event) {
            handleFormSubmission(this);
        });
    });*/
</script>