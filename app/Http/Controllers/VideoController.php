<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipe;
use Illuminate\Support\Facades\Storage;
use Nette\Utils\FileSystem;
use Svg\Gradient\Stop;

class VideoController extends Controller
{
    public function uploadVideo(Request $request)
    {

        $path = Storage::disk('public')->put('videos', $request->video);

        $team = Equipe::find($request->equipe_id);
        $team->video_url = $path;
        $team->save();

        return view('dashboard');
    }

    public function downloadVideo(Request $request)
    {
        $ext = '.' . substr(strrchr($request->url, '.'), 1);
        $filename = str_replace(' ', '', Equipe::where('id', $request->equipe_id)->first()->nom) . $ext;
        return Storage::download($request->url, $filename);
    }
}
