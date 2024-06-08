<?php

namespace App\Charts;

use App\Models\penghubung;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Transaksi;
use Carbon\Carbon;
use App\Models\petikemas;

class TransaksiBulananLine
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $tahun = date('Y');
        $bulan = date('m');
        for ($i = 5; $i <= $bulan; $i++) {
            $totalHargaImpor = 0;
            $totalHargaEkspor = 0;

            $transaksiCollectionimpor = Transaksi::where('jenis_kegiatan', 'impor')->get();  // Retrieve filtered Transaksi instances
            $transaksiCollectionekspor = Transaksi::where('jenis_kegiatan', 'ekspor')->get();

            foreach ($transaksiCollectionimpor as $transaksi) {
                // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'lunas' and date conditions
                $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($tahun, $i) {
                    $query->where('status_pembayaran', 'sudah lunas')
                        ->whereYear('tanggal_pembayaran', $tahun)
                        ->whereMonth('tanggal_pembayaran', $i);
                })->with('petikemas')->get();
                $totalHargaImpor += $lunasPenghubungs->pluck('petikemas.harga')->sum();
            }
            foreach ($transaksiCollectionekspor as $transaksi) {
                // Filter penghubungs to include only those with a pembayaran status_pembayaran of 'lunas' and date conditions
                $lunasPenghubungs = $transaksi->penghubungs()->whereHas('pembayaran', function ($query) use ($tahun, $i) {
                    $query->where('status_pembayaran', 'sudah lunas')
                        ->whereYear('tanggal_pembayaran', $tahun)
                        ->whereMonth('tanggal_pembayaran', $i);
                })->with('petikemas')->get();
                $totalHargaEkspor += $lunasPenghubungs->pluck('petikemas.harga')->sum();
            }
            // Store the total harga for the current month
            $dataBulan[] = Carbon::create()->month($i)->format('F');
            $dataTotalHargaImpor[] = $totalHargaImpor;
            $dataTotalHargaEkspor[] = $totalHargaEkspor;
        }

        // Now you can access the $petikemas variable outside of the loops

        return $this->chart->lineChart()
            ->addData('Impor',  $dataTotalHargaImpor)
            ->addData('Ekspor', $dataTotalHargaEkspor)
            ->setXAxis($dataBulan)
            ->setDataLabels(true)
            ->setGrid(true)
            ->setHeight(300);
    }
}
