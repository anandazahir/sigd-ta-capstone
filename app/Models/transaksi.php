<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{

    protected $fillable = ['no_transaksi', 'jenis_kegiatan', 'no_do', 'tanggal_DO_rilis', 'tanggal_DO_exp', 'perusahaan', 'jumlah_petikemas', 'kapal', 'emkl', 'tgl_transaksi', 'kasir', 'inventory', 'tgl_pembayaran', 'status_pembayaran'];
    public function pengecekan()
    {
        return $this->hasMany(pengecekan::class);
    }
    public function petikemas()
    {
        return $this->hasMany(petikemas::class);
    }

    public function perbaikan()
    {
        return $this->hasMany(perbaikan::class);
    }

    public function penempatan()
    {
        return $this->hasMany(penempatan::class);
    }
}
