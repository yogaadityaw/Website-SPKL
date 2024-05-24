<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'role_id'
    ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at'
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function spkl()
    {
        return $this->hasOne(UserSpkl::class, 'user_id', 'id_user');
    }

    public function pt(): BelongsTo
    {
        return $this->belongsTo(Pt::class, 'pt_id');
    }

    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }

    public function bengkel(): BelongsTo
    {
        return $this->belongsTo(Bengkel::class, 'bengkel_id');
    }

    public function kabeng()
    {
        return $this->hasOne(Bengkel::class, 'bengkel_head', 'id_user');
    }
}
