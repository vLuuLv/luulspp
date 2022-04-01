<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelas',
        'kompetensi_keahlian',
    ];

    // Function One-to-Many Relationship
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function scopeFilter($query, array $fillters)
    {
        $query->when($fillters['find'] ?? false, function ($query, $find) {
            return $query->where('nama_kelas', 'like', '%' . $find . '%');
        });
    }
}
