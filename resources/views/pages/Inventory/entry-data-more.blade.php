<x-layout>
    <x-slot:title>
        Peminjaman | {{$transaksi->no_transaksi}}
        </x-slot>
        <x-data-transaksi :data="$transaksi" />
        <x-table-entrydata :data="$transaksi" />
        <x-toast />
        @stack('table-entrydata')
        @stack('toast-script')
</x-layout>