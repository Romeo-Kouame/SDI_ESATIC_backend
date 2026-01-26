<?php

namespace App\Http\Livewire\Participants;

use App\Models\Equipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Video extends Component
{

    use WithFileUploads;
    public $video;
    public $video_url;

    protected $listeners = [
        'addVideo'
    ];

    public function render()
    {
        return view('livewire.participants.video');
    }

    public function addVideo($url)
    {

        $equipe_id = Auth::user()->etudiant->getEquipe()->id;

        $team = Equipe::find($equipe_id);
        $team->video_url = $url;
        $team->save();

        return redirect()->route('dashboard');
    }
}
