<x-layout>
    <x-slot:title>
        Transaksi | {{$transaksi->no_transaksi}}
        </x-slot>
        <x-data-transaksi :data="$transaksi" />
        <x-table-perbaikan :data="$transaksi" :user="$user" />
        <x-toast />
        @stack('toast-script')
        @stack('form-edit-perbaikan')
</x-layout>