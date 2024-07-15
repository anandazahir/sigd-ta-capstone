<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'nip',
        'nik',
        'nama',
        'no_hp',
        'jabatan',
        'alamat',
        'agama',
        'foto',
        'JK',
        'pendidikan_terakhir',
        'tanggal_lahir',
        'status_menikah',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function notifikasi()
    {
        return $this->hasMany(notifikasi::class);
    }
    public function pengajuan()
    {
        return $this->hasMany(pengajuan::class);
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
