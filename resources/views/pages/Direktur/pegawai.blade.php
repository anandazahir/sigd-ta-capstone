<x-layout>
    <x-slot:title>
        Pegawai
        </x-slot>
        <div class="w-100 bg-primary mb-4 shadow rounded-4 p-3">
            <div class="container">
                <h3 class=" text-white" style="margin-bottom:20px;">DATA PEGAWAI</h3>
                <div class="row justify-content-between p-0 m-0" style=" margin-top:20px;">
                    <div class="p-0" style="width: fit-content;">
                        <button class="btn bg-white mb-2" data-bs-toggle="modal" data-bs-target="#create-pegawai-modal">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Menambah Data Pegawai">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-white" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Tambah Pegawai</span>
                            </div>
                        </button>

                    </div>

                    <div class="p-0" style="width: fit-content;">
                        <form class="d-flex m-0 p-0" role="search" style="width: 21rem;" id="searchForm">
                            <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                            <button class="btn btn-info shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                        </form>
                    </div>
                </div>
                <h1 class="text-center mt-3 text-white" id="text-error"></h1>
                <div class="text-center">
                    <div class="spinner-grow text-light" style="width: 3rem; height: 3rem;" role="status" id="loading-table">
                    </div>
                </div>
                <div class="onscroll table-container table-responsive" style="height: auto;">
                    <table class="table-variations-2  text-center" id="table_pegawai" rules="groups">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">Nama Panjang</th>
                                <th scope="col" class="fw-semibold">NIP</th>
                                <th scope="col" class="fw-semibold">Jabatan</th>
                                <th scope="col" class="fw-semibold">No. Telepon</th>
                                <th scope="col" class="fw-semibold">Email</th>
                                <th scope="col" class="fw-semibold">Username</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
            <div id="pagination" class="mx-auto" style="width:fit-content">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">

                    </ul>
                </nav>
            </div>
        </div>
        <x-modal-form size="" text="Tambah Pegawai" id="create-pegawai-modal">
            <x-form-create-pegawai />
        </x-modal-form>
        <x-modal-form-delete route="/direktur/pegawai/delete" />
        <x-modal-form-reset-password />
        <x-toast />
        @push('page-script')
        <script>
            $(document).ready(function() {

                let currentPage = 1;
                let lastPage = 1;
                const pagination = $("#pagination").find('.pagination');
                const $searchForm = $('#searchForm');
                const $searchInput = $('#searchInput');
                const $textTable = $("#texttable");
                let searchQuery = '';

                // Search form submission
                $searchForm.on('submit', function(event) {
                    event.preventDefault();
                    searchQuery = $searchInput.val();
                    fetchDataAndUpdateTable();
                });

                function showLoadingSpinner() {
                    $('#loading-table').show();
                    $('.onscroll, #pagination').hide();
                    $('#text-error').hide()
                    $('#table_pegawi').hide()
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

                function ucwords(str) {
                    return str.replace(/\b\w/g, function(char) {
                        return char.toUpperCase();
                    });
                }

                // Fetch data and update table
                function fetchDataAndUpdateTable() {
                    $.ajax({
                        url: '/direktur/pegawai/index',
                        type: 'POST',
                        data: {
                            search: searchQuery,
                            page: currentPage,
                            _token: '{{ csrf_token() }}',
                        },
                        beforeSend: showLoadingSpinner(),
                        success: function(response) {
                            hideLoadingSpinner();
                            $('#table_pegawai').show();
                            $('#text-error').hide();
                            const tbody = $('#table_pegawai tbody').empty();

                            $.each(response.Data, function(index, item) {
                                deleteButton = `<button class="btn btn-danger text-white p-0 rounded-3 delete-petikemas" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                                    <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i>
                                    </button>`;
                                const row = `<tr>
    <td>${ucwords(item.nama)}</td>
    <td>${item.nip}</td>
    <td>${ucwords(item.jabatan)}</td>
    <td>${item.no_hp}</td>
    <td>${item.email}</td>
    <td>${ucwords(item.username)}</td>
    <td>
        <div class="btn-group gap-2">
            <a class="btn bg-primary text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/direktur/pegawai/${item.id}">
                <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i>
            </a>
            <button class="btn btn-primary text-white p-0 rounded-3 reset-password" style="width: 2.5rem; height: 2.2rem;" value="${item.id}"  data-bs-toggle="tooltip" data-bs-placement="top" title="Reset Password">
                                    <i class=" fa-solid fa-key text-white" style="font-size: 20px;"></i>
                                    </button>
            ${deleteButton}
        </div>
    </td>
</tr>`;

                                // Append the row to the table (assume you have a table body with id="table-body")
                                tbody.append(row);
                            });

                            window.scrollTo({
                                top: document.body.scrollHeight,
                                behavior: 'smooth'
                            });

                            if (response.message) {
                                $('#table_pegawai').hide();
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

                $(document).on('click', '.reset-password', function(e) {
                    e.preventDefault();
                    $("#form-reset-password-modal").modal('show');
                    $("#input-form-reset-password").val($(this).val());
                    console.log($(this).val());
                });

                fetchDataAndUpdateTable();

            });
        </script>
        @stack('toast-script')
        @stack('form-modal')
        @stack('form-delete')
        @endpush

</x-layout>