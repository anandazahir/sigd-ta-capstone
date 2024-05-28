<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class petikemas extends Model
{
    use HasFactory;
    protected $fillable = ['no_petikemas', 'tanggal_keluar', 'tanggal_masuk', 'jenis_ukuran', 'pelayaran', 'harga', 'status_kondisi', 'status_ketersediaan', 'lokasi'];

    public function penghubungs()
    {
        return $this->hasMany(penghubung::class);
    }
    public function pengecekanhistory()
    {
        return $this->hasMany(pengecekanhistory::class);
    }
}
