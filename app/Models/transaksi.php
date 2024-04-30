<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaksi extends Model
{
    public function pengecekan()
    {
        return $this->belongsTo(pengecekan::class);
    }

    public function petikemas()
    {
        return $this->belongsTo(petikemas::class);
    }

    public function perbaikan()
    {
        return $this->belongsTo(perbaikan::class);
    }

    public function penempatan()
    {
        return $this->belongsTo(penempatan::class);
    }
}
