<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $fillable = [
        'user_nip',
        'user_fullname',
        'username',
        'email',
        'user_telephone',
        'user_age',
        'password',
        'role_id',
        'pt_id',
        'bengkel_id'
    ];
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function spkl()
    {
        return $this->hasOne(UserSpkl::class, 'user_id', 'id_user');
    }

    public function pt()
    {
        return $this->belongsTo(Pt::class, 'pt_id');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class, 'bengkel_id');
    }

    public function kabeng()
    {
        return $this->hasOne(Bengkel::class, 'bengkel_head', 'id_user');
    }
}
