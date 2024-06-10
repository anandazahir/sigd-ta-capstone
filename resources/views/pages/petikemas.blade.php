<x-layout>
    <x-slot:title>
        Peti Kemas
        </x-slot>
        <style>
            .custom-table td,
            .custom-table th {
                border-top: none;
                border-bottom: none;
            }

            .custom-table td:not(:first-child),
            .custom-table th:not(:first-child) {
                border-left: 1px solid #b3b3b3;
            }

            .custom-table td:not(:last-child),
            .custom-table th:not(:last-child) {
                border-right: 1px solid #b3b3b3;
            }
        </style>
        <div class="row">
            <!-- Status Ketersediaan Petikemas -->
            <div class="col-lg-6 mb-3">
                <div class="w-100 p-3 bg-primary text-white rounded-4 shadow">
                    <div class="d-flex gap-2">
                        <svg style="fill:white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                            <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                            </g>
                        </svg>
                        <h5 class="mb-3 text-white fw-semibold">Status Ketersediaan Petikemas</h5>
                    </div>

                    <ul class="nav nav-tabs" id="test" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="in_button" data-bs-toggle="tab" data-bs-target="#in-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">
                                <span class="fw-semibold">IN</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="out_button" data-bs-toggle="tab" data-bs-target="#out-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                                <span class="fw-semibold">OUT</span>
                            </button>
                        </li>
                    </ul>
                    <div>

                    </div>
                    <div class="bg-white  p-3 d-flex align-content-center w-100" style="border-radius:0px 0px 7px 7px; height: 138px">
                        <table class="table w-100 table-responsive custom-table show active fade" id="in-tab-pane">
                            <tr>
                                <td class=" text-center"><span class="fw-semibold" style="color:#b3b3b3">Hari Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Minggu Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Bulan Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold" style="color:#b3b3b3">Total</span></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="today-in" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="week-in" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="month-in" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="total-in" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                            </tr>
                        </table>
                        <table class="table w-100 table-responsive custom-table d-none fade" id="out-tab-pane">
                            <tr>
                                <td class="text-center"><span class="fw-semibold" style="color:#b3b3b3">Hari Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Minggu Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Bulan Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold" style="color:#b3b3b3">Total</span></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="today-out" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="week-out" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="month-out" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="total-out" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Status Kondisi Petikemas -->

            <div class="col-lg-6 mb-3">
                <div class="w-100 p-3 bg-primary text-white rounded-4 shadow">
                    <div class="d-flex gap-2">
                        <svg style="fill:white" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="32" height="32">
                            <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                            </g>
                        </svg>
                        <h5 class="mb-3 text-white fw-semibold">Status Kondisi Petikemas</h5>
                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="available_button" data-bs-toggle="tab" data-bs-target="#available-tab-pane" type="button" role="tab" aria-controls="available-tab-pane" aria-selected="true">
                                <span class="fw-semibold">AVAILABLE</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="damage_button" data-bs-toggle="tab" data-bs-target="#damage-tab-pane" type="button" role="tab" aria-controls="damage-tab-pane" aria-selected="false">
                                <span class="fw-semibold">DAMAGE</span>
                            </button>
                        </li>
                    </ul>
                    <div class="bg-white  p-3 d-flex align-content-center " style="border-radius:0px 0px 7px 7px; height: 138px">
                        <table class="table w-100 table-responsive custom-table show active fade" id="available-tab-pane">
                            <tr>
                                <td class=" text-center"><span class="fw-semibold" style="color:#b3b3b3">Hari Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Minggu Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Bulan Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold" style="color:#b3b3b3">Total</span></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="today-available" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="week-available" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="month-available" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="total-available" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                            </tr>
                        </table>
                        <table class="table w-100 table-responsive custom-table d-none fade" id="damage-tab-pane">
                            <tr>
                                <td class="text-center"><span class="fw-semibold" style="color:#b3b3b3">Hari Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Minggu Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold " style="color:#b3b3b3">Bulan Ini</span></td>
                                <td class="text-center"><span class=" fw-semibold" style="color:#b3b3b3">Total</span></td>
                            </tr>
                            <tr>
                                <td class="text-center"><span id="today-damage" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="week-damage" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="month-damage" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                                <td class="text-center"><span id="total-damage" class="text-black fw-bold" style="font-size: 20px;">0</span></td>
                            </tr>
                        </table>
                    </div>

                </div>
            </div>
            <div class="container">
                <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3 ">
                    <div class="container">
                        <h3 class=" text-white mb-3" id="texttable">DATA PETI KEMAS</h3>
                        <div class="row justify-content-start justify-content-lg-between p-0 m-0" style=" margin-top:20px;">
                            <div class="p-0" style="width: fit-content;">
                                <button class="btn bg-white mb-2" data-bs-toggle="modal" data-bs-target="#form-create-petikemas">
                                    <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah Data Pegawai">
                                        <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                            <i class="fa-solid fa-plus text-white" style="font-size:17px;"></i>
                                        </div>
                                        <span class="fs-5 fw-semibold text-primary">Tambah Petikemas</span>
                                    </div>
                                </button>

                                <button id="laporan_harian" class="btn bg-white mb-2  ">
                                    <div class="d-flex gap-1">
                                        <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                            <i class="fa-solid fa-download text-white" style="font-size:17px;"></i>
                                        </div>
                                        <span class="fs-5 fw-semibold text-primary">Laporan Harian </span>
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
                                <label for="" class="form-label text-white fw-semibold position-absolute d-none d-lg-block" style="font-size: 12px; top:-1.5rem; right:10rem;">Filter Berdasarkan Lokasi Petikemas</label>
                                <div class="d-flex gap-1">
                                    <select name="" id="blok" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                        <option value="">Blok</option>
                                        <option value="A1">A1</option>
                                    </select>
                                    <span class="text-white fw-semibold fs-4">-</span>
                                    <select name="" id="row" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                        <option value="">Row</option>
                                        <option value="11">Row</option>
                                    </select>
                                    <span class="text-white fw-semibold fs-4">-</span>
                                    <select name="" id="tier" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                        <option value="">Tier</option>
                                        <option value="11">11</option>
                                    </select>
                                </div>

                                <div class="dropdown">
                                    <button class="btn bg-white" type="button" style="padding: 6px 6px 6px 6px;" data-bs-toggle="dropdown" aria-expanded="false">
                                        <div class="d-flex gap-1 position-relative">
                                            <i class="fa-solid fa-sliders my-1 text-black"></i>
                                            <span>Filter</span>
                                        </div>
                                    </button>
                                    <ul class="dropdown-menu my-2" id="filter">
                                        <li data-value="" class="dropdown-item" style="cursor:pointer;">Semua</li>
                                        <li data-value="available" class="dropdown-item" style="cursor:pointer;">AVAILABLE</li>
                                        <li data-value="damage" class="dropdown-item" style="cursor:pointer;">DAMAGE</li>
                                        <li data-value="out" class="dropdown-item" style="cursor:pointer;">OUT</li>
                                        <li data-value="in" class="dropdown-item" style="cursor:pointer;">IN</li>
                                        <li data-value="pending" class="dropdown-item" style="cursor:pointer;">PENDING</li>
                                        <li data-value="petikemas-dipesan" class="dropdown-item" style="cursor:pointer;">Petikemas Dipesan</li>
                                        <li data-value="petikemas-tidak-dipesan" class="dropdown-item" style="cursor:pointer;">Petikemas Tidak Dipesan</li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                        <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                        <div class="text-center">
                            <div class="spinner-grow text-light mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-table">
                            </div>
                        </div>
                        <div class="onscroll table-responsive">
                            <table class="table-variations-2  text-center" rules="groups" id="table_petikemas">
                                <thead>
                                    <tr>
                                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                                        <th scope="col" class="fw-semibold">Size & Type</th>
                                        <th scope="col" class="fw-semibold">Pelayaran</th>
                                        <th scope="col" class="fw-semibold">Status Kondisi</th>
                                        <th scope="col" class="fw-semibold">Status Ketersediaan</th>
                                        <th scope="col" class="fw-semibold">Lokasi</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                            <div id="pagination" class="mx-auto" style="width:fit-content">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">

                                    </ul>
                                </nav>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <x-modal-form-delete route="/peti-kemas/delete" />
        <x-modal-form id="form-create-petikemas" size="" text="Tambah Petikemas">
            <x-form-create-petikemas />
        </x-modal-form>
        <x-toast />
        @push('page-script')
        <script>
            $(document).ready(function() {

                let currentPage = 1;
                let lastPage = 1;
                const pagination = $("#pagination").find('.pagination');
                let valueselect = '';
                const $filterDropdown = $('#filter .dropdown-item');
                const $searchForm = $('#searchForm');
                const $searchInput = $('#searchInput');
                const $textTable = $("#texttable");
                const $blok = $('#blok');
                let blokVal = $blok.val();
                const $row = $('#row');
                let rowVal = $row.val();
                const $tier = $('#tier');
                let tierVal = $tier.val();
                let totalIn = parseInt("{{ $totalIn }}");
                let totalOut = parseInt("{{ $totalOut }}");
                let totalAvailable = parseInt("{{ $totalAvailable }}");
                let totalDamage = parseInt("{{ $totalDamage }}");

                let todayIn = parseInt("{{ $todayIn }}");
                let todayOut = parseInt("{{ $todayOut }}");
                let todayAvailable = parseInt("{{ $todayAvailable }}");
                let todayDamage = parseInt("{{ $todayDamage }}");

                let weekIn = parseInt("{{ $weekIn }}");
                let weekOut = parseInt("{{ $weekOut }}");
                let weekAvailable = parseInt("{{ $weekAvailable }}");
                let weekDamage = parseInt("{{ $weekDamage }}");

                let monthIn = parseInt("{{ $monthIn }}");
                let monthOut = parseInt("{{ $monthOut }}");
                let monthAvailable = parseInt("{{ $monthAvailable }}");
                let monthDamage = parseInt("{{ $monthDamage }}");
                const $laporanharian = $("#laporan_harian");

                function initCountUp(id, endVal) {
                    let demo = new CountUp(id, 0, endVal, 0, 3);
                    if (!demo.error) {
                        demo.start();
                    } else {
                        console.error(demo.error);
                    }
                }



                // Function to hide loading spinner
                initCountUp('today-in', todayIn);
                initCountUp('week-in', weekIn);
                initCountUp('month-in', monthIn);
                initCountUp('total-in', totalIn);
                initCountUp('today-available', todayAvailable);
                initCountUp('week-available', weekAvailable);
                initCountUp('month-available', monthAvailable);
                initCountUp('total-available', totalAvailable)


                // Tab switching logic
                $('#in_button').on('click', function() {
                    $("#in-tab-pane").show();
                    $("#out-tab-pane").addClass('d-none');
                    initCountUp('today-in', todayIn);
                    initCountUp('week-in', weekIn);
                    initCountUp('month-in', monthIn);
                    initCountUp('total-in', totalIn);
                });

                $('#out_button').on('click', function() {
                    $("#in-tab-pane").hide();
                    $("#out-tab-pane").removeClass('d-none');
                    initCountUp('today-out', todayOut);
                    initCountUp('week-out', weekOut);
                    initCountUp('month-out', monthOut);
                    initCountUp('total-out', totalOut);
                });

                $('#available_button').on('click', function() {
                    $("#available-tab-pane").show();
                    $("#damage-tab-pane").addClass('d-none');
                    initCountUp('today-available', todayAvailable);
                    initCountUp('week-available', weekAvailable);
                    initCountUp('month-available', monthAvailable);
                    initCountUp('total-available', totalAvailable);
                });

                $('#damage_button').on('click', function() {
                    $("#available-tab-pane").hide();
                    $("#damage-tab-pane").removeClass('d-none');
                    initCountUp('today-damage', todayDamage);
                    initCountUp('week-damage', weekDamage);
                    initCountUp('month-damage', monthDamage);
                    initCountUp('total-damage', totalDamage);
                });


                // Search form submission
                $searchForm.on('submit', function(event) {
                    event.preventDefault();
                    const searchQuery = $searchInput.val();
                    fetchDataAndUpdateTable();
                });

                $filterDropdown.click(function(e) {
                    e.preventDefault();
                    valueselect = $(this).data('value');
                    let selectText = $(this).text();
                    if (valueselect) {
                        $textTable.text(`DATA PETIKEMAS | ${selectText}`);
                    } else {
                        $textTable.text('DATA PETIKEMAS');
                    }
                    fetchDataAndUpdateTable();
                });
                $blok.change(function(e) {
                    console.log('hai');
                    e.preventDefault();
                    blokVal = $(this).val();
                    fetchDataAndUpdateTable();
                });
                $row.change(function(e) {
                    e.preventDefault();
                    rowVal = $(this).val();
                    fetchDataAndUpdateTable();
                });
                $tier.change(function(e) {
                    e.preventDefault();
                    tierVal = $(this).val();
                    fetchDataAndUpdateTable();
                });

                // Show and hide loading spinner
                function showLoadingSpinner() {
                    $('#loading-table').show();
                    $('.onscroll, #pagination').hide();
                    $('#text-error').hide()
                }

                function hideLoadingSpinner() {
                    $('#loading-table').hide();
                    $('.onscroll, #pagination').show();
                }

                // Update pagination links
                function updatePaginationLinks(totalPages) {
                    pagination.empty();
                    pagination.append('<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
                    for (let i = 1; i <= totalPages; i++) {
                        const link = $('<a>').addClass('page-link').attr('href', '#').text(i);
                        const listItem = $('<li>').addClass('page-item').append(link);
                        pagination.append(listItem);
                    }
                    pagination.append('<li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
                }

                // Highlight active page in pagination
                function showPage(pageNumber) {
                    pagination.find('.page-item').removeClass('active');
                    pagination.find('li').each(function() {
                        if ($(this).find('.page-link').text() == pageNumber) {
                            $(this).addClass('active');
                        }
                    });
                }

                // Fetch data and update table
                function fetchDataAndUpdateTable() {
                    const searchQuery = $searchInput.val();
                    const filter = valueselect;
                    $.ajax({
                        url: '/peti-kemas/index',
                        type: 'GET',
                        data: {
                            search: searchQuery,
                            page: currentPage,
                            condition: filter,
                            blok: blokVal,
                            row: rowVal,
                            tier: tierVal
                        },
                        beforeSend: showLoadingSpinner,
                        success: function(response) {
                            hideLoadingSpinner();
                            $('#table_petikemas').show();
                            $('#text-error').hide();
                            const tbody = $('#table_petikemas tbody').empty();

                            $.each(response.Data, function(index, item) {
                                const statusClass = item.status_kondisi === 'damage' ? 'bg-danger' : item.status_kondisi === 'available' ? 'bg-primary' : '';
                                const statusClassKetersediaan = item.status_ketersediaan === 'out' ? 'bg-danger' : 'bg-primary';
                                const Lokasi = item.lokasi === 'out' ? 'bg-danger' : 'bg-primary';
                                const row = `<tr>
                        <td>${item.no_petikemas}</td>
                        <td>${item.jenis_ukuran}</td>
                        <td>${item.pelayaran.toUpperCase()}</td>
                        <td><div class="${statusClass} fw-semibold fs-5 p-1 rounded-2 text-white">${item.status_kondisi.toUpperCase()}</div></td>
                        <td><div class="fw-semibold fs-5 ${statusClassKetersediaan} p-1 rounded-2 text-white mx-auto" style="width: 45%;">${item.status_ketersediaan.toUpperCase()}</div></td>
                        <td><div class="fw-semibold fs-5 ${Lokasi} bg-primary p-1 rounded-2 text-white">${item.lokasi.toUpperCase()}</div></td>
                        <td><div class="btn-group gap-2">
                            <a class="btn bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/peti-kemas/${item.id}"><i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a>
                            <button class="btn btn-danger text-white p-0 rounded-3 delete-petikemas" style="width: 2.5rem; height: 2.2rem;" value="${item.id}"><i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                        </div></td>
                    </tr>`;
                                tbody.append(row);
                            });

                            window.scrollTo({
                                top: document.body.scrollHeight,
                                behavior: 'smooth'
                            });

                            if (response.message) {
                                $('#table_petikemas').hide();
                                $('#text-error').show().text(response.message);
                                pagination.hide();
                            } else {
                                pagination.show();
                            }

                            updatePaginationLinks(response.meta.last_page);
                            lastPage = response.meta.last_page;
                            showPage(currentPage);
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                }

                // Pagination click handler
                pagination.on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    const pageNum = $(this).text();

                    if ($(this).attr('aria-label') === 'Previous' && currentPage > 1) {
                        currentPage--;
                    } else if ($(this).attr('aria-label') === 'Next' && currentPage < lastPage) {
                        currentPage++;
                    } else {
                        currentPage = parseInt(pageNum);
                    }

                    fetchDataAndUpdateTable($('#searchInput').val());
                });

                // Dynamic delete button click handler
                $(document).on('click', '.delete-petikemas', function(e) {
                    e.preventDefault();
                    $("#form-delete-data").modal('show');
                    $("#input_form_delete").val($(this).val());
                    console.log($(this).val());
                });

                fetchDataAndUpdateTable();
                $laporanharian.on("click", function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('petikemas.laporanharian') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            condition: valueselect,
                        },
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(blob) {
                            var url = window.URL.createObjectURL(blob);
                            window.open(url, '_blank');
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);

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