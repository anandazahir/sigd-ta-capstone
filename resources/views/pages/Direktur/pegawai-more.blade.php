<x-layout>
    <x-slot:title>
        Pegawai-More
        </x-slot>
        <x-biodata :data="$pegawai" />
        @if($pegawai->jabatan !== 'direktur')
        <x-table-absensi :data="$pegawai" />
        <x-table-pengajuan :data="$pegawai" :kenaikangaji="$kenaikangaji" :cuti="$cuti" />
        @endif


        <x-toast />
        @stack('toast-script')
        @stack('form-modal')
</x-layout>