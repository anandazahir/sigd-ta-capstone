<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatan extends Model
{
    protected $fillable = ['lokasi_petikemas', 'ketersediaan_peti_kemas', 'tanggal_penempatan', 'operator_alat_berat', 'tally', 'penghubung_id', 'transaksi_id'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function penghubung()
    {
        return $this->belongsTo(kerusakan::class);
    }
    public function penempatanhistory()
    {
        return $this->hasMany(penempatanhistory::class);
    }
}
