<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory; // 🔥 INI YANG KURANG

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role_id',
        'status'
    ];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
