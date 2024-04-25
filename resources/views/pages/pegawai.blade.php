<x-layout>
    <x-slot:title>
        Pegawai
        </x-slot>
        <div class="w-100 bg-primary mb-4 shadow rounded-4 p-3" style="height: 50rem;">
            <div class="container">
                <h3 class=" text-white" style="margin-bottom:20px;">DATA PEGAWAI</h3>
                <div class="row justify-content-between p-0 m-0" style=" margin-top:20px;">
                    <div class="p-0" style="width: fit-content;">
                        <button class="btn btn-info mb-2" data-bs-toggle="modal" data-bs-target="#create-pegawai">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-plus text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Tambah Pegawai</span>
                            </div>
                        </button>
                        <a href="" class="btn btn-info mb-2  ">
                            <div class="d-flex gap-1">
                                <div class="rounded-circle bg-white p-1 " style="width: 30px; height:min-content;">
                                    <i class="fa-solid fa-download text-info" style="font-size:17px;"></i>
                                </div>
                                <span class="fs-5 fw-semibold">Laporan Pegawai</span>
                            </div>
                        </a>
                    </div>

                    <div class="p-0" style="width: fit-content;">
                        <form class="d-flex m-0 p-0" role="search" style="width: 21rem;">
                            <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                            <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                        </form>
                    </div>
                </div>
                <div class="onscroll table-container table-responsive">
                    <table class="table-variations-2  text-center" rules="groups">
                        <thead>
                            <tr>
                                <th scope="col" class="fw-semibold">Nama</th>
                                <th scope="col" class="fw-semibold">NIP</th>
                                <th scope="col" class="fw-semibold">Jabatan</th>
                                <th scope="col" class="fw-semibold">No. Telepon</th>
                                <th scope="col" class="fw-semibold">Email</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rizal Firdaus</td>
                                <td>2112020</td>
                                <td>Inventory</td>
                                <td>081888888</td>
                                <td>jajshjkadh@gmail.com</td>
                                <td>
                                    <div class="btn-group gap-2">
                                        <a class="btn btn-info text-white p-0 rounded-3 " style="width: 2.5rem; height: 2.2rem;" href="/pegawai/more"> <i class="fa-solid fa-ellipsis text-white my-2" style="font-size: 20px;"></i></a>
                                        <button class="btn btn-danger text-white p-0 rounded-3 " style="width: 2.5rem; height: 2.2rem;"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <x-create-pegawai />
</x-layout>