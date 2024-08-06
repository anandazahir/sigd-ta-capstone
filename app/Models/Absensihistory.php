<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensihistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'waktu_perubahan',
        'user',
        'absensi_id',
        'waktu_absensi'
    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
