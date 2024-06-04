<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bengkel extends Model
{
    use HasFactory;

    protected $table = 'bengkel';
    protected $primaryKey = 'id_bengkel';
    protected $fillable = [
        'departemen_id',
        'bengkel_name',
        'bengkel_head',
    ];

    public function spkls()
    {
        return $this->hasMany(Spkl::class, 'bengkel_id', 'id_bengkel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'bengkel_head', 'id_user');
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id', 'id_departemen');
    }
}
