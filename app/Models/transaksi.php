<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{

    protected $fillable = ['no_transaksi', 'jenis_kegiatan', 'no_do', 'tanggal_DO_rilis', 'tanggal_DO_exp', 'perusahaan', 'jumlah_petikemas', 'kapal', 'emkl', 'tanggal_transaksi', 'inventory', 'foto_profil'];
    public function penghubungs()
    {
        return $this->hasMany(penghubung::class);
    }
    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
    public function pengecekan()
    {
        return $this->hasMany(pengecekan::class);
    }
    public function perbaikan()
    {
        return $this->hasMany(perbaikan::class);
    }
    public function penempatan()
    {
        return $this->hasMany(penempatan::class);
    }
    public function transaksihistory()
    {
        return $this->hasMany(Transaksihistory::class);
    }
}
