<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Pembayaran;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'kode_petugas',
        'nama_petugas',
        'jenis_kelamin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Function One-to-Many Relationship
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    // Function One-to-Many Relationship
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }

    public function scopeFilter($query, array $fillters)
    {
        $query->when($fillters['find'] ?? false, function ($query, $find) {
            return $query->where('nama_petugas', 'like', '%' . $find . '%');
        });
    }
}
