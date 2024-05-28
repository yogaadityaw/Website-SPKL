<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    protected $table = 'proyek';
    protected $primaryKey = 'id_proyek';
    protected $fillable = [
        'proyek_name',
        'pj_proyek',
    ];

    public function spkls()
    {
        return $this->hasMany(Spkl::class, 'proyek_id', 'id_proyek');
    }

    public function user() {
        return $this->belongsTo(User::class, 'pj_proyek', 'id_user');
    }
}
