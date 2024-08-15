<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3 d-flex align-content-center" style="height: 30rem;">
    <div class="container">
        {{--Yang Image Belum--}}
        <img src="{{ URL('assets/foto-bg.png')}}" alt="" style="position: absolute; width: 153vh; height:auto; z-index:0;" class="d-none d-xl-block">


        <div class="d-flex flex-column my-5" style="place-items: center;">
            @if ($data->foto)
            <img src="{{URL::asset('storage/'.$data->foto)}}" alt="" class="rounded-circle mb-2" width="250" height="250">
            @else
            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="250" height="250" class="rounded-circle mb-2">
                <title>user-solid-svg</title>
                <style>
                    .s0 {
                        fill: rgb(var(--bs-primary-rgb))
                    }
                </style>
                <rect width="590" height="590" id="Lapisan 1" style="fill: #ffffff" />
                <path id="Layer" class="s0" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
            </svg>
            @endif
            <h1 class="fw-semibold text-white" style="z-index: 1;">{{ ucwords($data->nama) }}</h1>
            <p class="text-white" style="z-index: 1;">{{ ucwords($data->jabatan) }} | {{ $data->nip }}</p>
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
                            {{ ucfirst($data->alamat) }}
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
                                    {{ ucwords($data->JK) }}
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
                                    {{ ucwords($data->agama) }}
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
                            {{ $data->no_hp }}
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
                            {{ \Carbon\Carbon::parse($data->tanggal_lahir)->format('d F Y') }}
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
                            {{ $data->email }}
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
                            {{ $data->nik }}
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
                            {{ ucwords($data->status_menikah) }}
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
                            {{ strtoupper($data->pendidikan_terakhir) }}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <button class="btn rounded-3 shadow d-flex mx-auto mt-3 bg-white" data-bs-toggle="modal" data-bs-target="#edit-pegawai-modal">
        <div data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Biodata">
            <i class="fa-solid fa-pen-to-square fa-lg my-auto text-primary"></i>
            <span class="fw-semibold my-auto fs-6 text-primary">EDIT DATA</span>
        </div>
    </button>
</div>

<x-modal-form size="" text="Ubah Data Pegawai" id="edit-pegawai-modal">
    <x-form-edit-pegawai :data="$data" />
</x-modal-form>