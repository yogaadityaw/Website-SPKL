<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pt extends Model
{
    use HasFactory;

    protected $table = 'pt';
    protected $primaryKey = 'id_pt';

    protected $fillable = [
        'pt_name'
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
}
