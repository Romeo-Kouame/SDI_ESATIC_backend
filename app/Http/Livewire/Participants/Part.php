<?php

namespace App\Http\Livewire\Participants;

use App\Models\Equipe;
use App\Models\Etudiant;
use App\Models\Hackaton;
use App\Models\Participant;
use App\Models\Qsession;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Part extends Component
{

    public $etudiant_id = 0;
    public $equipe_id = 0;
    public $chef = 0;
    public $matricule;
    public $nom;
    public $prenom;
    public $email;
    public $classe;
    public function render()
    {
        return view('livewire.participants.part', [
            'etudiants' => Etudiant::all(),
            'equipes' => Equipe::all()
        ]);
    }

    public function add(){

        Participant::create([
            'etudiant_id' => $this->etudiant_id,
            'equipe_id' => $this->equipe_id,
            'hackaton_id' => Hackaton::where('inscription', 1)->first()->id,
            'chef' => $this->chef == 1 ? true : false
        ]);

        return redirect()->back();
    }

    public function putChef(){
        $pa = Participant::where('etudiant_id', $this->etudiant_id)->first();
        $pa->chef = true;
        $pa->save();

        return redirect()->back();
    }

    public function create(){
        $u = User::where('email', $this->email)->first();

        Etudiant::create([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'matricule' => $u->name,
            'classe' => $this->classe,
            'genre' => 'Masculin',
            'user_id' => $u->id
        ]);

        return redirect()->back();
    }

    public function openSession(){
        $qs = Qsession::where('equipe_id', $this->equipe_id)->first();

        $qs->state = 0;
        $qs->score = 0;
        $qs->save();
    }
}
