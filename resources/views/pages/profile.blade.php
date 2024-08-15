@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
<x-layout>
    <style>
        .selected {
            border: solid 2px black;
        }

        .form-control.is-invalid {
            background-image: none;
        }
    </style>
    @if (session('success'))
    <div class="alert alert-success d-flex align-items-center position-fixed top-0 start-50 translate-middle-x" role="alert" style="width: fit-content; padding:0px 10px 0px 0px; margin:10px;" id="alertContainer">
        <div class="d-flex gap-2 align-content-center text-center">
            <div class="bg-white rounded-3 rounded-end-0 p-2" style="width: fit-content; height: fit-content;">
                <i class="fa-solid fa-check text-success" style="font-size: 30px;"></i>
            </div>
            <h5 class="text-black fw-bold my-2 text-center">{{ session('status') }}</h5>
        </div>
    </div>
    @endif
    <x-slot:title>
        Profile
        </x-slot>
        <div class="w-100 bg-primary mb-3 shadow rounded-4 p-3 d-flex align-content-center" style="height: 30rem;">
            <div class="container">
                {{--Yang Image Belum--}}
                <img src="{{ URL('assets/foto-bg.png')}}" alt="" style="position: absolute; width: 153vh; height:auto; z-index:0;" class="d-none d-xl-block">

                <div class="d-flex flex-column my-5" style="place-items: center;">

                    @if (auth()->user()->foto)
                    <img src="{{URL::asset('storage/'.auth()->user()->foto)}}" alt="" class="rounded-circle mb-2" width="250" height="250" id="foto_profil">
                    @else
                    <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="250" height="250" class="rounded-circle mb-2" id="svg-profil">
                        <title>user-solid-svg</title>
                        <style>
                            .s0 {
                                fill: rgb(var(--bs-primary-rgb))
                            }
                        </style>
                        <rect width="590" height="590" id="Lapisan 1" style="fill: #ffffff" />
                        <path id="Layer" class="s0" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                    </svg>
                    <img src="" alt="" class="rounded-circle mb-2" width="250" height="250" id="foto_profil" style="display:none">
                    @endif




                    <input type="file" accept="image/png, image/jpeg, image/jpg" id="fileInput" style="display: none;" name="foto">
                    <div class="invalid-feedback"></div>


                    <div class="d-flex gap-2 " style="width:fit-content">
                        <button class="btn-info btn btn-sm" id="uploadButton"><span class="fw-semibold">Ubah Gambar</span></button>
                        <button class="btn-danger btn text-white btn-sm" id="deleteButton"><span class="fw-semibold">Hapus Gambar</span> </button>
                    </div>
                    <div class="d-flex gap-2" style="width:fit-content">
                        <button class="btn-info btn btn-sm" id="simpanupload">
                            <div class="d-flex gap-2">
                                <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button"></span>
                                <span class="fw-semibold">Simpan Gambar</span>
                            </div>
                        </button>
                        <button class="btn-danger btn text-white btn-sm" id="batalupload"><span class="fw-semibold">Batal</span></button>
                    </div>
                    <div class="d-flex gap-2 " style="width:fit-content" id="handledelete">
                        <button class="btn-danger btn btn-sm" id="simpanhapus">
                            <div class="d-flex gap-2">
                                <span class="spinner-border spinner-border-sm text-white my-1" aria-hidden="true" id="loading-button-hapus"></span>
                                <span class="fw-semibold text-white">Hapus Gambar</span>
                            </div>
                        </button>
                        <button class="btn-info btn text-white btn-sm" id="batalhapus"><span class="fw-semibold">Batal</span></button>
                    </div>
                    <h1 class="fw-semibold text-white" style="z-index: 1;">{{ ucwords(auth()->user()->nama) }}</h1>
                    <p class="text-white" style="z-index: 1;">{{ ucwords(auth()->user()->jabatan) }} | {{ auth()->user()->nip }}</p>
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
                        <h5 class="mt-4 fw-semibold">Pilih Warna:</h5>
                        <div class="d-flex mt-3 gap-2" id="color-pick">
                            <div class="bg-white  rounded-3" style="padding:5px;">
                                <button class=" btn color-button" style="width: 40px; height: 40px; background-color:#f09259" value="240, 146, 89" data-test="#f09259"></button>
                            </div>
                           
                            <div class="bg-white  rounded-3" style="padding:5px;">
                                <button class=" color-button btn border-2" style="width: 40px; height: 40px; background-color:#4DB6AC" value="77, 182, 172" data-test="#4DB6AC"></button>
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
                            <i class="fa-solid fa-key" style="font-size:2rem;"></i>

                            <h3>Ubah Password</h3>
                        </div>
                        <hr class="line m-0" style="height: 4px; background-color:#FFF;width:200px;">
                        <form method="POST" action="{{ route($cleaned.'.pegawai.resetpassword') }}">
                            @csrf
                            @php
                            $errorIndex = 0;
                            $pesanSatu = '';
                            $pesanDua = '';
                            foreach($errors->all() as $error) {
                            if (strpos($error, 'password') !== false) {
                            $errorIndex++;
                            }
                            if($errorIndex == 1) {
                            $pesanSatu = $error;
                            }
                            elseif($errorIndex == 2) {
                            $pesanDua = $error;
                            }
                            }
                            @endphp
                            <h5 class="m-0 fw-semibold mt-3">New Password</h5>
                            <div class="d-flex position-relative m-0">
                                <input type="password" class="form-control form-password mb-3 @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password" required autocomplete="new-password" value="{{ old('password') }}">

                                <i id="togglePassword" class="fa-regular fa-eye-slash  position-absolute top-0 end-0 mx-1 my-1" style="font-size: 25px; color: #9FA6B2"></i>
                            </div>
                            @if ($pesanSatu)
                            <p style="color: #DC4C64">{{ $pesanSatu }}</p>
                            @endif
                            <h5 class="m-0 fw-semibold">Retype Password</h5>
                            <div class="d-flex position-relative">
                                <input type="password" class="form-control form-password @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Password" required autocomplete="new-password" value="{{ old('password_confirmation') }}">
                                <i id="togglePasswordConfirmation" class="fa-regular fa-eye-slash  position-absolute top-0 end-0 mx-1 my-1" style="font-size: 25px; color: #9FA6B2"></i>
                            </div>
                            @if ($pesanDua)
                            <p style="color: #DC4C64">{{ $pesanDua }}</p>
                            @endif

                            <hr class="line mb-0 mt-3" style="height: 1px; background-color:#FFF;">
                            <button class="btn bg-white mt-3 text-primary" id="change-color">
                                <span class="fw-semibold">Submit</span>
                            </button>
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
                                    {{ ucfirst(auth()->user()->alamat) }}
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
                                            {{ ucwords(auth()->user()->JK) }}
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
                                            {{ ucwords(auth()->user()->agama) }}
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
                                    {{ \Carbon\Carbon::parse(auth()->user()->tanggal_lahir)->format('d F Y') }}
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
                                    {{ ucwords(auth()->user()->status_menikah) }}
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
                                    {{ strtoupper(auth()->user()->pendidikan_terakhir) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                @if (auth()->user()->hasRole('direktur'))
                <button class="btn rounded-3  d-flex mx-auto mt-3 bg-white" data-bs-toggle="modal" data-bs-target="#edit-pegawai-modal">
                    <div data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Biodata">
                        <i class="fa-solid fa-pen-to-square fa-lg my-auto text-primary"></i>
                        <span class="fw-semibold my-auto fs-6 text-primary">EDIT DATA</span>
                    </div>
                </button>
                @endif
            </div>

        </div>
        @if (auth()->user()->hasRole('direktur'))
        <x-modal-form size="" text="Ubah Data Pegawai" id="edit-pegawai-modal">
            <x-form-edit-pegawai :data="auth()->user()" />
        </x-modal-form>
        @endif

        <x-toast />
        @push('page-script')
        @stack('toast-script')
        <script>
            $(document).ready(function() {
                let selectedColor = '';
                let selectedRGBColor = '';
                $('#simpanupload').hide();
                $('#batalupload').hide();

                $('#simpanhapus').hide();
                $('#batalhapus').hide();
                const srcimg = $('#foto_profil').attr('src');
                console.log(srcimg);
                const imgdefault = '{{ URL::asset("user-solid-orange.svg") }}';
                let selectedFile;
                let loadingButton = $('#loading-button')
                loadingButton.hide();
                let loadingButtonHapus = $('#loading-button-hapus')
                loadingButtonHapus.hide();

                function handlingFotoProfile(FormData, element, loadingButton) {
                    FormData.append('_token', '{{ csrf_token() }}');
                    $.ajax({
                        url: "{{ route($cleaned.'.pegawai.changeprofilpicture') }}",
                        type: 'POST',
                        data: FormData,
                        processData: false,
                        contentType: false,
                        beforeSend: function() {
                            loadingButton.show();
                        },
                        success: function(response) {


                            loadingButton.hide();
                            showAlert(response.message);
                            console.log('Success:', response);
                        },

                        error: function(xhr, status, error) {
                            loadingButton.hide();
                            const errors = xhr.responseJSON.errors;
                            if (xhr.status === 500) {
                                alert("Kolom Unik Tidak Boleh Sama!")
                            } else if (xhr.status === 404) {
                                alert("Data Tidak Ditemukan!");
                            }


                            element.next('.invalid-feedback').text('');

                            $.each(errors, function(key, value) {

                                var cleanInputName = key.replace(/\.\d+/g, '');
                                var cleanAngka = value[0].replace(/\.\d+/g, '');

                                element.next('.invalid-feedback').text(value[0]);

                            });

                        }
                    });
                }
                $('#uploadButton').click(function() {
                    $('#fileInput').click();
                    $('#fileInput').val('');
                    $('#fileInput').change(function(event) {
                        var input = event.target;
                        var reader = new FileReader();

                        reader.onload = function(e) {
                            $('#foto_profil').show();
                            $('#foto_profil').attr('src', e.target.result);
                            $('#svg-profil').hide();
                        };
                        reader.readAsDataURL(input.files[0]);

                        selectedFile = input.files[0]; // Get the selected file

                    });

                    $('#uploadButton').hide();
                    $('#deleteButton').hide();
                    $('#simpanupload').show();
                    $('#simpanupload').click(function() {
                        var formData = new FormData();
                        formData.append('foto', selectedFile);
                        formData.append('type', 'changed');
                        handlingFotoProfile(formData, $('#foto'), loadingButton);
                    });
                    $('#batalupload').show();
                });

                $('#deleteButton').click(function() {
                    $('#uploadButton').hide();
                    $('#deleteButton').hide();
                    $('#simpanhapus').show();
                    $('#simpanhapus').click(function() {
                        var formData = new FormData();
                        formData.append('type', 'delete');
                        handlingFotoProfile(formData, $('#foto'), loadingButtonHapus);
                    });
                    $('#batalhapus').show();
                });
                $('#batalhapus').click(function() {
                    if ($('#svg-profil').is(':hidden')) {
                        $('#svg-profil').show();
                    } else {
                        $('#foto_profil').attr('src', srcimg);
                    }
                    $('#uploadButton').show();
                    $('#deleteButton').show();
                    $('#simpanhapus').hide();
                    $('#batalhapus').hide();
                });
                $('#batalupload').click(function() {
                    $('#uploadButton').show();
                    $('#deleteButton').show();
                    $('#simpanupload').hide();
                    $('#batalupload').hide();
                    if ($('#svg-profil').is(':hidden')) {
                        $('#svg-profil').show();
                        $('#foto_profil').hide();
                    } else {
                        $('#foto_profil').show();
                        $('#foto_profil').attr('src', srcimg);
                    }

                });
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
                        showAlert('Berhasil Mengubah Tema');
                        // Save the selected color to localStorage
                        localStorage.setItem('primaryColor', selectedColor);
                        localStorage.setItem('primaryRGBColor', selectedRGBColor);
                    }
                });

                $('#togglePassword').on('click', function() {
                    const passwordField = $('#password');
                    const passwordFieldType = passwordField.attr('type');
                    const icon = $(this);

                    if (passwordFieldType === 'password') {
                        passwordField.attr('type', 'text');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    } else {
                        passwordField.attr('type', 'password');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    }
                });

                $('#togglePasswordConfirmation').on('click', function() {
                    const passwordField = $('#password_confirmation');
                    const passwordFieldType = passwordField.attr('type');
                    const icon = $(this);

                    if (passwordFieldType === 'password') {
                        passwordField.attr('type', 'text');
                        icon.removeClass('fa-eye-slash').addClass('fa-eye');
                    } else {
                        passwordField.attr('type', 'password');
                        icon.removeClass('fa-eye').addClass('fa-eye-slash');
                    }
                });
            });
        </script>
        @endpush
</x-layout>