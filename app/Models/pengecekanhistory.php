<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengecekanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perubahan', 'pengecekan_id'];
    public function pengecekan()
    {
        return $this->belongsTo(pengecekan::class);
    }
}
