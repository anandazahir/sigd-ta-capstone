<x-layout>
    <x-slot:title>
        Transaksi | {{$transaksi->no_transaksi}}
        </x-slot>
        <x-data-transaksi :data="$transaksi" />
        <x-table-pengecekan :data="$transaksi" />
        <x-toast />
        @stack('toast-script')
</x-layout>