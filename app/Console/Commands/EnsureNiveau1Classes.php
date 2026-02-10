<?php

namespace App\Console\Commands;

use App\Models\Classe;
use App\Models\Niveau;
use Illuminate\Console\Command;

class EnsureNiveau1Classes extends Command
{
    protected $signature = 'classes:ensure-niveau1';

    protected $description = 'Crée les 7 classes manquantes pour le Niveau 1 (par libellé)';

    public function handle()
    {
        $niveau = Niveau::where('libelle', 'Niveau 1')->first();

        if (!$niveau) {
            $this->error('Aucun niveau avec le libellé "Niveau 1" en base. Exécutez d\'abord: php artisan db:seed --class=AdminSeeder');
            return 1;
        }

        $expected = ['ENTD', 'SRIT 1A', 'SRIT 1B', 'SRIT 1C', 'TWIN 1', 'MP2I A', 'MP2I B'];
        $before = Classe::where('niveau_id', $niveau->id)->count();

        $this->info("Niveau 1 trouvé (id={$niveau->id}). Classes actuelles pour ce niveau: {$before}");

        foreach ($expected as $libelle) {
            Classe::firstOrCreate(
                [
                    'libelle' => $libelle,
                    'niveau_id' => $niveau->id
                ],
                ['esatic' => true]
            );
        }

        $after = Classe::where('niveau_id', $niveau->id)->count();
        $this->info("Classes pour Niveau 1 après mise à jour: {$after}");
        $this->info("ID du Niveau 1 à utiliser côté frontend: {$niveau->id}");

        if ($after < 7) {
            $this->warn("Il reste moins de 7 classes. Vérifiez les doublons ou contraintes en base.");
        } else {
            $this->info('Niveau 1 a bien 7 classes.');
        }

        return 0;
    }
}
