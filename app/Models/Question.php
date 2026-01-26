<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'quiz_id'
    ];

    public function quiz(){
        return $this->belongsTo(Quiz::class);
    }

    public function responses(){
        return $this->hasMany(Response::class);
    }
}
