<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_penempatan', 'operator_alat_berat', 'tally', 'petikemas_id', 'id_penempatan', 'status_ketersediaan', 'lokasi', 'foto_profil'];
    public function petikemas()
    {
        return $this->belongsTo(petikemas::class);
    }
}
