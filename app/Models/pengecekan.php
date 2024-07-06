<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengecekan extends Model
{
    protected $fillable = ['tanggal_pengecekan', 'jumlah_kerusakan', 'survey_in', 'kondisi_peti_kemas', 'penghubung_id', 'transaksi_id', 'foto_profil'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function penghubung()
    {
        return $this->belongsTo(penghubung::class);
    }

    public function kerusakan()
    {
        return $this->hasMany(kerusakan::class);
    }
}
