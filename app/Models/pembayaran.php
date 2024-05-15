<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_pembayran', 'status_pembayaran', 'kasir', 'status_cetak_spk', 'penghubung_id', 'transaksi_id'];

    public function penghubung()
    {
        return $this->belongsTo(penghubung::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
}
