<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pt extends Model
{
    use HasFactory;

    protected $table = 'pt';
    protected $primaryKey = 'id_pt';
    protected $fillable = [
        'pt_name'
    ];

    public function spkls()
    {
        return $this->hasMany(Spkl::class, 'pt_id', 'id_pt');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'pt_id', 'id_pt');
    }
}
