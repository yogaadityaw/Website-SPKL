<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bengkel extends Model
{
    use HasFactory;

    protected $table = 'bengkel';
    protected $primaryKey = 'id_bengkel';

    protected $fillable = [
        'bengkel_name',
        'bengkel_head',
    ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    protected $hidden = [];

    public function spkl(): BelongsTo
    {
        return $this->belongsTo(Spkl::class, 'spkl_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'bengkel_head', 'id_user');
    }
}
