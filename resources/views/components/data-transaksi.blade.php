@php
setlocale(LC_TIME, 'id_ID');
@endphp
<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="fw-semibold  text-white fs-1 fs-lg-2">NO.Transaksi | {{$data -> no_transaksi}} </h1>
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-file-lines position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:55px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">NO.Transaksi</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:55px">
                            {{$data -> no_transaksi}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-briefcase position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Jenis Transaksi</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{ucfirst($data -> jenis_kegiatan)}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-industry position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Perusahaan</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                            {{$data -> perusahaan}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Jumlah Peti Kemas</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{$data -> jumlah_petikemas}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal DO Rilis</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{strftime('%e %B %Y', strtotime($data->tanggal_DO_rilis))}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-file-lines position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">NO. DO</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{$data -> no_do}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-ship position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Cargo</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{ucfirst($data -> kapal)}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal DO Expired</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{strftime('%e %B %Y', strtotime($data->tanggal_DO_exp))}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-industry position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">EMKL</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                            {{$data->emkl}}
                        </h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-user-tie position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Inventory</p>
                        @if ($data->foto_profil)
                            <img src="{{URL::asset('storage/'.$data->foto_profil)}}" alt="" class="rounded-circle" style="margin-left: 65px" width="22" height="22">
                        @else
                            <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 590 590" width="22" height="22" class="rounded-circle" style="margin-left: 65px">
                            <title>user-solid-svg</title>
                        <style>
                            .s1 {
                            fill: #ffffff
                            }
                        </style>
                            <rect width="590" height="590" id="Lapisan_1" style="fill: var(--bs-primary)" />
                            <path id="Layer" class="s1" d="m295 295c26.5 0 51.9-10.5 70.7-29.3 18.7-18.7 29.3-44.1 29.3-70.7 0-26.5-10.6-51.9-29.3-70.6-18.8-18.8-44.2-29.3-70.7-29.3-26.5 0-51.9 10.5-70.7 29.3-18.7 18.7-29.3 44.1-29.3 70.6 0 26.6 10.6 52 29.3 70.7 18.8 18.8 44.2 29.3 70.7 29.3zm-35.7 37.5c-76.9 0-139.2 62.3-139.2 139.2 0 12.8 10.4 23.2 23.2 23.2h303.4c12.8 0 23.2-10.4 23.2-23.2 0-76.9-62.3-139.2-139.2-139.2z" />
                        </svg>
                        @endif
                        <h5 class="fw-semibold fs-6 text-black d-inline ">
                            {{ucfirst($data->inventory)}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ">
            @if ($data->tanggal_transaksi)
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal Transaksi</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{strftime('%e %B %Y', strtotime($data->tanggal_transaksi))}}
                        </h5>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @can('mengelola transaksi')
        <button class="btn shadow rounded-3  d-flex mx-auto mt-1 bg-white" data-bs-toggle="modal" data-bs-target="#form-edit-transaksi">
            <i class="fa-solid fa-pen-to-square fa-lg my-auto text-primary"></i>
            <span class="fw-semibold mx-2 my-auto fs-6 text-primary">EDIT DATA</span>
        </button>
        @endcan
    </div>
</div>
@can('mengelola transaksi')
<x-modal-form id="form-edit-transaksi" size="" text="Edit Transaksi | {{$data->no_transaksi}}">
    <x-form-edit-transaksi :data="$data" :user="$user" />
</x-modal-form>
@endcan