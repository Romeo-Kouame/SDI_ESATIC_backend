<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'App\Http\Controllers\AdminController@welcome')->name('welcome');

// Route::get('/loading', function () {
//     return view('participants.encours');
// })->name('encours');

// Route::get('/inscription-terminer', function () {
//     return view('terminer');
// })->name('terminer');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/preselection', function () {
    return view('participants.preselection');
})->name('preselection');

Route::middleware(['auth:sanctum', 'verified'])->post('/dashboard/up', [VideoController::class, 'uploadVideo'])->name('uploadvideo');



// Les routes relatives à la partie de l'administration

// Parametrage des Hackatons

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/restauration', 'App\Http\Controllers\AdminController@restauration')->name('restauration');
    Route::post('/commander', 'App\Http\Controllers\AdminController@getCommandes')->name('get.commande');



    Route::group(['middleware' => ['role:Super@Administrateur']], function () {

        Route::get('/admin/parametres',  'App\Http\Controllers\AdminController@index')->name('Admin.parametres.index');
        Route::get('/admin/groupes',  'App\Http\Controllers\AdminController@selectionGroupe')->name('Admin.groupe.selection');
        Route::get('/admin/groupes/down', [VideoController::class, 'downloadVideo'])->name('Admin.groupe.downloadvideo');
        Route::get('/admin/impression',  'App\Http\Controllers\AdminController@impression')->name('Admin.groupe.impression');
        Route::get('/admin/restauration',  'App\Http\Controllers\AdminController@gestionRestaurant')->name('Admin.restauration');
        Route::get('/admin/etudiants', 'App\Http\Controllers\AdminController@participantAddView')->name('Admin.participantAdd');

        Route::get('/pdf/listeEquipe/niveau1', 'App\Http\Controllers\pdfController@listeEquipeN1')->name('liste.equipe.n1');
        Route::get('/pdf/listeEquipe/niveau2', 'App\Http\Controllers\pdfController@listeEquipeN2')->name('liste.equipe.n2');
        Route::get('/pdf/listeEquipe/niveau3t', 'App\Http\Controllers\pdfController@listeEquipeN3T')->name('liste.equipe.n3t');
        Route::get('/pdf/listeEquipe/niveau3i', 'App\Http\Controllers\pdfController@listeEquipeN3I')->name('liste.equipe.n3i');
        Route::get('/pdf/listeEquipe/niveau3s', 'App\Http\Controllers\pdfController@listeEquipeN3S')->name('liste.equipe.n3s');

        Route::get('/pdf/listeEquipe/selection/niveau1', 'App\Http\Controllers\pdfController@listeselectEquipeN1')->name('liste.equipe.select.n1');
        Route::get('/pdf/listeEquipe/selection/niveau3t', 'App\Http\Controllers\pdfController@listeselectEquipeN3T')->name('liste.equipe.select.n3t');
        Route::get('/pdf/listeEquipe/selection/niveau3i', 'App\Http\Controllers\pdfController@listeselectEquipeN3I')->name('liste.equipe.select.n3i');
        Route::get('/pdf/listeEquipe/selection/niveau3s', 'App\Http\Controllers\pdfController@listeselectEquipeN3S')->name('liste.equipe.select.n3s');
        
        Route::get('/pdf/repartitions/equipes', 'App\Http\Controllers\pdfController@repartition')->name('pdf.repartition');
        Route::get('/pdf/salles/commandes', 'App\Http\Controllers\pdfController@commandes')->name('pdf.commandes');
        //qrcode 
        
        Route::post('/admin/restauration/soumission', 'App\Http\Controllers\AdminController@Soumission')->name('qrcode.Soumission');
        Route::post('/admin/sendMail', 'App\Http\Controllers\AdminController@ContacterLesChefs')->name('selection.sendmail');
    });
});

Route::get('/pdf/listeEquipe/selection/niveau2', 'App\Http\Controllers\pdfController@listeselectEquipeN2')->name('liste.equipe.select.n2');

// les participants

Route::get('/inscriptions', 'App\Http\Controllers\AdminController@inscription')->name('Participants.inscription');
Route::get('/inscription-terminer', 'App\Http\Controllers\AdminController@inscriptionterminer')->name('terminer');
Route::get('/fin-preselections', 'App\Http\Controllers\AdminController@finPreselection')->name('finPreselection');



//Route::get('/registrer', ) ;
