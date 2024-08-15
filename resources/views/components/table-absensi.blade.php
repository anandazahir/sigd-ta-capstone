@php
$role = '';
$id = '';
if (auth()->user()->hasRole('direktur')){
$role = strtolower($data->jabatan);
$id = $data->jabatan;

}else{
$role = strtolower(auth()->user()->jabatan);
$id = auth()->user()->jabatan;
if ($role == 'survey in'){
$role = 'surveyin';
}else if($role == 'manajer operasional'){
$role = 'mops';
}
}
@endphp
<div class="w-100 bg-primary mb-3 shadow rounded-4 p-3" style="height: auto;">
    <div class="container position-relative">
        <h1 class="text-white fw-semibold month-text">Kehadiran</h1>
        <div class="bg-white mt-3 p-2 rounded-4 shadow onscroll table-responsive" style="height: 30rem;">
            <table class="table-variations-3  text-center">
                <thead>
                    <tr>
                        <th scope="col" class="fw-semibold">Tanggal</th>
                        <th scope="col" class="fw-semibold">Waktu Masuk</th>
                        <th scope="col" class="fw-semibold">Keterangan</th>
                        <th scope="col" class="fw-semibold">Waktu Pulang</th>
                        <th scope="col" class="fw-semibold">Keterangan</th>
                        @if (auth()->user()->hasRole('direktur'))
                        <th scope="col" class="fw-semibold">Log</th>
                        <th scope="col"></th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (auth()->user()->hasRole('direktur'))
                    @foreach ($data->absensi->sortBy('waktu_masuk') as $user)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_masuk)->locale('id')->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_masuk)->format('H:i') }}
                        </td>
                        <td class="text-center">
                            <span class="bg-{{$user->status_masuk == 'terlambat' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status_masuk)}}</span>
                        </td>
                        @if ($user->waktu_pulang)
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_pulang)->format('H:i') }}
                        </td>
                        @endif
                        <td class="text-center">
                            <span class="bg-{{$user->status_pulang == 'terlambat' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status_pulang)}}</span>
                        </td>
                        <td class="text-center">
                            <button class="btn shadow bg-primary text-white rounded-3 m-0" style="padding: 0 10px 0 10px;" id="button-log-absensi-{{ $user->id }}" value="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#table-log-absensi-{{ $user->id }}" ><span class="fw-semibold">LOG</span></button>
                        </td>
                        <td class="text-center">
                            <button class="btn shadow bg-primary text-white rounded-3" data-bs-toggle="modal" data-bs-target="#edit-absensi-modal-{{$user->id}}"> <i class=" fa-solid fa-pen-to-square fa-xl my-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Data Absensi Pegawai" value="{{$user->id}}"></i></button>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    @foreach (auth()->user()->absensi->sortBy('waktu_masuk') as $user)
                    <tr>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_masuk)->locale('id')->translatedFormat('l, d F Y') }}
                        </td>
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_masuk)->format('H:i') }}
                        </td>
                        <td class="text-center">
                            <span class="bg-{{$user->status_masuk == 'terlambat' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status_masuk)}}</span>
                        </td>
                        @if ($user->waktu_pulang)
                        <td class="text-center">
                            {{ \Carbon\Carbon::parse($user->waktu_pulang)->format('H:i') }}
                        </td>

                        <td class="text-center">
                            <span class="bg-{{$user->status_pulang == 'terlambat' ? 'danger' : 'primary'}} rounded-2 p-1 fw-semibold text-white">{{strtoupper($user->status_pulang)}}</span>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @endif()
                </tbody>
            </table>
        </div>
    </div>
</div>
@if (auth()->user()->hasRole('direktur'))
@foreach ($data->absensi as $absensi)
<x-modal-form size="" id="edit-absensi-modal-{{$absensi->id}}" text="Edit Absensi | {{$data->username}}">
    <x-form-table-absensi :absensi="$absensi" id="edit-pengajuan-modal-{{$absensi->id}}" />
</x-modal-form>

<x-table-log-absensi data="{{ $absensi->id }}" id="table-log-absensi-{{ $absensi->id }}" text="List Log Absensi Hari | {{  \Carbon\Carbon::parse($absensi->waktu_masuk)->locale('id')->translatedFormat('l, d F Y') }}" />

@endforeach
@endif