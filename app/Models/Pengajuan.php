<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $fillable = [
        'jenis_pengajuan',
        'tanggal_dibuat',
        'url_file',
        'file_name',
        'status',
        'mulai_cuti',
        'selesai_cuti'
    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
