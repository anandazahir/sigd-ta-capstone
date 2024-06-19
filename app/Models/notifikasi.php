<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notifikasi extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'message',
        'tanggal_kirim',
        'sender',
        'foto_profil',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(user::class);
    }
}
