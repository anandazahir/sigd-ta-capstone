<x-layout>
    <x-slot:title>
        Transaksi | {{$transaksi->no_transaksi}}
        </x-slot>
        <x-data-transaksi :data="$transaksi" />
        <div class="dropdown d-block d-md-none mb-3">

            <button class="btn dropdowntoggle btn-info text-white w-100 text-start rounded-4 shadow" type="button" data-bs-toggle="dropdown">
                <div class="element-dropdown">
                    <div class="rounded-circle bg-white position-absolute top-0 start-0 my-3" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                        <i class="fa-solid fa-file-lines  text-info " style="font-size:3.3rem; margin: 10px 18px 10px 18px"></i>
                    </div>
                    <h4 class="my-2" style="margin-left:85px;">ENTRY DATA</h4>
                    <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px; width: 210px;" />
                    <p class="my-2" style="margin-left:85px;">PEMASUKAN DATA PETI KEMAS</p>
                </div>
                <i class="fa-solid fa-caret-down text-white mx-2" style="position: absolute; top:42px; right:0"></i>
            </button>

            <ul class="dropdown-menu w-100 copy"></ul>
        </div>

        <div class="row ">
            <div class="col-lg-4 mb-3 d-lg-block d-none">
                <div class="card  shadow rounded-4 bg-primary bg-info text-white onhover ">
                    <div class="card-body tabs" data-tab="EntryData">

                        <div class="rounded-circle bg-white position-absolute top-0 start-0 my-4" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                            <i class="fa-solid fa-file-lines text-primary text-info" style="font-size:3.3rem; margin: 10px 18px 10px 18px"></i>
                        </div>
                        <h4 class="my-2" style="margin-left:85px;">ENTRY DATA</h4>
                        <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px;" />
                        <p class="my-2" style="margin-left:85px;">PEMASUKAN DATA PETI KEMAS</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 mb-3 d-lg-block d-none">
                <div class="card shadow rounded-4 bg-primary text-white onhover">
                    <div class="card-body tabs" data-tab="Pembayaran">

                        <div class="rounded-circle bg-white position-absolute top-0 start-0 my-4" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                            <i class="fa-solid fa-dollar-sign  text-primary " style="font-size:3.3rem; margin: 10px 20px 10px 20px"></i>
                        </div>
                        <h4 class="my-2" style="margin-left:85px;">PEMBAYARAN</h4>
                        <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px;" />
                        <p class="my-2" style="margin-left:85px;">PEMBAYARAN JASA</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4  mb-3 d-lg-block d-none">
                <div class="card shadow rounded-4 bg-primary text-white onhover ">
                    <div class="card-body tabs" data-tab="Pengecekan">

                        <div class="rounded-circle bg-white position-absolute top-0 start-0 my-4" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                            <i class="fa-solid fa-clipboard-list text-primary " style="font-size:3.3rem; margin: 10px 18px 10px 18px"></i>
                        </div>
                        <h4 class="my-2" style="margin-left:85px;">PENGECEKAN</h4>
                        <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px;" />
                        <p class="my-2" style="margin-left:85px;">PENGECEKAN PETI KEMAS</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-lg-6 mb-3 d-lg-block d-none">
                <div class="card shadow rounded-4 bg-primary text-white onhover">
                    <div class="card-body tabs" data-tab="Perbaikan">

                        <div class="rounded-circle bg-white position-absolute top-0 start-0 my-4" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                            <i class="fa-solid fa-screwdriver-wrench  text-primary " style="font-size:3rem; margin:15px 14px 15px 14px"></i>
                        </div>
                        <h4 class="my-2" style="margin-left:85px;">PERBAIKAN</h4>
                        <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px;" />
                        <p class="my-2" style="margin-left:85px;">PERBAIKAN PETI KEMAS</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3 d-lg-block d-none">
                <div class="card shadow rounded-4 bg-primary text-white onhover">
                    <div class="card-body tabs" data-tab="Penempatan">
                        <div class="rounded-circle bg-white position-absolute top-0 start-0 my-4" style="margin-left: 10px; width: 4.7rem; height:4.7rem;">
                            <i class="fa-solid fa-location-dot text-primary" style="font-size:3.3rem; margin: 10px 18px 10px 18px"></i>
                        </div>
                        <h4 class="my-2" style="margin-left:85px;">PENEMPATAN</h4>
                        <hr class="line my-2" style="height: 2px; background-color:#FFF; margin-left:85px;" />
                        <p class="my-2" style="margin-left:85px;">PENEMPATAN PETI KEMAS</p>
                    </div>
                </div>
            </div>
        </div>

        <div id="EntryData" class="tab-pane fade in active show d-block">
            <x-table-entrydata :data="$transaksi" />
        </div>

        <div id="Pembayaran" class="tab-pane fade in d-none">
            <x-table-pembayaran :data="$transaksi" />
        </div>

        <div id="Pengecekan" class="tab-pane fade in d-none">
            <x-table-pengecekan :data="$transaksi" />

        </div>

        <div id="Perbaikan" class="tab-pane fade in d-none">
            <x-table-perbaikan :data="$transaksi" />
        </div>

        <div id="Penempatan" class="tab-pane fade in d-none">
            <x-table-penempatan :data="$transaksi" />
        </div>
        <x-toast />
        @push('page-script')
        <script>
            $(document).ready(function() {

                function updateDropdownAndTab(tabId) {

                    $(".element-dropdown").empty();
                    let Element = $("[data-tab='" + tabId + "']");
                    let ElementCopy = Element.clone();
                    $(".element-dropdown").append(ElementCopy);
                    if ($(".element-dropdown").children().length > 1) {
                        $(".element-dropdown").children().first().remove()
                    }
                    $(".element-dropdown").find("hr").css("width", "210px");
                    let circle = $(".element-dropdown").find(".rounded-circle");
                    circle.removeClass("my-4");
                    circle.addClass("my-3");
                    $('.card').removeClass('bg-info');
                    $('i').removeClass('text-info');
                    let iconDropdown = $(".element-dropdown").find("i");
                    iconDropdown.removeClass("text-primary");
                    iconDropdown.addClass("text-info");
                    let card = Element.parent();
                    let iconTab = Element.find("i");
                    card.addClass("bg-info");
                    iconTab.addClass("text-info");
                }

                function fillDropdownMenu() {
                    var dropdownList = $(".copy");
                    dropdownList.empty();
                    $(".tabs").each(function() {
                        var tab = $(this).data("tab");
                        var icon = $(this).find("i").clone();
                        var label = $(this).find("h4").text();


                        var listItem = $("<li>", {
                            class: "dropdown-item",
                            "data-dropdown": tab,
                            html: icon.removeClass("text-primary").css("font-size", "", "margin", "").addClass("d-inline m-0 text-black").prop('outerHTML') + "<p class='m-0 d-inline mx-1'>" + label + "</p>"
                        });
                        dropdownList.append(listItem);
                    });
                }
                fillDropdownMenu();
                $('.tabs').click(function() {
                    let tabId = $(this).data('tab');

                    if ($('#' + tabId).hasClass('d-none')) {
                        $('.tab-pane').removeClass('active show d-block').addClass('d-none');
                        $('#' + tabId).removeClass('d-none').addClass('active show d-block');


                    } else {
                        $('.tab-pane').removeClass('active show d-block').addClass('d-none');
                        $('#' + tabId).removeClass('d-none').addClass('active show d-block');
                    }

                    updateDropdownAndTab(tabId);
                });
                $('.dropdown-item').click(function() {
                    let tabId = $(this).data('dropdown');

                    if ($('#' + tabId).hasClass('d-none')) {
                        $('.tab-pane').removeClass('active show d-block').addClass('d-none');
                        $('#' + tabId).removeClass('d-none').addClass('active show d-block');
                    } else {
                        $('.tab-pane').removeClass('active show d-block').addClass('d-none');
                        $('#' + tabId).removeClass('d-none').addClass('active show d-block');
                    }
                    updateDropdownAndTab(tabId);
                });

            });
        </script>
        @stack('form-modal')
        @stack('transaksi-more-script')
        @stack('toast-script')
        @stack('form-delete')
        @endpush

</x-layout>