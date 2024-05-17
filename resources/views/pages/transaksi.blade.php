@php

@endphp
<x-layout>
    <x-slot:title>
        Transaksi
        </x-slot>
        <style>

        </style>

        <div class="position-relative" style="margin-bottom: 33px;">

            <select class="form-select bg-primary text-white font-semibold" id="jenis_kegiatan" style="width: fit-content;" name="jenis_kegiatan">
                <option selected value="">Jenis Transaksi</option>
                <option value="impor">Impor</option>
                <option value="ekspor">Ekspor</option>
            </select>

            <div class="btn-primary rounded-circle btn month-picker  position-absolute top-0 end-0 " style="margin-right: 10px; margin-bottom:15px; padding:14px 17px 14px 17px">
                <i class="fa-solid fa-calendar-days text-white" style="font-size:35px;"></i>
                <input type="month" name="bulan_transaksi" id="monthpicker">
            </div>
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
                            <h4 class="fw-semibold text-white m-0" id="total_transaksi"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
            <div class="container">
                <h3 class=" text-white mb-2 text-table">DATA TRANSAKSI</h3>
                <hr class="line p-0 m-0" style="height: 2px; background-color:#FFF; width:36vh;" />
                <h3 class=" text-white mb-2 month-text"></h3>
                <div class="row justify-content-start justify-content-lg-between p-0 m-0" style=" margin-top:20px;">
                    <div class="p-0" style="width: fit-content;">

                        <button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#form-create-transaksi">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Tambah Transaksi</span>
                            </div>
                        </button>


                        <button type="submit" class="btn btn-info mb-2  " id="button-laporan-transaksi">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-download text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Laporan Bulanan Transaksi</span>
                            </div>
                        </button>
                    </div>

                    <div class="p-0" style="width: fit-content;">
                        <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 21rem;">
                            <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                            <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                        </form>
                    </div>
                </div>
                <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                <div class="onscroll table-responsive">
                    <table class="table-variations-2  text-center" rules="groups" id="table_transaksi">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">No Transaksi</th>
                                <th scope="col" class="fw-semibold">Jenis Kegiatan</th>
                                <th scope="col" class="fw-semibold">Jumlah Peti Kemas</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true" class="">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item active" aria-current="page"><a class="page-link " href="#">1</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span class="" aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
        <x-modal-form-delete route="/transaksi/delete" />
        <x-modal-form id="form-create-transaksi" size="modal-xl">
            <x-form-create-transaksi />
        </x-modal-form>
        <x-toast />
        <script>
            $(document).ready(function() {
                let currentPage = 1
                $('#jenis_kegiatan').change(function() {
                    let selectedType = $(this).val();
                    if (selectedType !== "") {
                        $('.text-table').text('DATA TRANSAKSI | ' + selectedType.charAt(0).toUpperCase() + selectedType.substring(1));
                    } else {
                        $('.text-table').text('DATA TRANSAKSI');
                    }
                    fetchDataAndUpdateTable(selectedType, $('#monthpicker').val(), $('#searchInput').val());
                });
                $('#searchForm').on('submit', function(event) {
                    event.preventDefault();
                    let searchQuery = $('#searchInput').val();
                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), $('#monthpicker').val(), searchQuery);
                });
                $('#monthpicker').change(function() {
                    let selectedMonth = $(this).val();
                    let [year, month] = selectedMonth.split('-');
                    let monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
                        "Juli", "Augustus", "September", "Oktober", "November", "Desember"
                    ];
                    let monthName = monthNames[parseInt(month, 10) - 1];
                    $('.month-text').text('');
                    if (selectedMonth != "") {
                        $('.month-text').text(monthName + ' ' + year);
                    }
                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), selectedMonth, $('#searchInput').val());
                });

                function updatePaginationLinks(totalPages) {
                    let paginationContainer = $('.pagination');
                    paginationContainer.empty();
                    for (let i = 1; i <= totalPages; i++) {
                        let link = $('<a>').addClass('page-link').attr('href', '#').text(i);
                        let listItem = $('<li>').addClass('page-item').append(link);
                        paginationContainer.append(listItem);
                    }
                    paginationContainer.prepend('<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
                    paginationContainer.append('<li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
                }

                function fetchDataAndUpdateTable(value1, value2, value3) {
                    $.ajax({
                        url: '/transaksi/index',
                        type: 'GET',
                        data: {
                            jenis_kegiatan: value1,
                            bulan_transaksi: value2,
                            search: value3,
                            page: currentPage
                        },
                        success: function(response) {
                            $('#table_transaksi').show();
                            $('#text-error').hide();
                            $('#table_transaksi tbody').empty();
                            $.each(response.Data, function(index, item) {
                                $('#table_transaksi tbody').append('<tr><td>' + item.no_transaksi + '</td><td>' + item.jenis_kegiatan.charAt(0).toUpperCase() + item.jenis_kegiatan.slice(1) + '</td><td>' + item.jumlah_petikemas + '</td><td><div class="btn-group gap-2"><a class="btn btn-info text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/transaksi/' + item.id + '"> <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a><button class="btn btn-danger text-white p-0 rounded-3" id="deletetransaksi"  style="width: 2.5rem; height: 2.2rem;"   value="' + item.id + '"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button></div></td>' +
                                    '</tr>');
                            });
                            $(document).on('click', '#deletetransaksi', function(e) {
                                e.preventDefault();
                                $("#form-delete-data").modal('show');
                                $("#input_form_delete").val($(this).val());
                                console.log($(this).val());
                            });
                            $('#total_transaksi').text(response.Count);
                            if (response.message) {
                                $('#table_transaksi').hide();
                                $('#text-error').show();
                                $('#text-error').text(response.message);

                            }
                            updatePaginationLinks(response.meta.last_page);

                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }

                $('.pagination').on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    let pageNum = $(this).text();
                    currentPage = parseInt(pageNum);
                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), $('#monthpicker').val(), $('#searchInput').val());
                });


                $('.pagination').on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    let pageNum = $(this).text();
                    currentPage = parseInt(pageNum);
                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), $('#monthpicker').val(), $('#searchInput').val());
                });


                $("#button-laporan-transaksi").on("click", function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('transaksi.laporantransaksi') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            jenis_kegiatan: $('#jenis_kegiatan').val(),
                            bulan_transaksi: $('#monthpicker').val()
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(blob) {
                            var url = window.URL.createObjectURL(blob);
                            window.open(url, '_blank');
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            $('#response-message').text('Error generating report.');
                        }
                    });
                });


                fetchDataAndUpdateTable();
            });
        </script>
</x-layout>