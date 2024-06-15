<x-layout>
    <x-slot:title>
        Pembayaran | {{$transaksi->no_transaksi}}
        </x-slot>
        <x-data-transaksi :data="$transaksi" />
        <x-table-pembayaran :data="$transaksi" />
        <x-toast />
        @stack('toast-script')
</x-layout>