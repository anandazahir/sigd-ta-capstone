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
        @push('page-script')
        @stack('table-pengecekanhistory-script')
        @stack('table-perbaikanhistory-script')
        @stack('table-penempatanhistory-script')
        @stack('toast-script')
        @stack('form-delete')
        @endpush
</x-layout>