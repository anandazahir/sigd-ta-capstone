<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatan extends Model
{
    protected $fillable = ['tanggal_penempatan', 'operator_alat_berat', 'tally', 'penghubung_id', 'transaksi_id', 'foto_profil'];

    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }

    public function penghubung()
    {
        return $this->belongsTo(penghubung::class);
    }
}
