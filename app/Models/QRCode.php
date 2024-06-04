<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QRCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'spkl_id',
        'workshop_head_qr_code',
        'department_head_qr_code',
        'pj_proyek_qr_code'
    ];

    public function spkl()
    {
        return $this->belongsTo(Spkl::class, 'spkl_id', 'id_spkl');
    }
}
