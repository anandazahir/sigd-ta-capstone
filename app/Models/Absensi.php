<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $fillable = [
        'waktu_masuk',
        'waktu_pulang',
        'status_masuk',
        'status_pulang',
        'user_id'
    ];
    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
