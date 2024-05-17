<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengecekan extends Model
{
    protected $fillable = ['tanggal_pengecekan', 'jumlah_kerusakan', 'survey_in', 'kondisi_peti_kemas', 'penghubung_id', 'transaksi_id'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function penghubung()
    {
        return $this->belongsTo(kerusakan::class);
    }
}
