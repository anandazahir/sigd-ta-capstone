<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kerusakan extends Model
{
    public function pengecekan()
    {
        return $this->hasMany(pengecekan::class);
    }
}
