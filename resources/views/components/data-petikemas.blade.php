@php
setlocale(LC_TIME, 'id_ID');
@endphp
<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="fw-semibold  text-white fs-1 fs-lg-2 mb-3">NO.Peti Kemas | {{$data->no_petikemas}} </h1>
        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-file-lines position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:55px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">NO.Peti Kemas</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:55px">
                            {{$data->no_petikemas}}
                            {{-- 022847-DO.IN-1223  --}}
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-solid fa-briefcase position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Size & Type</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            {{$data -> jenis_ukuran}}
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <div class="position-absolute top-0 start-0 my-3" style="margin-left: 10px">
                            <svg fill="#f09259 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="3.7rem" height="3.7rem">
                                <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                                </g>
                            </svg>
                        </div>

                        <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Pelayaran</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:70px">
                            {{$data -> pelayaran}}
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <div class="position-absolute top-0 start-0 my-3" style="margin-left: 10px">
                            <svg fill="#f09259 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="3.7rem" height="3.7rem">
                                <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                                </g>
                            </svg>
                        </div>

                        <p style="margin-left:70px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Status Kondisi</p>
                        <h5 class="fw-semibold fs-5  bg-success p-1 rounded-2 text-white" style="margin-left:70px; width:fit-content">


                            available

                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal Keluar</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">


                            05 Desember 2022

                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <i class="fa-regular fa-calendar-days position-absolute top-0 start-0 my-3 text-primary" style="margin-left: 10px ; font-size:3.7rem;"></i>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Tanggal Masuk</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">



                            {{strftime('%e %B %Y', strtotime($data->tanggal_masuk))}}

                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <div class="position-absolute top-0 start-0 my-3" style="margin-left: 10px">
                            <svg fill="#f09259 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="3.7rem" height="3.7rem">
                                <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                                </g>
                            </svg>
                        </div>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Status Ketersediaan</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            <h5 class="fw-semibold fs-5  bg-success p-1 rounded-2 text-white" style="margin-left:70px; width:fit-content">

                                <!-- Pengkondisian sementara -->

                                In

                            </h5>
                        </h5>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-3">
                <div class="card shadow rounded-4 bg-white">
                    <div class="card-body">
                        <div class="position-absolute top-0 start-0 my-3" style="margin-left: 10px">
                            <svg fill="#f09259 " viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="3.7rem" height="3.7rem">
                                <g id="SVGRepo_bgCarrier" stroke-width="1"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path fill-rule="evenodd" d="M13.152.682a2.25 2.25 0 012.269 0l.007.004 6.957 4.276a2.276 2.276 0 011.126 1.964v7.516c0 .81-.432 1.56-1.133 1.968l-.002.001-11.964 7.037-.004.003a2.276 2.276 0 01-2.284 0l-.026-.015-6.503-4.502a2.268 2.268 0 01-1.096-1.943V9.438c0-.392.1-.77.284-1.1l.003-.006.014-.026a2.28 2.28 0 01.82-.827h.002L13.152.681zm.757 1.295h-.001L2.648 8.616l6.248 4.247a.776.776 0 00.758-.01h.001l11.633-6.804-6.629-4.074a.75.75 0 00-.75.003zM18 9.709l-3.25 1.9v7.548L18 17.245V9.709zm1.5-.878v7.532l2.124-1.25a.777.777 0 00.387-.671V7.363L19.5 8.831zm-9.09 5.316l2.84-1.66v7.552l-3.233 1.902v-7.612c.134-.047.265-.107.391-.18l.002-.002zm-1.893 7.754V14.33a2.277 2.277 0 01-.393-.18l-.023-.014-6.102-4.147v7.003c0 .275.145.528.379.664l.025.014 6.114 4.232z"></path>
                                </g>
                            </svg>
                        </div>
                        <p style="margin-left:65px; font-size: 14px; color:#A3AED0;" class="my-0 fw-semibold">Lokasi</p>
                        <h5 class="fw-semibold fs-5 text-black" style="margin-left:65px">
                            <h5 class="fw-semibold fs-5  bg-success p-1 rounded-2 text-white" style="margin-left:70px; width:fit-content">
                                A0 01-01
                            </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>