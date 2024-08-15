@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role)
@endphp
<x-layout>
    <x-slot:title>
        Pembayaran
        </x-slot>
        


        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
            <div class="container">

                <h4 class=" text-white mb-3 text-table">DATA TRANSAKSI</h4>
                <button type="submit" class="btn bg-white mb-2  shadow" id="button-laporan-transaksi">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Membuat Laporan Bulanan">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button"></span>
                                    <i class="fa-solid fa-download text-white" style="font-size:17px;" id="icon"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Laporan Harian Transaksi</span>
                            </div>
                        </button>
                <div class="p-0 position-relative d-flex flex-lg-row flex-column justify-content-between gap-2" style="margin-top:10px;">
                    <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                        <button class="btn btn-info shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                    </form>
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


        @push('page-script')


        <script>
            $(document).ready(function() {
                let currentPage = 1;
                let lastPage = 1;
                let valueselect = '';
                const $filterDropdown = $('#filter .dropdown-item');
                const $textTable = $('.text-table');

                const $searchForm = $('#searchForm');
                const $searchInput = $('#searchInput');
                const $pagination = $("#pagination").find('.pagination');
                const $tableTransaksi = $('#table_transaksi');
                const $loadingTable = $('#loading-table');
                const $onScroll = $('.onscroll');

                const $buttonLaporanTransaksi = $("#button-laporan-transaksi");
                const $responseMessage = $('#response-message');
                const $monthSelect = $("#monthselect");

              

                $('#loading-button').hide();

function showLoadingButton() {
    $('#loading-button').show();
    $('#icon').hide();
    $('#text-error').hide();
}

function hideLoadingButton() {
    $('#loading-button').hide();
    $('#icon').show();
}


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
                    $('#text-error').hide();
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
                            filter: valueselect,
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
                        <a class="btn shadow bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="${window.location.pathname}/${item.id}"> 
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
                $buttonLaporanTransaksi.on("click", function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route($cleaned.'.transaksi.laporantransaksi') }}",
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                           
                        },
                        beforeSend: showLoadingButton(),
                        xhrFields: {
                            responseType: 'blob'
                        },
                        success: function(blob) {
                            hideLoadingButton();
                            var url = window.URL.createObjectURL(blob);
                            window.open(url, '_blank');
                        },
                        error: function(xhr) {
                            hideLoadingButton();
                            console.log(xhr.responseText);
                            $responseMessage.text('Error generating report.');
                        }
                    });
                });
            });
        </script>
        @endpush
</x-layout>