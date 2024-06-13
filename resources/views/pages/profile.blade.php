<x-layout>
    <x-slot:title>
        Profile
        </x-slot>
        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3 d-flex align-content-center" style="height: 30rem;">
            <div class="container">
                {{--Yang Image Belum--}}
                <img src="{{ URL('assets/foto-bg.png')}}" alt="" style="position: absolute; width: 153vh; height:auto; z-index:0;" class="d-none d-xl-block">

                <div class="d-flex flex-column my-5" style="place-items: center;">
                    <div class="rounded-circle bg-white p-1 mb-2 onhover" style="z-index: 1; width: 250px; height: 250px;">
                        <i class="fa-solid fa-user text-primary" style=" font-size:190px; margin-left:37px; margin-top:17px"></i>
                    </div>
                    <h1 class="fw-semibold text-white" style="z-index: 1;">{{ auth()->user()->nama }}</h1>
                    <p class="text-white" style="z-index: 1;">{{ auth()->user()->jabatan }} | {{ auth()->user()->nip }}</p>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6">
                <div class="h-100 p-3 w-100 shadow rounded-4 text-white bg-primary">
                    <div class="d-flex gap-2">
                        <i class="fa-solid fa-brush" style="font-size:2rem;"></i>
                        <h3>Ubah Tema</h3>
                    </div>
                    <hr class="line m-0" style="height: 4px; background-color:#FFF;width:200px;">
                    <div class="h-100 w-100 mt-3">
                        <h5 class="mt-4 fw-semibold">Pilih Warnna:</h5>
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

                        <hr class="line mb-0" style="height: 1px; background-color:#FFF; margin-top:4rem;">
                        <button class="btn bg-white mt-3 text-primary" id="change-color"><span class="fw-semibold">Submit</span></button>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="card shadow rounded-4 text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <i class="fa-solid fa-brush" style="font-size:2rem;"></i>
                            <h3>Ubah Password</h3>
                        </div>
                        <hr class="line m-0" style="height: 4px; background-color:#FFF;width:200px;">
                        <form action="">


                            <h5 class="m-0 fw-semibold mt-3">New Password</h5>

                            <input type="password" class="form-control mb-3" id="inputPassword2" placeholder="Password">
                            <h5 class="m-0 fw-semibold">Retype Password</h5>
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Password">


                            <hr class="line mb-0 mt-3" style="height: 1px; background-color:#FFF;">
                            <button class="btn bg-white mt-3 text-primary" id="change-color"><span class="fw-semibold">Submit</span></button>
                        </form>
                    </div>

                </div>
            </div>

        </div>

        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
            <div class="container position-relative">
                <h1 class="fw-semibold  text-white fs-1 fs-lg-2">Biodata</h1>
                <div class="row mt-4">
                    <div class="col-lg-6">
                        <div class="card shadow rounded-4 bg-white h-100">
                            <div class="card-body">
                                <i class="fa-solid fa-location-dot position-absolute top-0 start-0 my-5 text-primary" style="margin-left: 10px ; font-size:65px;"></i>
                                <p style="margin-left:50px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Alamat</p>
                                <h5 class="fw-semibold text-black fs-3 fs-sm-5" style="margin-left:50px;">
                                    {{ auth()->user()->alamat }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="container">
                            <div class="row mt-lg-0 mt-3">
                                <div class="card shadow rounded-4 bg-white">
                                    <div class="card-body ">
                                        <i class="fa-solid fa-venus-mars position-absolute top-0 start-0 my-4 text-primary" style="margin-left: 10px ; font-size: 47px;"></i>
                                        <p style="margin-left:50px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Jenis Kelamin</p>
                                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:50px">
                                            {{ auth()->user()->JK }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="card shadow rounded-4 bg-white">
                                    <div class="card-body">
                                        <i class="fa-solid fa-hands-praying position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size: 55px;"></i>
                                        <p style="margin-left:60px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Agama</p>
                                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:60px">
                                            {{ auth()->user()->agama }}
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-lg-3 mt-0">
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <i class="fa-solid fa-phone position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size: 55px"></i>
                                <p style="margin-left:60px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">No. Telepon</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:60px">
                                    {{ auth()->user()->no_hp }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <i class="fa-solid fa-calendar-days position-absolute top-0 start-0 my-2 text-primary" style="margin-left: 20px ; font-size:60px"></i>
                                <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal Lahir</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                                    {{ auth()->user()->tanggal_lahir }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-lg-3 mt-0">
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <i class="fa-solid fa-envelope position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 20px; font-size: 55px;"></i>
                                <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Email</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                                    {{ auth()->user()->email }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <i class="fa-solid fa-file-lines position-absolute top-0 start-0 my-2 text-primary" style="margin-left: 15px ; font-size:60px"></i>
                                <p style="margin-left:60px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">NIK</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:60px">
                                    {{ auth()->user()->nik }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-lg-3 mt-0">
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <svg viewBox="0 0 24 24" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" width="63" height="63" class="position-absolute top-0 start-0 my-2" style="margin-left: 15px ;">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <defs>
                                            <style>
                                                .cls-1 {
                                                    fill: none;
                                                    stroke: rgb(var(--bs-primary-rgb));
                                                    stroke-miterlimit: 10;
                                                    stroke-width: 1.91px;
                                                }
                                            </style>
                                        </defs>
                                        <circle class="cls-1" cx="8.66" cy="15.34" r="7.16"></circle>
                                        <circle class="cls-1" cx="16.3" cy="12.48" r="6.2"></circle>
                                        <polygon class="cls-1" points="16.77 6.27 15.82 6.27 12.96 3.41 13.91 1.5 18.68 1.5 19.64 3.41 16.77 6.27"></polygon>
                                    </g>
                                </svg>
                                <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Status Pernikahan</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                                    {{ auth()->user()->status_menikah }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mt-lg-0 mt-3">
                        <div class="card shadow rounded-4 bg-white">
                            <div class="card-body">
                                <i class="fa-solid fa-graduation-cap position-absolute top-0 start-0 my-2 text-primary" style="margin-left: 10px ; font-size:55px"></i>
                                <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Pendidikan Terakhir</p>
                                <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                                    {{ auth()->user()->pendidikan_terakhir }}
                                </h5>
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