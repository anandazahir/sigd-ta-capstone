@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role)
@endphp
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
                            <h2 class="text-white">Penjualan</h2>

                        </div>
                        <select name="" id="monthselect" class="form-select rounded-3" style="width: fit-content; height: fit-content">
                            <option selected value="all">All</option>
                            @php
                            $currentMonth = date('n'); // Get the current month as a number (1-12)
                            $months = [
                            1 => 'Januari',
                            2 => 'Februari',
                            3 => 'Maret',
                            4 => 'April',
                            5 => 'Mei',
                            6 => 'Juni',
                            7 => 'Juli',
                            8 => 'Agustus',
                            9 => 'September',
                            10 => 'Oktober',
                            11 => 'November',
                            12 => 'Desember'
                            ];
                            @endphp
                            @for ($i = 5; $i <= $currentMonth; $i++) <option value="{{ $i }}">{{ $months[$i] }}</option>
                                @endfor
                        </select>
                    </div>

                    <div class="container bg-white rounded-4 shadow p-3 text-center align-content-center" style="height:325px">
                        <div class="spinner-grow text-primary mx-auto my-auto" style="width: 3rem; height: 3rem;" role="status" id="loading-chart">
                        </div>
                        <div id="chart"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="col container">
                    <div class="row">
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
                            <div class="bg-white  p-3 d-flex align-content-center justify-content-center" style="border-radius:0px 0px 7px 7px; height: 30vh; overflow:hidden">

                                <div class="fade show active my-auto text-center" id="jumlahtransaksi-tab-pane" style="place-items: center;" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                    <h1 style="font-size: 60px;" class="my-auto mx-auto" id="totaltransaksi"></h1>
                                    <h4>TRANSAKSI</h4>

                                </div>
                                <div class="fade" id="grafikpie-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 mb-lg-2" style="height:30%">
                        <div class="bg-primary shadow rounded-4 p-3" style="height: auto;">
                            <div class="d-flex gap-1">
                                <i class="fa-solid fa-dollar-sign text-white my-1" style="font-size:20px"></i>
                                <p class="mb-1 text-start fw-semibold text-white" style="font-size: 17px;">Total Pendapatan</p>
                                <i class="fa-regular fa-circle-question my-2" style="color:#F5F5F5; font-size:12px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Jumlah Pendapatan dihitung dalam setiap bulan"></i>
                            </div>
                            <h2 class="text-white" style="font-size: 40px;" id="totalpendapatan">0</h2>
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
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Transaksi">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-white" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Tambah Transaksi</span>



                            </div>
                        </button>


                        <button type="submit" class="btn bg-white mb-2  " id="button-laporan-transaksi">
                            <div class="d-flex gap-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Membuat Laporan Bulanan">
                                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                                    <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button"></span>
                                    <i class="fa-solid fa-download text-white" style="font-size:17px;" id="icon"></i>
                                </div>
                                <span class="fs-5 fw-semibold text-primary">Laporan Bulanan Transaksi</span>
                            </div>
                        </button>
                    </div>


                </div>
                <div class="p-0 position-relative d-flex flex-lg-row flex-column justify-content-between gap-2" style="margin-top:10px;">
                    <form class="d-flex m-0 p-0" role="search" id="searchForm" style="width: 19rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;" id="searchInput">
                        <button class="btn btn-info shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                    </form>
                    <div class="d-flex ms-lg-0 ms-lg-auto ">
                        <label for="" class="form-label text-white fw-semibold position-absolute d-none d-lg-block" style="font-size: 12px; top:-1.5rem; right:4.5rem;">Filter Berdasarkan Bulan Transaksi</label>
                        <input type="month" class="form-control" id="monthpicker" style="width: fit-content; height: fit-content;" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter Berdasarkan Bulan">

                    </div>
                    <div class="dropdown" data-bs-toggle="tooltip" data-bs-placement="top" title="Filter">
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
        <section id="table_transaksi_body"></section>
        <x-modal-form-delete route="/{{$cleaned}}/transaksi/delete" />
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
                const $grafikpieTabPane = $("#grafikpie-tab-pane");
                const $jumlahTransaksiButton = $('#jumlah_transaksi_button');
                const $grafikButton = $('#grafik_button');
                const $formDeleteData = $("#form-delete-data");
                const $inputFormDelete = $("#input_form_delete");
                const $buttonLaporanTransaksi = $("#button-laporan-transaksi");
                const $responseMessage = $('#response-message');
                const $monthSelect = $("#monthselect");
                const $chartContainer = $("#chart");
                const $loadingChart = $("#loading-chart");

                let num = parseInt("{{$totaltransaksi}}");
                let pendapatan = parseInt("{{$totalHarga}}");

                const options = {
                    separator: '.',
                    prefix: 'Rp.',
                    decimal: ',',
                    suffix: ',00',
                };

                let demo = new CountUp('totaltransaksi', 0, num, 0, 3);
                demo.start();
                let totalpendapatan = new CountUp('totalpendapatan', 0, pendapatan, 0, 2, options);
                totalpendapatan.start();

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

                $jumlahTransaksiButton.on('click', function() {
                    $("#jumlahtransaksi-tab-pane").show();
                    let demo = new CountUp('totaltransaksi', 0, num, 0, 2);
                    demo.start();
                    $grafikpieTabPane.hide().empty();
                });

                $grafikButton.on('click', function() {
                    $("#jumlahtransaksi-tab-pane").hide();
                    $grafikpieTabPane.show();
                    let numImpor = parseInt("{{$totaltransaksiimpor}}");
                    let numEkspor = parseInt("{{$totaltransaksiekspor}}");

                    var options = {
                        series: [numImpor, numEkspor],
                        chart: {
                            width: 295,
                            type: 'pie',
                        },
                        labels: ['Impor', 'Ekspor'],
                        dataLabels: {
                            formatter: function(val, opts) {
                                return opts.w.config.series[opts.seriesIndex];
                            },
                            style: {
                                textOutline: false
                            },
                            dropShadow: {
                                enabled: false
                            }
                        },
                        plotOptions: {
                            pie: {
                                dataLabels: {
                                    offset: -30,
                                },
                            }
                        }
                    };
                    var chart = new ApexCharts($grafikpieTabPane[0], options);
                    chart.render();
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
                            jenis_kegiatan: valueselect,
                            bulan_transaksi: $monthPicker.val()
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

                let chart;

                $(document).on('click', '.delete-transaksi', function(e) {
                    e.preventDefault();
                    $("#form-delete-data").modal('show');
                    $("#input_form_delete").val($(this).val());
                    console.log($(this).val());
                });

                function fetchSalesData(month) {
                    return $.ajax({
                        url: `${window.location.pathname}/chart/${month}`,
                        method: 'GET',
                        dataType: 'json',
                        beforeSend: function() {
                            $loadingChart.show();
                            $chartContainer.hide();
                        },
                        success: function() {
                            $loadingChart.hide();
                            $chartContainer.show();
                        }
                    });
                }

                function renderChart(seriesData, isMonthly, total) {
                    if (chart) {
                        chart.destroy();
                    }

                    const defaultLabelCount = 10;
                    let xaxisConfig = {
                        type: 'category',
                    };

                    if (!isMonthly) {
                        xaxisConfig.labels = {
                            rotate: -45,
                            formatter: function(value) {
                                const totalLabels = seriesData[0].data.length;
                                const interval = Math.ceil(totalLabels / defaultLabelCount);
                                const dataPointIndex = seriesData[0].data.findIndex(item => item.x === value);
                                return dataPointIndex % interval === 0 ? value : '';
                            }
                        };
                    }

                    const monthText = $monthSelect.find('option:selected').text();
                    const titleText = isMonthly ? `${new Date().getFullYear()} |  Total: ${total} box` : ` ${monthText} | Total: ${total} box`;

                    chart = new ApexCharts($chartContainer[0], {
                        chart: {
                            type: 'line',
                            height: 295,
                            toolbar: {
                                show: true,
                                tools: {
                                    download: true,
                                    reset: false,
                                    zoom: true,
                                    customIcons: [{
                                        icon: '<span class="apexcharts-reset-icon">↻</span>',
                                        index: -1,
                                        title: 'Reset Labels',
                                        class: 'custom-reset-icon',
                                        click: function() {
                                            resetLabels(seriesData, isMonthly, defaultLabelCount);
                                        }
                                    }]
                                }
                            },
                            zoom: {
                                enabled: true,
                                type: 'x',
                            },
                            events: {
                                zoomed: function(chartContext, {
                                    xaxis
                                }) {
                                    updateLabels(seriesData, xaxis, isMonthly);
                                },
                            }
                        },
                        title: {
                            text: titleText,
                            align: 'left',
                            style: {
                                fontSize: '16'
                            }
                        },
                        series: seriesData,
                        grid: {
                            borderColor: '#e7e7e7',
                            row: {
                                colors: ['#f3f3f3', 'transparent'],
                                opacity: 0.5
                            },
                        },
                        markers: {
                            size: 5,
                            shape: 'circle'
                        },
                        xaxis: xaxisConfig,
                        dataLabels: {
                            enabled: true,
                            formatter: function(val) {
                                return val;
                            },
                            background: {
                                enabled: true,
                                foreColor: 'black',
                                padding: 4,
                                borderRadius: 50,
                                borderWidth: 0,
                                borderColor: 'transparent',
                            }
                        }
                    });

                    chart.render();
                }

                function updateLabels(seriesData, xaxis, isMonthly) {
                    const range = xaxis.max - xaxis.min;
                    const visibleLabelsCount = Math.floor(seriesData[0].data.length * (range / (xaxis.max - xaxis.min)));
                    const interval = Math.ceil(seriesData[0].data.length / visibleLabelsCount);

                    chart.updateOptions({
                        xaxis: {
                            labels: {
                                rotate: -45,
                                formatter: function(value) {
                                    const dataPointIndex = seriesData[0].data.findIndex(item => item.x === value);
                                    return dataPointIndex % interval === 0 ? value : '';
                                }
                            }
                        }
                    });
                }

                function resetLabels(seriesData, isMonthly, defaultLabelCount) {
                    chart.updateOptions({
                        xaxis: {
                            min: undefined,
                            max: undefined,
                            labels: {
                                rotate: -45,
                                formatter: function(value) {
                                    const totalLabels = seriesData[0].data.length;
                                    const interval = Math.ceil(totalLabels / defaultLabelCount);
                                    const dataPointIndex = seriesData[0].data.findIndex(item => item.x === value);
                                    return dataPointIndex % interval === 0 ? value : '';
                                }
                            }
                        }
                    });
                }

                function updateChart(month) {
                    fetchSalesData(month).done(function(data) {
                        let seriesData;

                        if (data.isMonthly) {
                            seriesData = [{
                                    name: 'Impor',
                                    data: Object.entries(data.impor).map(([month, value]) => ({
                                        x: month,
                                        y: value
                                    }))
                                },
                                {
                                    name: 'Ekspor',
                                    data: Object.entries(data.ekspor).map(([month, value]) => ({
                                        x: month,
                                        y: value
                                    }))
                                }
                            ];
                        } else {
                            seriesData = [{
                                    name: 'Impor',
                                    data: Object.entries(data.impor).map(([date, value]) => ({
                                        x: date,
                                        y: value
                                    }))
                                },
                                {
                                    name: 'Ekspor',
                                    data: Object.entries(data.ekspor).map(([date, value]) => ({
                                        x: date,
                                        y: value
                                    }))
                                }
                            ];
                        }

                        renderChart(seriesData, data.isMonthly, data.total);
                    });
                }

                $monthSelect.on('change', function() {
                    updateChart($(this).val());
                });

                updateChart($monthSelect.val());
            });
        </script>
        @stack('form-modal')
        @stack('form-delete')
        @stack('toast-script')
        @endpush
</x-layout>