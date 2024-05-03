<x-layout>
    <x-slot:title>
        Transaksi
        </x-slot>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
        @endif
        <div class="position-relative" style="margin-bottom: 33px;">
            <div class="dropdown">
                <button class="btn btn-primary rounded-4 dropdown-toggle element-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; ">
                    <span class="fs-5 fw-semibold text-white text-dropdown">Jenis Transaksi</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Jenis Transaksi</a></li>
                    <li><a class="dropdown-item" href="#">Impor</a></li>
                    <li><a class="dropdown-item" href="#">Ekspor</a></li>
                </ul>
            </div>
            <form class="btn-primary rounded-circle btn month-picker  position-absolute top-0 end-0 " style="margin-right: 10px; margin-bottom:15px; padding:14px 17px 14px 17px">
                <i class="fa-solid fa-calendar-days text-white" style="font-size:35px;"></i>
                <input type="month" name="" id="monthpicker">
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="card bg-primary text-white rounded-4 shadow">
                    <div class="card-body d-flex gap-2">
                        <div class="rounded-circle bg-white p-3" style="width: fit-content; height:fit-content;">
                            <i class="fa-solid fa-copy text-primary fa-xl"></i>
                        </div>
                        <div class="d-block">
                            <p class="m-0 text-white ">Total Transaksi</p>
                            <h4 class="fw-semibold text-white m-0">20</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: 50rem;">
            <div class="container">
                <h3 class=" text-white mb-2 text-table">DATA TRANSAKSI</h3>
                <hr class="line p-0 m-0" style="height: 2px; background-color:#FFF; width:36vh;" />
                <h3 class=" text-white mb-2 month-text"></h3>
                <div class="row justify-content-start justify-content-lg-between p-0 m-0" style=" margin-top:20px;">
                    <div class="p-0" style="width: fit-content;">

                        <button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#form-create-entrydata">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Tambah Transaksi</span>
                            </div>
                        </button>
                        </a>

                        <a href="" class="btn btn-info mb-2  ">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-download text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Laporan Bulanan Transaksi</span>
                            </div>
                        </a>
                    </div>

                    <div class="p-0" style="width: fit-content;">
                        <form class="d-flex m-0 p-0" role="search" style="width: 21rem;">
                            <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                            <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                        </form>
                    </div>
                </div>

                <div class="onscroll table-container table-responsive">
                    <table class="table-variations-2  text-center" rules="groups" id="table_entrydata">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No Transaksi</th>
                                <th scope="col" class="fw-semibold">Jenis Kegiatan</th>
                                <th scope="col" class="fw-semibold">Jumlah Peti Kemas</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            {{--  @foreach($transaksi as $data) <tr>
                                <td>{{$data->no_transaksi}}</td>
                                <td>{{ucfirst($data->jenis_kegiatan)}}</td>
                                <td>{{$data->jumlah_petikemas}}</td>
                                <td>
                                    <div class="btn-group gap-2">
                                        <a class="btn btn-info text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="{{ route('transaksi.show', ['id' => $data->id]) }}"> <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a>
                                        <button class="btn btn-danger text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" data-bs-target="#form-delete-data" data-bs-toggle="modal"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <x-modal-form-delete :route="route('transaksi.delete', $data->id)" />
                            @endforeach  --}}
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        <x-modal-form id="form-create-entrydata" size="">
            <x-form-create-entrydata />
        </x-modal-form>

        <x-toast />
        <script>
            $(document).ready(function() {
                $('.dropdown-item').click(function() {
                    var selectedType = $(this).text();

                    if (selectedType !== "Jenis Transaksi") {
                        $('.text-table').text('DATA TRANSAKSI | ' + selectedType);
                    } else {
                        $('.text-table').text('DATA TRANSAKSI');
                    }


                    $('.element-dropdown .text-dropdown').text(selectedType);

                });

                $('#monthpicker').change(function() {
                    var selectedMonth = $(this).val();
                    var [year, month] = selectedMonth.split('-');

                    var monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Augustus", "September", "Oktober", "November", "Desember"
                    ];
                    var monthName = monthNames[parseInt(month, 10) - 1];
                    $('.month-text').text(monthName + ' ' + year);
                });

                function fetchDataAndUpdateTable() {
                    var jenisKegiatan = $('#jenis_transaksi').val();
                    var bulanTransaksi = $('#bulan_transaksi').val();
            
                    $.ajax({
                        url: '/test',
                        type: 'GET',
                        data: {
                            jenis_kegiatan: jenisKegiatan,
                            bulan_transaksi: bulanTransaksi
                        },
                        success: function (data) {
                            console.log("Hi");
                           
                         /*   $('#table_entrydata tbody').empty(); */
            
                            $.each(data, function(index, item) {
                                $('#table_entrydata tbody').append('<tr><td>' + item.no_transaksi + '</td><td>' + item.jenis_kegiatan + '</td></tr>');
                               
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                }
            
                $('#jenis_kegiatan, #monthpicker').change(fetchDataAndUpdateTable);
            
               
                
            });
            fetchDataAndUpdateTable();
        </script>


</x-layout>