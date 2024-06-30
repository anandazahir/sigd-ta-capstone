<x-layout>
    <x-slot:title>
        Pegawai-More
        </x-slot>
        <x-biodata :data="$pegawai" />
        @if($pegawai->jabatan !== 'direktur')
        <x-table-absensi />
        <x-table-pengajuan :data="$pegawai" :kenaikangaji="$kenaikangaji" :cuti="$cuti" />
        @endif
        <x-form-table-absensi />

        <x-toast />
        @stack('toast-script')
        @stack('form-modal')
</x-layout>