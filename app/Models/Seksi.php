<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'seksi',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
}
