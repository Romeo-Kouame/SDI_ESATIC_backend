<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Collation;
use App\Models\Commande;
use App\Models\Equipe;
use App\Models\Hackaton;
use App\Models\Niveau;
use App\Models\Salle;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfFileController extends Controller
{
    /*
    {
        'niveauId' => id du niveau dont on veut le fichier pdf
    }
    */
    public function selectedteam($niveauId)
    {

        $hackaton = Hackaton::all()->last();
        $niveau = Niveau::find($niveauId);
        $equipes = Equipe::where('hackaton_id', $hackaton->id)
            ->where('niveau_id', $niveau->id)
            ->where('statut', 1)
            ->get();

        $data = [
            'date' => date('d-m-Y à h:i:s A'),
            'niveau' => $niveau->libelle,
            'title' => 'Hackathon',
            'equipes' => $equipes,

        ];

        $pdf = Pdf::loadView('pdf.listeEquipes', $data);
        return $pdf->stream('listeEquipes.pdf');

    }

    public function repartition()
    {
        $salles = Salle::all() ;
        $data = [
            'title' => 'Hackathon',
            'date' => date('d-m-Y à h:i:s A'),
            'salles' => $salles
        ];
          
        $pdf = Pdf::loadView('pdf.repartition', $data);
        return $pdf->stream('repartition.pdf');
    }


    public function commandes()
    {
        $salles = Salle::all() ;
        $collations = Collation::all() ;


        $data = [
            'title' => 'Hackathon',
            'date' => date('d-m-Y à h:i:s A'),
            'salles' => $salles,
            'collations' =>  $collations
        ];
          
        $pdf = Pdf::loadView('pdf.commandes', $data);
        return $pdf->stream('collations.pdf');
    }
}
