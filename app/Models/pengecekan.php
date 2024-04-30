<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengecekan extends Model
{
    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }

    public function kerusakan()
    {
        return $this->hasMany(kerusakan::class);
    }
}
