<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{

    protected $fillable = ['no_transaksi', 'jenis_kegiatan', 'no_do', 'tanggal_DO_rilis', 'tanggal_DO_exp', 'perusahaan', 'jumlah_petikemas', 'kapal', 'emkl', 'tanggal_transaksi', 'inventory'];
    public function petikemas()
    {
        return $this->belongsToMany(petikemas::class, 'penghubungs', 'transaksi_id', 'petikemas_id');
    }
    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
}
