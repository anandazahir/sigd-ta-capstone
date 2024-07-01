@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<x-layout>
    <x-slot:title>
        Notifikasi
        </x-slot>
        <div class="card bg-primary mb-3 table-container rounded-4">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-between mb-2">
                        <h4 class=" text-white col-lg-6">NOTIFIKASI</h4>
                        <div class="p-0" style="width: fit-content;">
                            <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                                <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                                <button class="btn btn-info shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                            </form>
                        </div>
                    </div>
                    <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                    <div class="text-center">
                        <div class="spinner-grow text-light mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-table">
                        </div>
                    </div>

                    <div class="onscroll table-responsive">
                        <table class="table-variations-2  text-center table-notification" id="table-notifikasi" rules="groups">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-semibold">Pesan</th>
                                    <th scope="col" class="fw-semibold">Tanggal</th>
                                    <th scope="col" class="fw-semibold">Waktu</th>
                                    <th scope="col" class="fw-semibold">Pengirim</th>
                                    <th scope="col" class="fw-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
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
            </div>
        </div>
        <x-modal-form-delete route="/{{$cleaned}}/notifikasi/delete" />
        <x-toast />
        @push('page-script')
        <script>
            $(document).ready(function() {
                let currentPage = 1;
                let lastPage = 1;
                const $tableNotifikasi = $('#table-notifikasi')
                const $pagination = $("#pagination").find('.pagination');
                const $searchForm = $('#searchForm');
                const $searchInput = $('#searchInput');
                const $loadingTable = $('#loading-table');
                const $onScroll = $('.onscroll');
                const texticon = $('#text-notif').text();
                let numtextnotif = parseInt(texticon);
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
                }

                function hideLoadingSpinner() {
                    $loadingTable.hide();
                    $onScroll.show();
                    $pagination.show();
                }

                function fetchDataAndUpdateTable() {
                    $.ajax({
                        url: "{{route($cleaned.'.notifikasi.filter')}}",
                        type: 'GET',
                        data: {
                            search: $searchInput.val(),
                            page: currentPage
                        },
                        beforeSend: showLoadingSpinner,
                        success: function(response) {
                            $tableNotifikasi.show();
                            hideLoadingSpinner();
                            $('#text-error').hide();
                            const baseUrl = "{{ asset('storage') }}";
                            $tableNotifikasi.find('tbody').empty();
                            $.each(response.Data, function(index, item) {
                                const fotoprofilurl = baseUrl + '/' + item.foto_profil;
                                const profileContent = item.foto_profil == null ?
                                    ` <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="25" height="25" class="rounded-circle">
              <title>user-solid-svg</title>
              <style>
                .s1 {
                  fill: #ffffff
                }
              </style>
              <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
              <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
            </svg>` :
                                    `<img src="${fotoprofilurl}" alt="" class="rounded-circle" width="25" height="25">`;
                                $tableNotifikasi.find('tbody').append(
                                    `<tr>
            <td style="width: 40vh">${item.message}</td>
            <td><div class="my-5">${new Date(item.tanggal_kirim).toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' })}</div></td>
            <td><div class="my-5">${new Date(item.tanggal_kirim).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })}</div></td>
            <td class="text-center">
                <div class="my-5">

                                ${profileContent}
                <span class="m-0 p-0 d-inline mx-1">${item.sender.toUpperCase()}</span>
                </div>
            </td>
            <td>
                <div class="btn-group gap-2 my-5">
                    <a class="btn bg-primary text-white rounded-3 text-center button-open" style="height: 2.2rem" href="${item.link}">
                        <i class="fa-solid fa-arrow-up-right-from-square text-white" style="font-size: 20px;"></i>
                        <span class="text-white mx-1 fw-semibold d-none d-lg-inline-block">OPEN</span>
                    </a>
                    <button class="btn btn-danger text-white p-0 rounded-3 delete-notifikasi" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                        <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i>
                    </button>
                </div>
            </td>
        </tr>`
                                );
                            });
                            /*
                                                        window.scrollTo({
                                                            top: document.body.scrollHeight,
                                                            behavior: 'smooth'
                                                        });
                                                        */

                            if (response.message) {
                                $tableNotifikasi.hide();
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

                // Event listener for delete button
                $(document).on('click', '.delete-notifikasi', function(e) {
                    e.preventDefault();
                    $("#form-delete-data").modal('show');
                    $("#input_form_delete").val($(this).val());
                    console.log($(this).val());
                });

            });
        </script>
        @stack('form-delete')
        @stack('toast-script')
        @endpush
</x-layout>