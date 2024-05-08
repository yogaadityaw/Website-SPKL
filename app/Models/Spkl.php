<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Spkl extends Model
{
    use HasFactory;

    protected $table = 'spkl';
    protected $primaryKey = 'id_spkl';

    protected $fillable = [
        'spkl_number',
        'uraian_pekerjaan',
        'tanggal',
        'rencana',
        'pelaksanaan',
        'status',
        'jam_realisasi',
        'pt_id',
        'proyek_id',
        'departemen_id',
        'bengkel_id',
        'user_id',
    ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    protected $hidden = [];

    public function pt(): HasOne
    {
        return $this->hasOne(Pt::class, 'pt_id');
    }

    public function departemen(): HasOne
    {
        return $this->hasOne(Departemen::class, 'departemen_id');
    }

    public function bengkel(): HasOne
    {
        return $this->hasOne(Bengkel::class, 'bengkel_id');
    }

    public function proyek(): HasOne
    {
        return $this->hasOne(Proyek::class, 'bengkel_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'spkl_id');
    }
}
