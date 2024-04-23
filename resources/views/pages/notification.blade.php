<x-layout>
    <x-slot:title>
        Notifikasi
        </x-slot>
        <div class="card bg-primary mb-3 table-container rounded-4" style="height: 50rem;">
            <div class="card-body">
                <div class="container">
                    <div class="row justify-content-between mb-3">
                        <h4 class=" text-white col-lg-6">NOTIFIKASI</h4>
                        <form class="d-flex col-lg-6" role="search" style="width: 21rem;">
                            <input class="form-control  shadow" type="search" placeholder="Search Something" aria-label="Search" style="border-radius: 10px 0px 0px 10px;">
                            <button class="btn btn-secondary shadow" type="submit" style="border-radius: 0px 10px 10px 0px;"><img src="{{ URL('assets/search.svg')}}" alt="" style="width: 1.7rem; height: 1.7rem;" /></button>
                        </form>
                    </div>
                    <div class="onscroll">
                        <table class="table-variations-2 table-responsive text-center" rules="groups">
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
                                    <td>
                                        <div class="d-flex gap-1" style="justify-content: center;">
                                            <img src="{{ URL('assets/profile-Navbar.svg')}}" alt="" width="30" height="30" class="p-0 d-md-block d-none" style="margin-top: 2px;" />
                                            <span>RIZAL FIRDAUS</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group gap-2">
                                            <a class="btn btn-info text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/transaksi/more"> <img src="{{ URL('assets/More.svg')}}" alt="" style="width: 2rem; height: 2rem;" /></a>
                                            <button class="btn btn-danger text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;"> <img src="{{ URL('assets/Delete.png')}}" alt="" style="width: 2rem; height: 2rem;" /></button>
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