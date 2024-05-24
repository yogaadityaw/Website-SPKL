<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';
    protected $primaryKey = 'id_proyek';

    protected $fillable = [
        'proyek_name',
        'pj_proyek',
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

    public function user() {
        return $this->belongsTo(User::class, 'pj_proyek', 'id_user');
    }
}
