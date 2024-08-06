@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role)
@endphp
<x-layout>
    <x-slot:title>
        Perbaikan
        </x-slot>
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
                    <div class="d-flex gap-1">
                        <i class="fa-solid fa-chart-simple text-white my-1" style="font-size:20px"></i>
                        <p class="mb-1 text-start fw-semibold text-white" style="font-size: 17px;">Total Transaksi Berdasarkan Peti Kemas Rusak</p>
                        <i class="fa-regular fa-circle-question my-2" style="color:#F5F5F5; font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Peti Kemas yang Diperbaiki"></i>
                    </div>
                    <h2 class="text-white" style="font-size: 40px;" id="totalperbaikanpetikemas"></h2>
                </div>
            </div>
        </div>


        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
            <div class="container">

                <h5 class=" text-white mb-3 text-table">DATA TRANSAKSI BERDASARKAN PETI KEMAS RUSAK</h5>

                <div class="p-0 position-relative d-flex flex-lg-row flex-column justify-content-between gap-2" style="margin-top:10px;">
                    <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                        <button class="btn btn-info shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                    </form>
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

                let totalperbaikanpetikemas = "{{$totalperbaikanpetikemas}}";

                function initCountUp(id, endVal) {
                    let demo = new CountUp(id, 0, endVal, 0, 3);
                    if (!demo.error) {
                        demo.start();
                    } else {
                        console.error(demo.error);
                    }
                }
                initCountUp('totalperbaikanpetikemas', parseInt(totalperbaikanpetikemas));

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
                        url: "/repair/perbaikan/index",
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
                        <td>${item.jenis_kegiatan}</td>
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