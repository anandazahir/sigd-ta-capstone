<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perbaikan extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perbaikan', 'repair', 'penghubung_id', 'transaksi_id', 'estimator', 'jumlah_perbaikan', 'foto_profil'];

    public function penghubung()
    {
        return $this->belongsTo(penghubung::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
}
