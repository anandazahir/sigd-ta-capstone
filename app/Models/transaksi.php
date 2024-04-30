<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    public function pengecekan()
    {
        return $this->hasMany(pengecekan::class);
    }

    public function petikemas()
    {
        return $this->hasMany(petikemas::class);
    }

    public function perbaikan()
    {
        return $this->hasMany(perbaikan::class);
    }

    public function penempatan()
    {
        return $this->hasMany(penempatan::class);
    }
}
