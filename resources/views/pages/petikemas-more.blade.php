<x-layout>
    <x-slot:title>
        Peti Kemas | {{$petikemas->no_petikemas}}
        </x-slot>
        <x-data-petikemas :data="$petikemas" />
        <x-table-pengecekanhistory :data="$petikemas" />
        <x-table-perbaikanhistory :data="$petikemas" />
        <x-table-penempatanhistory :data="$petikemas" />
        <x-toast />
        @stack('toast-script')
        @stack('form-delete')
</x-layout>