<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold month-text">Kehadiran</h1>

        <form class="btn-light rounded-circle btn month-picker position-absolute top-0 end-0" style="margin-right: 10px; padding: 9px 11px 9px 11px">
            <i class="fa-solid fa-calendar-days text-primary" style="font-size: 30px;"></i>
            <input type="month" name="" id="selectedMonth">
        </form>

        <div class="row mt-3">
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>HADIR</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>CUTI</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row mt-lg-3 mt-0">
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-danger  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-white position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-danger">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3 class="text-white">TERLAMBAT</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:white;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-danger  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-white position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-danger">1</h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3 class="text-white">TIDAK HADIR</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:white;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 30rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Tanggal</th>
                        <th scope="col" class="fw-semibold">Waktu Masuk</th>
                        <th scope="col" class="fw-semibold">Keterangan</th>
                        <th scope="col" class="fw-semibold">Waktu Pulang</th>
                        <th scope="col" class="fw-semibold">Keterangan</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">
                            Senin, 01 Desember 2022
                        </td>
                        <td class="text-center">
                            07.45
                        </td>
                        <td class="text-center">
                            <span class="bg-success p-1 rounded-3 text-white">Absen</span>
                        </td>
                        <td class="text-center">
                            16.00
                        </td>
                        <td class="text-center">
                            <span class="bg-success p-1 rounded-3 text-white">Absen</span>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-info text-white rounded-3" data-bs-toggle="modal" data-bs-target="#form-table-absensi"> <i class="fa-solid fa-pen-to-square fa-lg my-1"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        $('#selectedMonth').change(function() {

            var selectedMonth = $(this).val();


            var [year, month] = selectedMonth.split('-');

            var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                "Juli", "Augustus", "September", "Oktober", "November", "Desember"
            ];
            var monthName = monthNames[parseInt(month, 10) - 1];


            $('.month-text').text('Kehadiran | ' + monthName + ' ' + year);
        });
    });
</script>