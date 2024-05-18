<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penempatanhistory extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_perubahan', 'penempatan_id'];
    public function penempatan()
    {
        return $this->belongsTo(penempatan::class);
    }
}
