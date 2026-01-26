<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Espace SDI') }}
        </h2>
    </x-slot>
    {{--
    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
     --}}
    <div class="gap-4 px-6 py-12 md:grid md:grid-cols-6">


        <div class="col-span-2 ">

            <div class="px-4 py-6 text-md bg-white shadow-xl sm:rounded-lg">
                @if(Auth::user()->etudiant)
                <p class="text-xl font-bold text-center ">
                    EQUIPE:
                    <span class="text-orange">
                        {{(Auth::user()->etudiant->currentEquipe()->nom)}}
                    </span>
                </p>
                <p class="pt-2">
                    cette equipe est enregistée pour le {{(Auth::user()->etudiant->currentEquipe()->libelle)}}
                </p>
                <p class="pt-4 ">
                    <span class="font-bold text-gray-600 underline"> Informations sur les membres </span>


                    @foreach (Auth::user()->etudiant->getEquipe()->participants as $participant)

                <p class="py-3">

                    <span class="font-bold text-orange text-md"> {{$participant->etudiant->matricule}} >> </span>
                    <br>
                    {{$participant->etudiant->nom}} {{$participant->etudiant->prenom}}
                    <span class="txt-md">({{$participant->etudiant->user->email}} )</span>

                </p>
                @endforeach


                </p>

                @else
                <p class="text-xl font-bold text-center ">
                    Bienvenue:
                    <br>
                    <span class="text-orange">
                        Bienvenue chèr(e) administrateur sur votre espace
                    </span>
                </p>
                @endif


            </div>

        </div>

        <div class="col-span-2 text-center">

            @if(Auth::user()->etudiant)


            <div class="px-4 py-6 text-xl bg-white shadow-xl sm:rounded-lg">
                @if(Auth::user()->etudiant->getEquipe()->statut == 0)

                @if(Auth::user()->etudiant->getEquipe()->niveau->quiz_available == 1)

                @if(Auth::user()->etudiant->getEquipe()->qsession->quiz->state == 1)

                @if(Auth::user()->etudiant->getEquipe()->qsession->state == 0 && Auth::user()->etudiant->getEquipe()->qsession->score == 0)

                <p class="font-bold text-center text-md">
                    Le quiz des préselections est ouvert !
                </p>
                <p class="text-center mt-4">
                    Allez dans l'espace <span class="font-bold text-orange">Présélection</span> de votre chef d'équipe pour commencer le test.
                </p>

                @elseif(Auth::user()->etudiant->getEquipe()->qsession->state == 1 && Auth::user()->etudiant->getEquipe()->qsession->score > 0)

                <p class="font-bold text-center text-md">
                    Vous avez terminé le quiz. <br> Les résultats seront bientôt disponibles, veillez patienter !
                </p>

                @endif

                @else

                @if(Auth::user()->etudiant->getEquipe()->qsession->state == 0)

                <p class="font-bold text-center text-md">
                    Les quizs sont fermés.
                </p>

                @elseif(Auth::user()->etudiant->getEquipe()->qsession->state == 1 && Auth::user()->etudiant->getEquipe()->qsession->score > 0)

                <p class="font-bold text-center text-md">
                    Vous avez terminé le quiz. <br> Les résultats seront bientôt disponibles, veillez patienter !
                </p>

                @elseif(Auth::user()->etudiant->getEquipe()->qsession->score < 0) <img src=" {{asset('images/app/lose.svg')}} " class="loseLogo">
                    <p class="font-bold text-center text-red-600 text-md">
                        Dommage, la prochaine fois sera la bonne !
                    </p>

                    @endif

                    @endif

                    @else

                    <p class="text-center">

                        Chèr capitaine, vous devez vous munir avec votre équipe de <span class="text-red-600 font-bold">documents</span> attestants que vous êtes inscrits pour
                        des cours en Master au cours de cette année scolaire (reçu d'inscription, certificat de
                        fréquentation, certificat de scolarité, etc...) et éventuellement d'une pièce d'identité. Ils
                        seront controlés le <span class="text-red-600 font-bold">Jeudi 26 Janvier</span>, jour de lancement du Tecknovore Hackathon.
                    </p>

                    @endif

                    @else

                    <img src=" {{asset('images/app/winner.svg')}} " class="winLogo">
                    <p class="font-bold text-green-600 text-center text-red-600 text-md">
                        Félicitations votre équipe est séléctionnée !!
                    </p>

                    @endif
            </div>

            @else

            <img src=" {{asset('images/app/secure.svg')}} " class="WineLogo">

            @endif

        </div>

        <div class="col-span-2 ">

            <div class="px-4 py-6 bg-white shadow-xl sm:rounded-lg">

                <p class="font-bold text-center text-xl">
                    Bienvenu(e) {{Auth::user()->etudiant->nom ?? Auth::user()->name }} sur ton espace SDI
                </p>
                <p class="pt-2 text-xl">
                    Cet espace te permettra de consulter les résultats et de consulter les informations relatives à ton groupe.
                </p>
                <p class="pt-4 text-xl">
                    <span class="font-bold text-orange"> HackEat >> </span> est l'espace te permettant d'avoir accès à la restauration de l'hackathon.
                    Il faut noter que pour toute personne sélèctionnée la restauration sera assurée les :
                <ul class="font-bold text-gray-500 text-xl">
                    <li> Vendredi et Samedi | matin, midi et soir </li>
                    <li> Dimanche | matin et midi </li>
                </ul>
                </p>


                <p class="pt-4 text-xl">
                    <span class="font-bold text-orange"> HackNight >> </span> est l'espace te permettant d'avoir accès aux collations relatives à l'hackaton.
                    Il est bon de noter que pour toute personne sélèctionnée les collations seront mise a votre disposition le vendredi et le samedi aux heures suivantes
                    <span class="font-bold text-gray-500">
                        22h30 | 00h30 | 03h30
                    </span>
                </p>

            </div>

        </div>

    </div>
</x-app-layout>
<!-- <img src=" {{asset('images/app/lose.svg')}} " class="loseLogo"> -->