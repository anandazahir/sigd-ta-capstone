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

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="in_button" data-bs-toggle="tab" data-bs-target="#in-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">


                                <span class="fw-semibold">
                                    IN
                                </span>

                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="out_button" data-bs-toggle="tab" data-bs-target="#out-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">


                                <span class="fw-semibold">
                                    OUT
                                </span>

                            </button>
                        </li>
                    </ul>
                    <div class="bg-white  p-3 d-flex align-content-center " style="border-radius:0px 0px 7px 7px;">
                        <div class="fade show active my-auto w-100 onscroll" id="in-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <table class="table w-100 table-responsive custom-table">
                                <tr>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Hari Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Minggu Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">10</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">20</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">30</td>
                                </tr>
                            </table>
                        </div>
                        <div class="fade w-100 onscroll" id="out-tab-pane" idrole="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <table class="table w-100 table-responsive custom-table">
                                <tr>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Hari Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Minggu Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">10</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">20</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">30</td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

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
                            <button class="nav-link active" id="available_button" data-bs-toggle="tab" data-bs-target="#available-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">


                                <span class="fw-semibold">
                                    AVAILABLE
                                </span>

                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="damage_button" data-bs-toggle="tab" data-bs-target="#damage-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">


                                <span class="fw-semibold">
                                    DAMAGE
                                </span>

                            </button>
                        </li>
                    </ul>
                    <div class="bg-white  p-3 d-flex align-content-center " style="border-radius:0px 0px 7px 7px;">
                        <div class="fade show active my-auto w-100 onscroll" id="available-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <table class="table w-100 table-responsive custom-table">
                                <tr>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Hari Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Minggu Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">10</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">20</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">30</td>
                                </tr>
                            </table>
                        </div>
                        <div class="fade w-100 onscroll" id="damage-tab-pane" idrole="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <table class="table w-100 table-responsive custom-table">
                                <tr>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Hari Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Minggu Ini</td>
                                    <td class=" fw-semibold text-center" style="color:#b3b3b3">Bulan Ini</td>
                                </tr>
                                <tr>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">10</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">20</td>
                                    <td class="text-black fw-bold text-center" style="font-size: 20px;">30</td>
                                </tr>
                            </table>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3 ">
            <div class="container">
                <h3 class=" text-white mb-3">DATA PETI KEMAS</h3>
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

                        <a href="" class="btn bg-white mb-2  ">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-download text-white" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Laporan Harian </span>
                            </div>
                        </a>
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
                            <select name="" id="" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                <option value="">Blok</option>
                            </select>
                            <span class="text-white fw-semibold fs-4">-</span>
                            <select name="" id="" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                <option value="">Row</option>
                            </select>
                            <span class="text-white fw-semibold fs-4">-</span>
                            <select name="" id="" class="form-select ms-auto-lg ms-0 me-2" style="width: fit-content; height: fit-content;">
                                <option value="">Tier</option>
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
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Semua</option>
                                </li>
                                <li>
                                    <option value="impor" class="dropdown-item" style="cursor:pointer;">AVAILABLE</option>
                                </li>
                                <li>
                                    <option value="eskpor" class="dropdown-item" style="cursor:pointer;">DAMAGE</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">OUT</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">IN</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">PENDING</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Petikemas Dipesan</option>
                                </li>
                                <li>
                                    <option value="" class="dropdown-item" style="cursor:pointer;">Petikemas Tidak Dipesan</option>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
                <h1 class="text-center mt-3 text-white" id="text-error"></h1>
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
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true" class="">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item active" aria-current="page"><a class="page-link " href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span class="" aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
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
                var currentPage = 1;
                $("#out-tab-pane").hide();
                $("#ekspor-tab-pane").hide();
                $("#damage-tab-pane").hide();
                $('#in_button').on('click', function(e) {
                    $("#in-tab-pane").show();
                    $("#out-tab-pane").hide();
                });
                $('#out_button').on('click', function(e) {
                    $("#in-tab-pane").hide();
                    $("#out-tab-pane").show();
                });
                $('#impor_button').on('click', function(e) {
                    $("#impor-tab-pane").show();
                    $("#ekspor-tab-pane").hide();
                });
                $('#ekspor_button').on('click', function(e) {
                    $("#impor-tab-pane").hide();
                    $("#ekspor-tab-pane").show();
                });
                $('#available_button').on('click', function(e) {
                    $("#available-tab-pane").show();
                    $("#damage-tab-pane").hide();
                });
                $('#damage_button').on('click', function(e) {
                    $("#available-tab-pane").hide();
                    $("#damage-tab-pane").show();
                });
                $('#searchForm').on('submit', function(event) {
                    event.preventDefault();
                    var searchQuery = $('#searchInput').val();
                    fetchDataAndUpdateTable(searchQuery);
                });

                function updatePaginationLinks(totalPages) {
                    var paginationContainer = $('.pagination');
                    paginationContainer.empty();
                    for (var i = 1; i <= totalPages; i++) {
                        var link = $('<a>').addClass('page-link').attr('href', '#').text(i);
                        var listItem = $('<li>').addClass('page-item').append(link);
                        paginationContainer.append(listItem);
                    }
                    paginationContainer.prepend(
                        '<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>'
                    );
                    paginationContainer.append(
                        '<li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>'
                    );
                }

                function fetchDataAndUpdateTable(value1) {
                    $.ajax({
                        url: '/peti-kemas/index',
                        type: 'GET',
                        data: {
                            search: value1,
                            page: currentPage
                        },
                        success: function(response) {
                            $('#table_petikemas').show();
                            $('#text-error').hide();
                            $('#table_petikemas tbody').empty();
                            $.each(response.Data, function(index, item) {
                                $('#table_petikemas tbody').append(
                                    '<tr><td>' + item.no_petikemas +
                                    '</td><td>' + item.jenis_ukuran +
                                    '</td><td>' + item.pelayaran.charAt(0).toUpperCase() + item
                                    .pelayaran.slice(1) +
                                    '</td><td> <div class="' + (item.status_kondisi === 'damage' ? 'bg-danger' :
                                        item.status_kondisi === 'available' ? 'bg-primary' : '') + ' fw-semibold fs-5 p-1 rounded-2 text-white " style="display: inline-block;">' + item.status_kondisi +
                                    '</div></td><td><div class="fw-semibold fs-5 bg-primary p-1 rounded-2 text-white" style="display: inline-block;">' + item.status_ketersediaan +
                                    '</div></td><td><div class="fw-semibold fs-5 bg-primary p-1 rounded-2 text-white">' + item.lokasi +
                                    '</div></td><td><div class="btn-group gap-2"><a class="btn bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/peti-kemas/' +
                                    item.id +
                                    '"> <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a><button class="btn btn-danger text-white p-0 rounded-3" id="deletepetikemas"  style="width: 2.5rem; height: 2.2rem;"   value="' +
                                    item.id +
                                    '"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button></div></td>' +
                                    '</tr>');
                            });
                            $(document).on('click', '#deletepetikemas', function(e) {
                                e.preventDefault();
                                $("#form-delete-data").modal('show');
                                $("#input_form_delete").val($(this).val());
                                console.log($(this).val());
                            });
                            if (response.message) {
                                $('#table_petikemas').hide();
                                $('#text-error').show();
                                $('#text-error').text(response.message);

                            }
                            updatePaginationLinks(response.meta.last_page);
                            console.log(response.meta.last_page);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
                $('.pagination').on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    var pageNum = $(this).text();
                    currentPage = parseInt(pageNum);
                    fetchDataAndUpdateTable($('#searchInput').val());
                });
                fetchDataAndUpdateTable();
            });
        </script>
        @stack('form-modal')
        @stack('form-delete')
        @stack('toast-script')
        @endpush

</x-layout>