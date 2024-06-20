<x-layout>
    <x-slot:title>
        Notifikasi
        </x-slot>
        <div class="card bg-primary mb-3 table-container rounded-4" style="height: 50rem;">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-between mb-2">
                        <h4 class=" text-white col-lg-6">NOTIFIKASI</h4>
                        <div class="p-0" style="width: fit-content;">
                            <form class="d-flex m-0 p-0" role="search" style="width: 21rem;">
                                <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                                <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="onscroll table-responsive">
                        <table class="table-variations-2  text-center" rules="groups">
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

        <script>
        $(document).ready(function() {
            // Function to fetch and display notifications
            function fetchDataAndUpdateTable() {
                $.ajax({
                    url: "{{route($cleaned.'.transaksi.filter')}}",
                    type: 'GET',
                    data: {
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
                    <button class="btn btn-danger text-white p-0 rounded-3 delete-transaksi" style="width: 2.5rem; height: 2.2rem;" value="${item.id}">
                    <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button></div></td></tr>`
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
        
            // Initial fetch of notifications
            fetchNotifications();
        
            // Event listener for delete button
            $(document).on('click', '.delete-btn', function() {
                var notificationId = $(this).data('id');
                $.ajax({
                    url: '/notifikasi/delete',
                    method: 'DELETE',
                    data: {
                        id: notificationId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            fetchNotifications(); // Refresh notifications list
                        } else {
                            alert('Failed to delete notification');
                        }
                    },
                    error: function() {
                        alert('An error occurred while deleting the notification');
                    }
                });
            });
        });
        </script>
        
    </x-layout>