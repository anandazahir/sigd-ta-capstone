<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatan extends Model
{
    public function transaksi()
    {
        return $this->hasMany(transaksi::class);
    }
}