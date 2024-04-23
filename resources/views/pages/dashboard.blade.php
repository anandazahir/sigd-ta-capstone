<x-layout>
    <x-slot:title>
        Dashboard
        </x-slot>
        <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="card shadow rounded-4 text-white bg-primary">
                    <div class="card-body">
                        <div class="row justify-content-center justify-content-lg-start">
                            <div class="col-md-2" style="width: auto;">
                                <img src="{{ URL('assets/profile-section.svg')}}" alt="profile-section" width="100" height="100" class="img-fluid">
                            </div>
                            <div class="col-md-10 my-auto text-center text-lg-start" style="width: 25rem">
                                <h4 class="mt-2 p-0">DIREKTUR 1</h4>
                                <hr class="mb-2 line" style="height: 4px; background-color:#FFF;" />
                                <p class="mt-1 p-0 ">NIP: 21120120140115 | Direktur</p>
                            </div>
                        </div>
                        <div class="position-absolute top-0 end-0" style="margin: 7px 7px;">
                            <div class="rounded-3 d-flex flex-row justify-content-center hover" style="width: 2rem; height: 2rem; place-items: center; background: #edf5f5;">
                                <a href="/profile">
                                    <img src="{{ URL('assets/more-icon.svg')}}" alt="" style="width: 1.5rem; height: 1.5rem;" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 text-white bg-primary">
                    <div class="card-body">
                        <div class="position-absolute top-0 end-0" style="margin: 7px 7px;">
                            <div class="rounded-3 d-flex flex-row justify-content-center hover" style="width: 2rem; height: 2rem; place-items: center; background: #edf5f5;">
                                <a href="/notification">
                                    <img src="{{ URL('assets/more-icon.svg')}}" alt="" style="width: 1.5rem; height: 1.5rem;" />
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <h4>NOTIFICATION</h4>
                        </div>
                        <div class="row container text-center scroll" style="height: 21.5rem">
                            <table class="table-dashboard table-responsive">
                                <thead>
                                    <tr>
                                        <th scope="col">MESSAGE</th>
                                        <th scope="col">DATE</th>
                                        <th scope="col">FROM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Pengajuan Cuti</td>
                                        <td>19 Jul 2021</td>
                                        <td class="d-flex flex-row gap-2" style="justify-content: center;">
                                            <img src="{{ URL('assets/profile-section.svg')}}" alt="" width="20" height="20" class="p-0 d-md-block d-none" style="margin-top: 2px;" />
                                            <span class="m-0 p-0">RIZAL FIRDAUS</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-3">
                <div class="col">
                    <div class="row mb-3">
                        <a href="/petikemas" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white hover">

                                <img src="{{ URL('assets/Peti Kemas.svg')}}" alt="pegawai" width="100" height="100" class="img-fluid">
                                <div class="w-50">
                                    <h4 class="p-0 mx-0 my-2">PETI KEMAS</h4>
                                    <hr class="line mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                    <p class="p-0 mx-0 my-2">Halaman Peti Kemas</p>

                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row mb-3">
                        <a href="/transaksi" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white hover">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <img src="{{ URL('assets/Usaha.svg')}}" alt="usaha" width="100" height="100" class="img-fluid">

                                        <div>
                                            <h4 class="p-0 mx-0 my-2">TRANSAKSI</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Transaksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="row mb-3">
                        <a href="/pegawai" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white hover">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <img src="{{ URL('assets/Pegawai.svg')}}" alt="pegawai" width="100" height="100" class="img-fluid">

                                        <div>
                                            <h4 class="p-0 mx-0 my-2">PEGAWAI</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Pegawai</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
</x-layout>