<?php

namespace App\Models;

use App\Models\Siswa;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Function One-to-One relationship
    public function petugas()
    {
        return $this->hasOne(Petugas::class);
    }

    // Function One-to-One relationship
    public function siswa()
    {
        return $this->hasOne(Siswa::class);
    }

    // Function validasi role
    public function hasRole($role)
    {
        if ($role == $this->role) {
            return true;
        }
        return false;
    }

    // Function tombol cari
    public function scopeFilter($query, array $fillters)
    {
        $query->when($fillters['admin'] ?? false, function ($query, $admin) {
            return $query->where('username', 'like', '%' . $admin . '%');
        });
    }
}
