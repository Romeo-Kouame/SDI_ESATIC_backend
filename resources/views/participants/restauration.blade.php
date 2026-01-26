<x-app-layout>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Espace Restauration SDI') }}
        </h2>
    </x-slot>


    <div class="gap-4 px-6 py-12 md:grid md:grid-cols-6">

        <div class="col-span-2 ">

            <div class="px-6 py-6  justify-center flex-col text-xl text-center bg-white shadow-xl sm:rounded-lg">


                <span>
                    {{$qrcode}}
                </span>

                <span class="font-bold py-4 text-orange">Code de restauration</span>
            </div>

        </div>

        <div class="col-span-4 py-6 text-center px-6">

            @if(Auth::user()->etudiant->is_chief())

            @foreach (Auth::user()->etudiant->getEquipe()->participants as $key => $participant)

            @if(!$participant->etudiant->Commande())

            <form method="POST" action="{{route('get.commande', null, false)}}">
                @csrf
                <input type="number" name="id" value="{{$participant->id}}" hidden>

                <div class="grid  md:grid-cols-6 gap-4">

                    <div class=" col-span-2 text-right font-semibold">
                        {{$participant->etudiant->nom}} {{$participant->etudiant->prenom}}
                    </div>

                    <div class=" col-span-4 text-left">
                        <div class="pt-0 mb-1">
                            <select name="{{'collation_etu'.$participant->id.'_id'}}" required class="relative md:w-96 w-full px-12 py-2 text-sm text-gray-600 placeholder-gray-400 bg-white border-gray-400 rounded outline-none form-select focus:border-coolGray-400 focus:outline-none focus:ring-coolGray-100">
                                <option value="">--Choix collation--</option>

                                @foreach ($collations as $collation)
                                <option value="{{$collation->id}}"> {{$collation->libelle}}</option>
                                @endforeach

                            </select>
                        </div>
                        <button type="submit" class="px-6 py-3 mb-1 mr-1 text-sm font-bold text-white uppercase transition-all duration-150 rounded shadow outline-none ease-linearbg-emerald-500 bg-myblue hover:shadow-lg focus:outline-none">
                            Enregistrer
                        </button>
                    </div>

                </div>

            </form>

            @else

            <p class="text-xl py-4 font-bold">
                {{$participant->etudiant->nom}} {{$participant->etudiant->prenom}} à commandé du
                <span class="text-orange">{{$participant->etudiant->Commande()->collation->libelle }}</span>
            </p>

            @endif

            @endforeach


            @else

            <img src=" {{asset('images/app/secure.svg')}} " class="WineLogo">

            @endif

        </div>



    </div>
</x-app-layout>