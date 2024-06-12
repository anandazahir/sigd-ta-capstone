@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role)
@endphp
<x-layout>
    <x-slot:title>
        Entry Data
        </x-slot>
        <div class="row">
            <div class="col-lg-6">
                <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
                    <div class="d-flex gap-1">
                        <i class="fa-solid fa-dollar-sign text-white my-1" style="font-size:20px"></i>
                        <p class="mb-1 text-start fw-semibold text-white" style="font-size: 17px;">Total Pendapatan</p>
                        <i class="fa-regular fa-circle-question my-2" style="color:#F5F5F5; font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Pendapatan dihitung dalam setiap bulan"></i>
                    </div>
                    <h2 class="text-white" style="font-size: 40px;" id="totalpendapatan">4</h2>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
                    <div class="d-flex gap-1">
                        <i class="fa-solid fa-dollar-sign text-white my-1" style="font-size:20px"></i>
                        <p class="mb-1 text-start fw-semibold text-white" style="font-size: 17px;">Total Pendapatan</p>
                        <i class="fa-regular fa-circle-question my-2" style="color:#F5F5F5; font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Pendapatan dihitung dalam setiap bulan"></i>
                    </div>
                    <h2 class="text-white" style="font-size: 40px;" id="totalpendapatan">4</h2>
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
                    </div>


                </div>
                <div class="p-0 position-relative d-flex flex-lg-row flex-column justify-content-between gap-2" style="margin-top:10px;">
                    <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                        <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                    </form>
                    <div class="d-flex ms-lg-0 ms-lg-auto">
                        <label for="" class="form-label text-white fw-semibold position-absolute d-none d-lg-block" style="font-size: 12px; top:-1.5rem; right:4.5rem;">Filter Berdasarkan Bulan Transaksi</label>
                        <input type="month" class="form-control" id="monthpicker" style="width: fit-content; height: fit-content;">

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
                            <li data-value="impor" class="dropdown-item" style="cursor:pointer;">Impor</li>
                            <li data-value="ekspor" class="dropdown-item" style="cursor:pointer;">Ekspor</li>
                            <li data-value="transaksi-selesai" class="dropdown-item" style="cursor:pointer;">Transaksi Selesai</li>
                            <li data-value="transaksi-belum-selesai" class="dropdown-item" style="cursor:pointer;">Transaksi Belum Selesai</li>
                        </ul>
                    </div>

                </div>

                <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                <div class="text-center">
                    <div class="spinner-grow text-light mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-table">
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
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>

        <x-modal-form id="form-create-transaksi" size="modal-xl" text="Tambah Transaksi">
            <x-form-create-transaksi />
        </x-modal-form>
        <x-toast />
        @push('page-script')


        <script>
            $(document).ready(function() {
                let currentPage = 1;
                let lastPage = 1;
                let valueselect = '';
                const $filterDropdown = $('#filter .dropdown-item');
                const $textTable = $('.text-table');
                const $monthPicker = $('#monthpicker');
                const $searchForm = $('#searchForm');
                const $searchInput = $('#searchInput');
                const $pagination = $("#pagination").find('.pagination');
                const $tableTransaksi = $('#table_transaksi');
                const $loadingTable = $('#loading-table');
                const $onScroll = $('.onscroll');


                const $buttonLaporanTransaksi = $("#button-laporan-transaksi");
                const $responseMessage = $('#response-message');
                const $monthSelect = $("#monthselect");

                $filterDropdown.click(function() {
                    valueselect = $(this).data('value');
                    let selectText = $(this).text();
                    if (valueselect) {
                        $textTable.text(`DATA TRANSAKSI | ${selectText.charAt(0).toUpperCase() + selectText.substring(1)}`);
                    } else {
                        $textTable.text('DATA TRANSAKSI');
                    }
                    fetchDataAndUpdateTable();
                });

                $searchForm.on('submit', function(event) {
                    event.preventDefault();
                    fetchDataAndUpdateTable();
                });

                $monthPicker.change(function() {
                    fetchDataAndUpdateTable();
                });


                function updatePaginationLinks(totalPages) {
                    $pagination.empty();
                    $pagination.append('<li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>');
                    for (let i = 1; i <= totalPages; i++) {
                        let link = $('<a>').addClass('page-link').attr('href', '#').text(i);
                        let listItem = $('<li>').addClass('page-item').append(link);
                        $pagination.append(listItem);
                    }
                    $pagination.append('<li class="page-item"><a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>');
                }

                function showPage(pageNumber) {
                    $pagination.find('.page-item').removeClass('active');
                    $pagination.find('li').each(function() {
                        if ($(this).find('.page-link').text() == pageNumber) {
                            $(this).addClass('active');
                        }
                    });
                }

                function showLoadingSpinner() {
                    $loadingTable.show();
                    $onScroll.hide();
                    $pagination.hide();
                }

                function hideLoadingSpinner() {
                    $loadingTable.hide();
                    $onScroll.show();
                    $pagination.show();
                }

                function fetchDataAndUpdateTable() {
                    $.ajax({
                        url: "{{route($cleaned.'.transaksi.filter')}}",
                        type: 'GET',
                        data: {
                            jenis_kegiatan: valueselect,
                            bulan_transaksi: $monthPicker.val(),
                            search: $searchInput.val(),
                            page: currentPage
                        },
                        beforeSend: showLoadingSpinner,
                        success: function(response) {
                            $tableTransaksi.show();
                            hideLoadingSpinner();
                            $('#text-error').hide();
                            $tableTransaksi.find('tbody').empty();
                            $.each(response.Data, function(index, item) {
                                $tableTransaksi.find('tbody').append(
                                    `<tr><td>${item.no_transaksi}</td>
                        <td>${item.jenis_kegiatan.charAt(0).toUpperCase() + item.jenis_kegiatan.slice(1)}</td>
                        <td>${item.jumlah_petikemas}</td>
                        <td><div class="btn-group gap-2">
                        <a class="btn bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="${window.location.pathname}/${item.id}"> 
                        <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a>
                       </div></td></tr>`
                                );
                            });
                            /*
                                                        window.scrollTo({
                                                            top: document.body.scrollHeight,
                                                            behavior: 'smooth'
                                                        });
                                                        */

                            if (response.message) {
                                $tableTransaksi.hide();
                                $('#text-error').show().text(response.message);
                                $pagination.hide();
                            } else {
                                $pagination.show();
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

                $pagination.off('click', 'a.page-link').on('click', 'a.page-link', function(e) {
                    e.preventDefault();
                    let pageNum = $(this).text();

                    if ($(this).attr('aria-label') === 'Previous' && currentPage > 1) {
                        currentPage--;
                    } else if ($(this).attr('aria-label') === 'Next' && currentPage < lastPage) {
                        currentPage++;
                    } else {
                        currentPage = parseInt(pageNum);
                    }

                    fetchDataAndUpdateTable();
                });

                fetchDataAndUpdateTable();



            });
        </script>
        @stack('form-modal')
        @stack('toast-script')
        @endpush
</x-layout>