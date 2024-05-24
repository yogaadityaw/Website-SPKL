<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSpkl extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spkl_id',
        'image',
        'check_in',
        'check_out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function spkl()
    {
        return $this->belongsTo(Spkl::class, 'spkl_id', 'id_spkl');
    }
}
