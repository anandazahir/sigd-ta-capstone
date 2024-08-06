<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksihistory extends Model
{
    protected $fillable = [
        'waktu_perubahan',
        'no_petikemas',
        'user',
        'aksi',
        'transaksi_id',
    ];
    use HasFactory;
    public function transaksi()
    {
        return $this->belongsTo(transaksi::class);
    }
}
