<x-layout>
    <x-slot:title>
        Pegawai-More
        </x-slot>
        <x-biodata :data="$pegawai" />
        <x-table-absensi />
        <x-table-pengajuan :data="$pegawai" />
        <x-form-table-absensi />

        <x-toast />
        @stack('toast-script')
        @stack('form-modal')
</x-layout>