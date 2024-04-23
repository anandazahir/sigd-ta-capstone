<x-layout>
    <x-slot:title>
        Pegawai
        </x-slot>
        <div class="w-100 bg-primary mb-4 shadow rounded-4 p-3" style="height: 50rem;">
            <div class="container">
                <h3 class=" text-white" style="margin-bottom:20px;">DATA PEGAWAI</h3>
                <div class="row justify-content-between p-0 m-0" style=" margin-top:20px;">
                    <div class="p-0" style="width: fit-content;">
                        <a href="" class="btn btn-info mb-2 mb-lg-0 " style="width: fit-content;">
                            <img src="{{ URL('assets/tambah.svg')}}" alt="">
                            <span class="fs-5 fw-semibold">Tambah Pegawai</span>
                        </a>
                        <a href="" class="btn btn-info mb-2 mb-lg-0 p-2 me-auto" style="width: fit-content;">
                            <img src="{{ URL('assets/download.svg')}}" alt="">
                            <span class="fs-5 fw-semibold mx-2">Laporan Pegawai</span>
                        </a>
                    </div>
                    <form class="d-flex col-lg-6 m-0 p-0" role="search" style="width: 21rem;">
                        <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                        <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><img src="{{ URL('assets/search.svg')}}" alt="" style="width: 1.7rem; height: 1.7rem;" /></button>
                    </form>
                </div>
                <div class="scroll table-container">
                    <table class="table-variations-2 table-responsive text-center" rules="groups">
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
                                        <a class="btn btn-info text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/pegawai/more"> <img src="{{ URL('assets/More.svg')}}" alt="" style="width: 2rem; height: 2rem;" /></a>
                                        <button class="btn btn-danger text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;"> <img src="{{ URL('assets/Delete.png')}}" alt="" style="width: 2rem; height: 2rem;" /></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</x-layout>