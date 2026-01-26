<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Joueur;
use App\Models\Question;
use App\Models\Response;


class GameController extends Controller
{
    public function question_aleatoire(Request $request)
    {
        $questions = Question::all()->toArray();

        $cle = array_rand($questions);

        $question = $questions[$cle];
        $responses = $responses = Question::find($question['id'])->responses;
        $data = [];
        $choices = [];
        $correctanswer = '';

        foreach ($responses as $res) {
            array_push($choices, $res->content);
            if ($res->score > 0)
                $correctanswer = $res->content;
        }

        array_push(
            $data,
            [
                'correctAnswer' => $correctanswer,
                'question' => $question['content'],
                'choices' => $choices,
            ]
        );

        $joueur = Joueur::where('id_joueur', $request->joueurId)->first();
        
        $response = $joueur ? [
            "data" => [
                'question' => $data,
                'date' => $joueur->updated_at
            ],
            "status" => true
        ] : [
            "data" => [
                'question' => $data,
                'date' => null
            ],
            "status" => true
        ];


        return response()->json($response);
    }

    /*
{
    'joueurId' => id du joueur,
}
*/
    public function infos_user(Request $request)
    {
        if ($request->is_connected === true) {
            $joueur = Joueur::where('id_joueur', $request->joueurId)->first();

            $response = [
                "data" => [
                    "nom" => $joueur->nom,
                    "score" => $joueur->score
                ],
                "status" => true
            ];

        } else {

            $response = [
                "status" => false
            ];

        }
        return response()->json($response);
    }

    public function renderjoueurs()
    {
        $joueurs = Joueur::orderBy('score', 'DESC')->get();

        $response = [
            "status" => true,
            "data" => $joueurs
        ];

        return response()->json($response);

    }

    /*
    {
        'joueurId' => id du joueur,
        'joueurNom' => nom du joueur au cas où il est là pour la première fois,
        'score' => score du joueur,
    }
    */
    public function validate_response(Request $request)
    {
        $joueur = Joueur::where('id_joueur', $request->joueurId)->first();

        if (!$joueur) {
            $joueur = Joueur::create([
                'id_joueur' => $request->joueurId,
                'nom' => $request->joueurNom,
            ]);
        }

        $joueur->score = $request->score;
        // $joueur->time = 15;
        $joueur->save();

        $response = [
            "messsage" => "Enregistrement effectué !",
            "status" => true
        ];

        return response()->json($response);
    }

    /*
    {
        'joueurId' => id du joueur,
    }
    */
    public function resettime(Request $request)
    {
        $joueur = Joueur::where('id_joueur', $request->joueurId)->first();

        if (!$joueur) {
            $response = [
                "messsage" => "Joueur introuvable",
                "status" => false
            ];
        } else {

            $joueur->time = 0;
            $joueur->save();

            $response = [
                "messsage" => "Ok",
                "status" => true
            ];
        }


        return response()->json($response);
    }
}
