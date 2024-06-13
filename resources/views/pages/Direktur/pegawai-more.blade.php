<x-layout>
    <x-slot:title>
        Pegawai-More
        </x-slot>
        <x-biodata :data="$pegawai" />
        <x-table-absensi />
        <x-table-pengajuan />
        <x-form-table-absensi />
        <x-form-create-table-pengajuan />

        <x-toast />
        @stack('toast-script')
        @stack('form-modal')
</x-layout>