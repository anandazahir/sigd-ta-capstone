<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penghubung extends Model
{

    protected $fillable = ['transaksi_id', 'petikemas_id'];
    public function pembayaran()
    {
        return $this->hasOne(pembayaran::class);
    }
}
