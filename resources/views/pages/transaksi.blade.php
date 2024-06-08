<x-layout>
    <x-slot:title>
        Transaksi
        </x-slot>
        <style>

        </style>

        <div class="row">
            <div class="col-lg-8">

                <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
                    <div class="d-flex justify-content-between mb-3">
                        <div class="d-flex gap-2">
                            <i class="fa-solid fa-chart-line text-white my-1" style="font-size: 30px;"></i>
                            <h2 class="text-white">Penjualan Tahun 2024</h2>

                        </div>
                        <select name="" id="" class="form-select rounded-3" style="width: fit-content; height: fit-content">
                            <option value="all">All</option>
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>

                    <div class="container bg-white rounded-4 shadow p-3">
                        {!! $chart->container() !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col container">
                    <div class="row" style="height:19rem;">
                        <div class="bg-primary mb-3 shadow rounded-4 p-3 w-100">
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="jumlah_transaksi_button" data-bs-toggle="tab" data-bs-target="#jumlahtransaksi-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                        <div class="d-flex gap-2">
                                            <i class="fa-solid fa-briefcase my-1"></i>
                                            <span class="fw-semibold">
                                                Jumlah Transaksi
                                            </span>
                                        </div>
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="grafik_button" data-bs-toggle="tab" data-bs-target="#grafikpie-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                        <div class="d-flex gap-2">
                                            <i class="fa-solid fa-chart-pie my-1"></i>
                                            <span class="fw-semibold">
                                                Grafik Pie
                                            </span>
                                        </div>
                                    </button>
                                </li>
                            </ul>
                            <div class="bg-white  p-3 d-flex align-content-center justify-content-center" style="border-radius:0px 0px 7px 7px; height: 13rem; overflow:hidden">

                                <div class="fade show active my-auto text-center" id="jumlahtransaksi-tab-pane" style="place-items: center;" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <h1 style="font-size: 60px;" class="my-auto mx-auto">6</h1>
                                    <h4>TRANSAKSI</h4>

                                </div>
                                <div class="fade" id="grafikpie-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    {!! $grafikjumlahtransaksi->container() !!}
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 mb-lg-0" style="height:30%">
                        <div class="bg-primary shadow rounded-4 p-3" style="height: auto;">
                            <div class="d-flex gap-1">
                                <i class="fa-solid fa-dollar-sign text-white my-1" style="font-size:20px"></i>
                                <p class="mb-1 text-start fw-semibold text-white" style="font-size: 17px;">Total Pendapatan</p>

                            </div>


                            <h2 class="text-white" style="font-size: 40px;">Rp.200.000,00</h2>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
            <div class="container">

                <h3 class=" text-white mb-3 text-table">DATA TRANSAKSI</h3>


                <div class="row justify-content-start justify-content-lg-between p-0 m-0">
                    <div class="p-0" style="width: fit-content;">

                        <button class="btn bg-white mb-2" data-bs-toggle="modal" data-bs-target="#form-create-transaksi">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-white" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Tambah Transaksi</span>
                            </div>
                        </button>


                        <button type="submit" class="btn bg-white mb-2  " id="button-laporan-transaksi">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-download text-white" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Laporan Bulanan Transaksi</span>
                            </div>
                        </button>
                    </div>


                </div>
                <div class="p-0 position-relative d-flex flex-lg-row flex-column justify-content-between gap-2" style="margin-top:10px;">
                    <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                        <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                    </form>
                    <div class="d-flex">
                        <label for="" class="form-label text-white fw-semibold position-absolute d-none d-lg-block" style="font-size: 12px; top:-1.5rem; right:4.5rem;">Filter Berdasarkan Bulan Transaksi</label>
                        <input type="month" class="form-control ms-auto-lg ms-0 me-2" id="monthpicker" style="width: fit-content; height: fit-content;">


                        <div class="dropdown">
                            <button class="btn bg-white" type="button" style="padding: 6px 6px 6px 6px;" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="d-flex gap-1 position-relative">
                                    <i class="fa-solid fa-sliders my-1 text-black"></i>
                                    <span>Filter</span>
                                </div>
                            </button>
                            <ul class="dropdown-menu my-2" id="filter">
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Semua</option>
                                </li>
                                <li>
                                    <option value="impor" class="dropdown-item" style="cursor:pointer;">Impor</option>
                                </li>
                                <li>
                                    <option value="eskpor" class="dropdown-item" style="cursor:pointer;">Ekspor</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Transaksi Selesai</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Transaksi Belum Selesai</option>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>

                <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                <div class="text-center">
                    <div class="spinner-grow text-light mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status">
                    </div>
                </div>
                <div class="onscroll table-responsive position-relative" style="margin-bottom:20px">

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
                <div id="pagination" class="mx-auto" style="width:fit-content">
                    {{ $transaksi->links() }}
                </div>

            </div>
        </div>
        <section id="table_transaksi_body"></section>
        <x-modal-form-delete route="/transaksi/delete" />
        <x-modal-form id="form-create-transaksi" size="modal-xl" text="Tambah Transaksi">
            <x-form-create-transaksi />
        </x-modal-form>
        <x-toast />
        @push('page-script')
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        {{ $chart->script() }}
        {{$grafikjumlahtransaksi->script() }}
        <script>
            $(document).ready(function() {
                $('#grafik-tab-pane').children(':first-child').removeAttr('style');
                let currentPage = 1;
                let lastpage = 1;

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
                    console.log('hai');
                    let selectedMonth = $(this).val();
                    let [year, month] = selectedMonth.split('-');


                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), selectedMonth, $('#searchInput').val());
                });
                let pagination = $("#pagination").find('.pagination');
                $("#grafikpie-tab-pane").hide();
                $('#jumlah_transaksi_button').on('click', function(e) {
                    $("#jumlahtransaksi-tab-pane").show();
                    $("#grafikpie-tab-pane").hide();
                });
                $('#grafik_button').on('click', function(e) {
                    $("#jumlahtransaksi-tab-pane").hide();
                    $("#grafikpie-tab-pane").show();
                });

                function updatePaginationLinks(totalPages) {
                    pagination.empty();
                    pagination.append('<li class="page-item"><a class="page-link" href="#table_transaksi_body" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
                    for (let i = 1; i <= totalPages; i++) {
                        let link = $('<a>').addClass('page-link').attr('href', '#table_transaksi_body').text(i);
                        let listItem = $('<li>').addClass('page-item').append(link);
                        pagination.append(listItem);
                    }
                    pagination.append('<li class="page-item"><a class="page-link" href="#table_transaksi_body" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
                }

                function showPage(pageNumber) {
                    // Update the active class on pagination links
                    pagination.find('.page-item').removeClass('active');
                    pagination.find('li').each(function() {
                        if ($(this).find('.page-link').text() == pageNumber) {
                            $(this).addClass('active');
                        }
                    });
                }

                function showLoadingSpinner() {
                    $('.spinner-grow').show();
                    $('.onscroll').hide();
                    $("#pagination").hide();
                }

                function hideLoadingSpinner() {
                    $('.spinner-grow').hide();
                    $('.onscroll').show();
                    $("#pagination").show();
                }

                function fetchDataAndUpdateTable(value1, value2, value3) {
                    const currentContent = $('#table_transaksi').html();
                    $.ajax({
                        url: '/transaksi/index',
                        type: 'GET',
                        data: {
                            jenis_kegiatan: value1,
                            bulan_transaksi: value2,
                            search: value3,
                            page: currentPage
                        },
                        beforeSend: function() {
                            showLoadingSpinner();
                        },
                        success: function(response) {
                            $('#table_transaksi').show();
                            hideLoadingSpinner();
                            $('#text-error').hide();
                            $('#table_transaksi tbody').empty();
                            $.each(response.Data, function(index, item) {
                                $('#table_transaksi tbody').append('<tr><td>' + item.no_transaksi + '</td><td>' + item.jenis_kegiatan.charAt(0).toUpperCase() + item.jenis_kegiatan.slice(1) + '</td><td>' + item.jumlah_petikemas + '</td><td><div class="btn-group gap-2"><a class="btn bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/transaksi/' + item.id + '"> <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a><button class="btn btn-danger text-white p-0 rounded-3" id="deletetransaksi"  style="width: 2.5rem; height: 2.2rem;"   value="' + item.id + '"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button></div></td>' +
                                    '</tr>');
                            });


                            window.scrollTo({
                                top: document.body.scrollHeight,
                                behavior: 'smooth'
                            });

                            // Handle error message
                            if (response.message) {
                                $('#table_transaksi').hide();
                                $('#text-error').show();
                                $('#text-error').text(response.message);
                            }

                            // Update pagination links
                            updatePaginationLinks(response.meta.last_page);
                            lastpage = response.meta.last_page;
                            // Show the current page
                            showPage(currentPage);

                            // Handle delete button click
                            $(document).on('click', '#deletetransaksi', function(e) {
                                e.preventDefault();
                                $("#form-delete-data").modal('show');
                                $("#input_form_delete").val($(this).val());
                                console.log($(this).val());
                            });



                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
                fetchDataAndUpdateTable();
                pagination.off('click', 'a.page-link').on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    let pageNum = $(this).text();

                    if ($(this).attr('aria-label') === 'Previous') {
                        if (currentPage > 1) {
                            currentPage--;
                        }
                    } else if ($(this).attr('aria-label') === 'Next') {
                        if (currentPage < lastpage) {
                            currentPage++;
                        }
                    } else {
                        currentPage = parseInt(pageNum);
                    }

                    // Fetch data and update table, then scroll to the bottom
                    fetchDataAndUpdateTable($('#jenis_kegiatan').val(), $('#monthpicker').val(), $('#searchInput').val())

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
            });
        </script>
        @stack('form-modal')
        @stack('form-delete')
        @stack('toast-script')
        @endpush
</x-layout>