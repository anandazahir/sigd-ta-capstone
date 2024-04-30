<style>
    select.form-select:disabled {
        background: transparent;
        color: black;
        border-color: transparent;
        text-align: center;
        padding: 0;
    }
</style>
<div class="bg-primary rounded-4 shadow p-3 mb-3 position-relative" style="height: auto;">
    <div class=" container ">
        <div class="row justify-content-between p-0 m-0">
            <h2 class="text-white fw-semibold col-lg-10 m-0 p-0">Entry Data</h2>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" style="width: fit-content;" id="button-edit">
                <i class="fa-solid fa-pen-to-square text-white fa-xl mx-1"></i>
                <span class="fw-semibold fs-6">Edit Data</span>
            </button>
            <button class="btn btn-info p-1 col-lg-2 mt-3 mt-lg-0" id="button-tambah-entry">
                <i class="fa-solid fa-circle-plus text-white fa-xl mx-1"></i>
                <span class="fw-semibold fs-6">Tambah Peti Kemas</span>
            </button>
        </div>
        <form action="">
            <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 25rem;">
                <table class="table-variations-3  text-center" id="table-entrydata">
                    <thead>
                        <tr>
                            <th scope="col" class="fw-semibold">No Peti Kemas</th>
                            <th scope="col" class="fw-semibold">Size & Type</th>
                            <th scope="col" class="fw-semibold">Cetak SPK</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="text-center">
                                <select class="form-select mx-auto" aria-label="Default select example" required disabled style="font-size: 20px; width:fit-content;" onfocus='this.size=5;' onblur='this.size=1;' onchange='this.size=1; this.blur();'>
                                    <option>Plih Opsi Ini</option>
                                    <option selected value="5555">Peti Kemas A</option>
                                    <option value="55555">Peti Kemas B</option>
                                </select>
                            </td>
                            <td class="text-center">

                                <select class="form-select mx-auto" aria-label="Default select example" required disabled style="font-size: 20px; width:fit-content;" onfocus='this.size=5;' onblur='this.size=1;' onchange="this.size=1; this.blur();">
                                    <option>Plih Opsi Ini</option>
                                    <option selected value="20'GP">20'GP</option>
                                    <option value="20'RF">20'RF</option>
                                    <option value="20'FT">20'FT</option>
                                    <option value="20'OT">20'OT</option>
                                    <option value="20'TK">20'TK</option>
                                    <option value="40'GP">40'GP</option>
                                    <option value="40'RF">40'RF</option>
                                    <option value="40'FT">40'FT</option>
                                    <option value="40'OT">40'OT</option>
                                    <option value="40'HC">40'HC</option>
                                    <option value="40'RH">40'RH</option>
                                    <option value="40'TK">40'TK</option>
                                    <option value="45'HC">45'HC</option>
                                    <option value="45'U1">45'U1</option>
                                </select>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-danger text-white rounded-3" href="https://getbootstrap.com/docs/5.3/components/buttons/#disabled-state" id="cetak_spk" target="_blank"> Belum Cetak</a>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger text-white rounded-3"> <i class="fa-solid fa-trash-can fa-lg my-1"></i></button>
                            </td>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <button class="btn btn-success text-white rounded-3 mt-3" id="button-submit"> Simpan Data</button>
        </form>
    </div>
</div>
<script>
    $(document).ready(function() {
        $("#button-tambah-entry").hide();
        $("#button-submit").hide();
        $("#button-edit").click(function() {
            $('select').prop("disabled", false);
            $("#button-edit").hide();
            $("#button-tambah-entry").show();
            $("#button-submit").show();
        });
        $("#button-tambah-entry").click(function() {
            let $firstRow = $("#table-entrydata tbody tr:first");
            let newRow = $firstRow.clone();
            newRow.find(".form-control").val("");
            newRow.find("select").prop("selectedIndex", 0);
            $("#table-entrydata tbody").append(newRow);
        });
        $("#button-submit").click(function(event) {
            event.preventDefault();
            $("#button-submit").hide();
            $("#button-edit").show();
            $("#button-tambah-entry").hide();
            $('select').prop("disabled", true);
        });
        $("#cetak_spk").click(function(event) {

            $(this).css({
                "pointer-events": "none",
                "cursor": "default",

            });
        })
    });
</script>