<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Participant extends Model
{
    use HasFactory;

    public $guarded = [] ;

    protected $fillable = [
        'etudiant_id',
        'equipe_id',
        'hackaton_id',
        'chef'
    ];

    public function equipe()
    {
    	return $this->belongsTo(Equipe::class);
    }

    public function hackaton()
    {
    	return $this->belongsTo(Hackaton::class);
    }

    public function etudiant()
    {
    	return $this->belongsTo(Etudiant::class);
    }

}
