<x-layout>
    <x-slot:title>
        Notifikasi
        </x-slot>
        <div class="card bg-primary mb-3 table-container rounded-4" style="height: 50rem;">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-between mb-2">
                        <h4 class=" text-white col-lg-6">NOTIFIKASI</h4>
                        <div class="p-0" style="width: fit-content;">
                            <form class="d-flex m-0 p-0" role="search" style="width: 21rem;">
                                <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                                <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><i class="fa-solid fa-magnifying-glass text-white" style="font-size:1.5rem"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="onscroll table-responsive">
                        <table class="table-variations-2  text-center" rules="groups">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-semibold">Message</th>
                                    <th scope="col" class="fw-semibold">Date</th>
                                    <th scope="col" class="fw-semibold">Time</th>
                                    <th scope="col" class="fw-semibold">From</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Pengajuan Cuti</td>
                                    <td>22 Desember 2023</td>
                                    <td>09.45</td>
                                    <td class="text-center">
                                        <i class="fa-solid fa-circle-user text-primary d-inline my-1" style="font-size: 25px;"></i>
                                        <span class="m-0 p-0 d-inline mx-1">RIZAL FIRDAUS</span>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2">
                                            <a class="btn bg-white text-white rounded-3 text-center" style="height: 2.2rem">
                                                <i class="fa-solid fa-arrow-up-right-from-square text-primary " style="font-size: 20px;"></i>
                                                <span class="text-primary mx-1 fw-semibold d-none d-lg-inline-block">OPEN</span>
                                            </a>
                                            <button class="btn btn-danger text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;"> <i class="fa-regular fa-trash-can text-white" style="font-size: 20px;"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</x-layout>