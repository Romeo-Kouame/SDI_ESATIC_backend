<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QsessionResponse extends Model
{
    use HasFactory;

    protected $fillable = [
        'score',
        'state',
        'qsession_id',
        'response_id',
        'question_id'
    ];
}
