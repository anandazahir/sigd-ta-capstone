@extends('index')
@section('pages')
<div class="d-flex flex-row  justify-content-between mt-3 text-secondary">
    <h3 style="font-size: 1rem;">Transaksi</h3>

    <a href="#" class="d-flex flex-row gap-1 text-decoration-none text-reset">
        <img src="{{ URL('assets/home-icon.svg')}}" alt="" style="width: 1.08rem; height: 1.08rem;" />

        <p style="font-size: 0.8rem;">/ Transaksi</p>
    </a>
</div>
<div class="row mb-3">
    <div class="col-lg-6 mb-lg-0 mb-3">
        <div class="card bg-primary text-white rounded-4 shadow">
            <div class="card-body d-flex gap-2">
                <div class="rounded-circle bg-white p-3" style="width: fit-content; height:fit-content;">
                    <i class="fa-solid fa-copy text-primary fa-xl"></i>
                </div>
                <div class="d-block">
                    <p class="m-0 text-white ">Total Transaksi</p>
                    <h4 class="fw-semibold text-white m-0">20</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-primary text-white rounded-4 shadow">
            <div class="card-body d-flex gap-2">
                <div class="rounded-circle bg-white p-3 text-center" style="width: 53px; height:min-content;">
                    <i class="fa-solid fa-dollar-sign text-primary fa-xl"></i>
                </div>
                <div class="d-block">
                    <p class="m-0 text-white ">Total Pendapatan</p>
                    <h4 class="fw-semibold text-white m-0">Rp.25.0000.0000</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-3">
    <div class="col-lg-6 mb-lg-0 mb-3">
        <div class="card bg-primary text-white rounded-4 shadow">
            <div class="card-body d-flex gap-2">
                <div class="rounded-circle bg-white p-3" style="width: fit-content; height:fit-content;">
                    <i class="fa-solid fa-copy text-primary fa-xl"></i>
                </div>
                <div class="d-block">
                    <p class="m-0 text-white ">Total Transaksi</p>
                    <h4 class="fw-semibold text-white m-0">20</h4>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card bg-primary text-white rounded-4 shadow">
            <div class="card-body d-flex gap-2">
                <div class="rounded-circle bg-white p-3 text-center" style="width: 53px; height:min-content;">
                    <i class="fa-solid fa-dollar-sign text-primary fa-xl"></i>
                </div>
                <div class="d-block">
                    <p class="m-0 text-white ">Total Pendapatan</p>
                    <h4 class="fw-semibold text-white m-0">Rp.25.0000.0000</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="w-100 bg-primary mb-4 shadow rounded-4 p-3" style="height: 50rem;">
    <div class="container">
        <h3 class=" text-white mb-2">DATA TRANSAKSI | IMPOR</h3>
        <hr class="line p-0 m-0" style="height: 2px; background-color:#FFF; width:36vh;" />
        <h3 class=" text-white mb-2">November</h3>
        <div class="row justify-content-between p-0 m-0" style=" margin-top:20px;">
            <div class="p-0" style="width: fit-content;">
                <a href="" class="btn btn-info mb-2 mb-lg-0" style="width: fit-content;">
                    <img src="{{ URL('assets/tambah.svg')}}" alt="">
                    <span class="fs-5 fw-semibold">Tambah Transaksi</span>
                </a>
                <a href="" class="btn btn-info mb-2 mb-lg-0" style="width: fit-content;">
                    <img src="{{ URL('assets/download.svg')}}" alt="" style="margin-bottom: 5px;">
                    <span class="fs-5 fw-semibold mx-2">Laporan Bulanan Transaksi</span>
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
                        <th scope="col" class="fw-semibold">No Peti Kemas</th>
                        <th scope="col" class="fw-semibold">Size & Type</th>
                        <th scope="col" class="fw-semibold">Status Kondisi</th>
                        <th scope="col" class="fw-semibold">Status Ketersediaan</th>
                        <th scope="col" class="fw-semibold">Jumlah Peti Kemas</th>
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
                                <a class="btn btn-info text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;" href="/petikemas-more"> <img src="{{ URL('assets/More.svg')}}" alt="" style="width: 2rem; height: 2rem;" /></a>
                                <button class="btn btn-danger text-white p-0 rounded-3" style="width: 2.5rem; height: 2.2rem;"> <img src="{{ URL('assets/Delete.png')}}" alt="" style="width: 2rem; height: 2rem;" /></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection