<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kerusakanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perubahan', 'kerusakan_id'];
    public function kerusakan()
    {
        return $this->belongsTo(kerusakan::class);
    }
}
