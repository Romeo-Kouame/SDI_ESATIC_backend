<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

use App\Models\Collation;
use App\Models\Commande;



class ParticipantController extends Controller
{
    //
    public function renderprestauration()
    {

        $user = Auth::user();

        $qrcodeValue = Crypt::encryptString($user->etudiant->matricule);

        $data = [
            "qrcodeValue" => $qrcodeValue,
        ];

        if ($user->etudiant->Commande()) {
            $data["hasOrdered"] = true;
            $data["collation"] = $user->etudiant->Commande()->collation;
        } else {
            $data["hasOrdered"] = false;
            $data["collations"] = Collation::all();
        }

        $response = [
            'status' => true,
            'data' => $data,
        ];

        return response()->json($response);

    }

    /*
    {
        'collationId' => id de la collation
    }
    */
    public function makecommande(Request $request)
    {

        $user = Auth::user();
        if ($user->etudiant->Commande()) {

            $response = [
                'status' => false,
                'message' => "Vous avez déjà passé une commande.",
            ];

        } else {

            $salle = $user->etudiant->getEquipe()->currentSalle();

            Commande::create([
                'etudiant_id' => $user->etudiant->id,
                'salle_id' => $salle->id,
                'collation_id' => $request->collationId
            ]);

            $response = [
                'status' => true,
                'message' => "ok",
            ];
        }

        return response()->json($response);

    }
}
