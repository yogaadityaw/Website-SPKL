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
        'is_kabeng_acc',
        'is_departemen_acc',
        'is_kemenpro_acc',
    ];

    protected $dates = ['tanggal'];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    protected $hidden = [];

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

    public function proyek(): BelongsTo
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function user()
    {
        return $this->hasMany(UserSpkl::class, 'spkl_id', 'id_spkl');
    }

    public function qr()
    {
        return $this->hasOne(QRCode::class, 'spkl_id', 'id_spkl');
    }
}
