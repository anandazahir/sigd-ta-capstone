<x-layout>
    <x-slot:title>
        Peti Kemas | {{$petikemas->no_petikemas}}
        </x-slot>
        <x-data-petikemas :data="$petikemas" />
        @can('melihat riwayat perbaikan')
        <x-table-pengecekanhistory :data="$petikemas" />
        <x-table-perbaikanhistory :data="$petikemas" />
        @endcan()
        @can('melihat riwayat penempatan')
        <x-table-penempatanhistory :data="$petikemas" />
        @endcan()
        <x-toast />
        @stack('toast-script')
        @stack('form-delete')
</x-layout>