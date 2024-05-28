<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengecekanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_pengecekan', 'jumlah_kerusakan', 'survey_in', 'status_kondisi', 'petikemas_id'];
    public function petikemas()
    {
        return $this->belongsTo(petikemas::class);
    }
}
