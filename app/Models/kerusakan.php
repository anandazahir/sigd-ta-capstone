<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kerusakan extends Model
{
    use HasFactory;
    protected $fillable = ['lokasi_kerusakan', 'komponen', 'status', 'metode', 'harga', 'foto_pengecekan', 'foto_perbaikan', 'pengecekan_id', 'perbaikan_id'];
    public function pengecekan()
    {
        return $this->belongsTo(pengecekan::class);
    }

    public function perbaikan()
    {
        return $this->belongsTo(perbaikan::class);
    }
    public function kerusakanhistory()
    {
        return $this->hasMany(kerusakanhistory::class);
    }
}
