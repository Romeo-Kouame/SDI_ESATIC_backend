<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qvideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'niveau_id',
    ];

    public function niveau(){
        return $this->belongsTo(Niveau::class);
    }
}
