<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Siswa;

class Spp extends Model
{
    use HasFactory;

    protected $table = 'spp';

    protected $fillable = [
        'tahun',
        'nominal',
    ];

    // Function One-to-Many Relationship
    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function scopeFilter($query, array $fillters)
    {
        $query->when($fillters['find'] ?? false, function ($query, $find) {
            return $query->where('tahun', 'like', '%' . $find . '%');
        });
    }
}
