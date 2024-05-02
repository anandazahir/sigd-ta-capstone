<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petikemas extends Model
{
    use HasFactory;
    protected $fillable = ['no_petikemas', 'transaksi_id', 'tanggal_keluar', 'tanggal_masuk', 'jenis_ukuran', 'pelayaran', 'status_kondisi', 'status_ketersediaan', 'lokasi', 'harga'];
    
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
}
