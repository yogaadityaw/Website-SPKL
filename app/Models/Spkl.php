<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spkl extends Model
{
    use HasFactory;

    protected $table = 'spkl';
    protected $primaryKey = 'id_spkl';
    protected $fillable = [
        'ref_number',
        'spkl_number',
        'qr_code',
        'uraian_pekerjaan',
        'progres',
        'tanggal',
        'pelaksanaan',
        'status',
        'pt_id',
        'proyek_id',
        'bengkel_id',
        'user_id',
        'is_kabeng_acc',
        'is_departemen_acc',
        'is_kemenpro_acc',
        'alasan_penolakan',
        'rencana_mulai',
        'rencana_selesai',
        'status'
    ];
    protected $dates = ['tanggal'];

    public function pt()
    {
        return $this->belongsTo(Pt::class, 'pt_id');
    }

    public function bengkel()
    {
        return $this->belongsTo(Bengkel::class, 'bengkel_id');
    }

    public function proyek()
    {
        return $this->belongsTo(Proyek::class, 'proyek_id');
    }

    public function userSpkls()
    {
        return $this->hasMany(UserSpkl::class, 'spkl_id', 'id_spkl');
    }

    public function qr()
    {
        return $this->hasOne(QRCode::class, 'spkl_id', 'id_spkl');
    }
}
