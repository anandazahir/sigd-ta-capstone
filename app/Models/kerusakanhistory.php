<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kerusakanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['lokasi_kerusakan', 'komponen', 'status', 'metode', 'harga', 'tanggal_perubahan', 'id_kerusakan', 'id_pengecekanhistory', 'id_perbaikanhistory', 'foto_pengecekan', 'foto_perbaikan', 'petikemas_id'];
    public function petikemas()
    {
        return $this->belongsTo(petikemas::class);
    }
}
