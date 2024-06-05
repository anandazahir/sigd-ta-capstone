<x-layout>
    <style>
        .selected {
            border: solid 2px;
            border-color: black;
        }
    </style>
    <x-slot:title>
        Pengaturan
        </x-slot>
        <div class="container">
            <div class="container">
                <div class="container">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="card shadow rounded-4 text-white bg-primary">
                                    <div class="card-body">
                                        <div class="d-flex gap-2">
                                            <i class="fa-solid fa-brush" style="font-size:2rem;"></i>
                                            <h3>Ubah Tema</h3>
                                        </div>
                                        <hr class="line m-0" style="height: 4px; background-color:#FFF;width:200px;">
                                        <div class="h-100 w-100 mt-3">
                                            <h5 class="m-0 fw-semibold">Pilih Warnna:</h5>
                                            <div class="d-flex mt-3 gap-2" id="color-pick">
                                                <div class="bg-white  rounded-3" style="padding:5px;">
                                                    <button class=" btn color-button" style="width: 40px; height: 40px; background-color:#f09259" value="240, 146, 89" data-test="#f09259"></button>
                                                </div>
                                                <div class="bg-white  rounded-3" style="padding:5px;">
                                                    <button class=" color-button btn border-2" style="width: 40px; height: 40px; background-color:#F48FB1" value="244, 143, 177" data-test="#F48FB"></button>
                                                </div>
                                                <div class="bg-white  rounded-3" style="padding:5px;">
                                                    <button class=" color-button btn border-2" style="width: 40px; height: 40px; background-color:#CE93D8"></button>
                                                </div>
                                                <div class="bg-white  rounded-3" style="padding:5px;">
                                                    <button class=" color-button btn border-2" style="width: 40px; height: 40px; background-color:#4DB6AC"></button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="line mb-0 mt-3" style="height: 1px; background-color:#FFF;">

                                        <button class="btn bg-white mt-3 text-primary" id="change-color"><span class="fw-semibold">Submit</span></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <div class="card shadow rounded-4 text-white bg-primary">
                                    <div class="card-body">
                                        <h3>Ubah Profil Akun</h3>
                                        <div class="row justify-content-center justify-content-lg-start mb-3">
                                            <div class="col-md-2" style="width: auto;">
                                                <i class="fa-solid fa-circle-user" style="font-size:200px;"></i>
                                            </div>
                                            <div class="col-md-10 my-auto text-center text-lg-start" style="width: 25rem">
                                                <button class="bg-white btn fs-semibold text-primary"><span class="fw-semibold">Ubah Foto Profil</span></button>
                                                <button class="btn-danger btn text-white fs-semibold"><span class="fw-semibold">Hapus Foto Profil</span></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label for="" class="form-label">Username</label>
                                                <form action="">
                                                    <input type="text" name="user" id="" class="form-control mb-3" required>
                                                    <button type="submit" class="btn bg-white text-primary"><span class="fw-semibold">Submit</span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        @push('page-script')
        <script>
            $(document).ready(function() {
                let selectedColor = '';
                let selectedRGBColor = '';
                // Set the initial selected color based on the CSS variable
                const initialColor = getComputedStyle(document.documentElement).getPropertyValue('--bs-primary-rgb').trim();
                $('#color-pick').find('.color-button').each(function() {
                    if ($(this).val() === initialColor) {
                        $(this).parent().addClass('selected');
                        selectedColor = initialColor;
                    }
                });

                // Handle click on color buttons
                $('#color-pick').find('.color-button').click(function() {
                    selectedRGBColor = $(this).attr('data-test');
                    console.log(selectedRGBColor);
                    selectedColor = $(this).val();
                    // Add border to the clicked button and remove from others
                    $('.color-button').parent().removeClass('selected');
                    $(this).parent().addClass('selected');
                });


                $('#change-color').click(function() {
                    if (selectedColor) {
                        $(':root').css('--bs-primary', selectedRGBColor);
                        $(':root').css('--bs-primary-rgb', selectedColor);
                        // Save the selected color to localStorage
                        localStorage.setItem('primaryColor', selectedColor);
                        localStorage.setItem('primaryRGBColor', selectedRGBColor);
                    }
                });
            });
        </script>
        @endpush
</x-layout>