<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory;

    protected $table = 'departemen';
    protected $primaryKey = 'id_departemen';
    protected $fillable = [
        'departemen_name',
        'departemen_head',
    ];

    public function bengkels()
    {
        return $this->hasMany(Bengkel::class, 'departemen_id', 'id_departemen');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'departemen_head', 'id_user');
    }
}
