@php
$role = auth()->user()->getRoleNames();
$cleaned = str_replace(['[', ']', '"'], '', $role);
@endphp
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
                                <i class="fa-solid fa-circle-user" style="font-size:100px;"></i>
                            </div>
                            <div class="col-md-10 my-auto text-center text-lg-start" style="width: 25rem">
                                <h4 class="mt-2 p-0">{{auth()->user()->nama}}</h4>
                                <hr class="mb-2 line" style="height: 4px; background-color:#FFF;" />
                                <p class="mt-1 p-0 ">NIP: {{auth()->user()->nip}} | {{auth()->user()->jabatan}}</p>
                            </div>
                        </div>
                        <div class="position-absolute top-0 end-0" style="margin: 7px 7px;">
                            <a class="btn bg-white rounded-3 text-center" style="padding:4px 7px 4px 7px;" href="/{{$cleaned}}/profile">
                                <i class="fa-solid fa-ellipsis text-primary " style="font-size: 19px;"></i>
                            </a>
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
                            <div class="rounded-3 d-flex flex-row justify-content-center" style="width: 2rem; height: 2rem; place-items: center; background: #edf5f5;">
                                <a class="btn bg-white rounded-3 text-center onhover" style="padding:4px 7px 4px 7px;" href="/{{$cleaned}}/notification">
                                    <i class="fa-solid fa-ellipsis text-primary " style="font-size: 19px;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex flex-row mb-3">
                            <h4>NOTIFICATION</h4>
                        </div>
                        <div class="row container text-center scroll table-responsive" style="height: {{ auth()->user()->hasRole('kasir') || auth()->user()->hasRole('surveyin') || auth()->user()->hasRole('tally')  ? '12.3rem' : '21.5rem' }}">
                            <table class="table-dashboard ">
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
                                        <td class="text-center">
                                            <i class="fa-solid fa-circle-user text-white d-inline" style="font-size: 20px;"></i>
                                            <span class="m-0 p-0 d-inline mx-1">RIZAL FIRDAUS</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="col">
                    @can('melihat petikemas')
                    <div class="row mb-3">
                        <a href="/{{$cleaned}}/peti-kemas" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Peti Kemas">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <svg style="fill:rgb(var(--bs-primary-rgb))" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="80" height="80">
                                                <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                                                </g>
                                            </svg>
                                        </div>

                                        <div style="width:45%;">
                                            <h4 class="p-0 mx-0 my-2">PETI KEMAS</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Peti Kemas</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan()

                    @can('melihat transaksi')
                    <div class="row mb-3">
                        <a href="{{route($cleaned.'.transaksi.index')}}" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Transaksi">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <i class="fa-solid fa-briefcase text-primary my-1" style="font-size: 73px;"></i>
                                        </div>

                                        <div style="width:45%;">
                                            <h4 class="p-0 mx-0 my-2">TRANSAKSI</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Transaksi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan()

                    @can('melihat pengecekan')
                    <div class="row mb-3">
                        <a href="{{route('pengecekan.index')}}" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Transaksi">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <i class="fa-solid fa-briefcase text-primary my-1" style="font-size: 73px;"></i>
                                        </div>

                                        <div style="width:45%;">
                                            <h4 class="p-0 mx-0 my-2">PENGECEKAN</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Pengecekan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan()

                    @can('melihat perbaikan')
                    <div class="row mb-3">
                        <a href="{{route('perbaikan.index')}}" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Transaksi">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <i class="fa-solid fa-briefcase text-primary my-1" style="font-size: 73px;"></i>
                                        </div>

                                        <div style="width:45%;">
                                            <h4 class="p-0 mx-0 my-2">PERBAIKAN</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Perbaikan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan()
                    @can('melihat pembayaran')
                    <div class="row mb-3">
                        <a href="{{route('kasir.transaksi.index')}}" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Transaksi">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">

                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <i class="fa-solid fa-briefcase text-primary my-1" style="font-size: 73px;"></i>
                                        </div>

                                        <div style="width:45%;">
                                            <h4 class="p-0 mx-0 my-2">PEMBAYARAN</h4>
                                            <hr class="line p-0 mx-0 my-2" style="height: 2px; background-color:#FFF" />
                                            <p class="p-0 mx-0 my-2">Halaman Pembayaran</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan()

                    <div class="row mb-3">
                        <a href="/{{$cleaned}}/pegawai" class="text-decoration-none">
                            <div class="card shadow rounded-4 bg-primary text-white onhover" data-bs-toggle="tooltip" data-bs-placement="top" title="Halaman Pegawai">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-4">
                                        <div class="rounded-circle bg-white p-2 text-center" style="width: 100px; height: 100px;">
                                            <i class="fa-solid fa-user-tie text-primary" style="font-size: 77px;"></i>
                                        </div>
                                        <div style="width:45%;">
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