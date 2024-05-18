<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perbaikanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perubahan', 'perbaikan_id'];
    public function perbaikan()
    {
        return $this->belongsTo(perbaikan::class);
    }
}
