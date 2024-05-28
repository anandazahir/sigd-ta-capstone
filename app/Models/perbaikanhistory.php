<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perbaikanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perbaikan', 'jumlah_perbaikan', 'repair', 'estimator', 'status_kondisi', 'petikemas_id'];
    public function petikemas()
    {
        return $this->belongsTo(petikemas::class);
    }
}
