<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold">Pengajuan</h1>
        @if (!auth()->user()->hasRole('direktur'))
        <button class="btn bg-white mb-2" data-bs-toggle="modal" data-bs-target="#create-pengajuan-modal">
            <div class="d-flex gap-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Membuat Pengajuan">
                <div class="rounded-circle bg-primary p-1 " style="width: 30px; height:min-content;">
                    <i class="fa-solid fa-plus text-white" style="font-size:17px;"></i>
                </div>
                <span class="fs-5 fw-semibold text-primary">Tambah Pengajuan</span>
            </div>
        </button>
        @endif
        <div class="row mt-3">
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white" id="kenaikangaji"></h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>Kenaikan Gaji</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mt-lg-0 mt-3">
                <div class="card bg-white  shadow rounded-4">
                    <div class="card-body">
                        <div class="d-flex gap-2">
                            <div class="rounded-circle bg-primary position-relative" style="display: inline-block; width:5rem; height:4rem">
                                <h1 class="position-absolute top-50 start-50 translate-middle text-white" id="cuti"></h1>
                            </div>
                            <div class="my-auto w-100">
                                <h3>Cuti</h3>
                                <hr class="m-0 line" style="height: 1.5px; background-color:black;" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 30rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Jenis Pengajuan</th>
                        <th scope="col" class="fw-semibold">Tanggal Dibuat</th>
                        <th scope="col" class="fw-semibold">File</th>
                        <th scope="col" class="fw-semibold">Status</th>
                        @if (auth()->user()->hasRole('direktur'))
                        <th scope="col"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (auth()->user()->hasRole('direktur'))
                    @foreach ($data->pengajuan as $user)
                    <tr>
                        <td class="text-center">
                            {{ucwords($user->jenis_pengajuan)}}
                        </td>
                        <td class="text-center">
                            {{$user->tanggal_dibuat}}
                        </td>
                        <td class="text-center">
                            <a class="btn bg-primary rounded-3 d-flex p-1 mx-auto my-2 position-relative" style="width: fit-content; height:30px;" href="{{  $user['url_file']}}" target="_blank">
                                <i class="fa-solid fa-file-pdf position-absolute my-2 my-lg-0 text-white" style="font-size:20px;"></i>
                                <span class="fw-normal text-white mx-lg-4 mx-2 " style="font-size: 1.4vh;">{{$user->file_name}}</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="bg-{{$user->status == 'tolak' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status)}}</span>
                        </td>
                        <td class="text-center">
                            <button class="btn bg-primary text-white rounded-3" data-bs-toggle="modal" data-bs-target="#edit-pengajuan-modal-{{$user->id}}"> <i class=" fa-solid fa-pen-to-square fa-xl my-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Data Pengajuan Pegawai" value="{{$user->id}}"></i></button>
                        </td>
                    </tr>
                    @endforeach

                    @else
                    @foreach (auth()->user()->pengajuan as $user)
                    <tr>
                        <td class="text-center">
                            {{ucwords($user->jenis_pengajuan)}}
                        </td>
                        <td class="text-center">
                            {{$user->tanggal_dibuat}}
                        </td>
                        <td class="text-center">
                            <a class="btn bg-primary rounded-3 d-flex p-1 mx-auto my-2 position-relative" style="width: fit-content; height:30px;" href="{{  $user['url_file']}}" target="_blank">
                                <i class="fa-solid fa-file-pdf position-absolute my-2 my-lg-0 text-white" style="font-size:20px;"></i>
                                <span class="fw-normal text-white mx-lg-4 mx-2 " style="font-size: 1.4vh;">{{$user->file_name}}</span>
                            </a>
                        </td>
                        <td class="text-center">
                            <span class="bg-{{$user->status == 'tolak' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status)}}</span>
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@if (!auth()->user()->hasRole('direktur'))
<x-modal-form size="" id="create-pengajuan-modal" text="Buat Pengecekan ">
    <x-form-create-pengajuan />
</x-modal-form>
@endif


@if (auth()->user()->hasRole('direktur'))
@foreach ($data->pengajuan as $pengajuan)
<x-modal-form size="" id="edit-pengajuan-modal-{{$pengajuan->id}}" text="Edit Pengajuan | {{$data->username}}">
    <x-form-edit-pengajuan :pengajuan="$pengajuan" id="edit-pengajuan-modal-{{$pengajuan->id}}" />
</x-modal-form>
@endforeach
@endif
<script>
    $(document).ready(function() {
        let numkenaikangaji = "{{$kenaikangaji}}";
        let numcuti = "{{$cuti}}";
        console.log(numcuti);

        function initCountUp(id, endVal) {
            let demo = new CountUp(id, 0, endVal, 0, 3);
            if (!demo.error) {
                demo.start();
            } else {
                console.error(demo.error);
            }
        }
        initCountUp('kenaikangaji', parseInt(numkenaikangaji));
        initCountUp('cuti', parseInt(numcuti));
    });
</script>