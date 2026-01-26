<div>

    <div>

        <select id="etudiant_id" name="etudiant_id" wire:model='etudiant_id'>

            <option vlaue=0>--Etudiant--</option>
            @foreach ($etudiants as $etudiant)
            <option value="{{$etudiant->id}}">
                {{$etudiant->id}}
            </option>
            @endforeach

        </select>

        <select id="equipe_id" name="equipe_id" wire:model='equipe_id'>

            <option vlaue=0>--Equipe--</option>
            @foreach ($equipes as $equipe)
            <option value="{{$equipe->id}}">
                {{$equipe->id}}
            </option>
            @endforeach

        </select>

        <select id="is_chef" name="is_chef" wire:model='chef'>

            <option vlaue="1">Chef</option>
            <option vlaue="0">Not chef</option>

        </select>

        <button class="px-4 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer bg-orange text-white hover:shadow" wire:click="add()">Click here</button>

    </div>

    <div>

        <select id="etudiant_id" name="etudiant_id" wire:model='etudiant_id'>

            <option vlaue=0>--Etudiant--</option>
            @foreach ($etudiants as $etudiant)
            <option value="{{$etudiant->id}}">
                {{$etudiant->id}}
            </option>
            @endforeach

        </select>

        <button class="px-4 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer bg-orange text-white hover:shadow" wire:click="putChef()">Click here</button>


    </div>


    <div>
        <input type="text" placeholder="Nom" wire:model="nom" />
        <input type="text" placeholder="Prenom" wire:model="prenom" />
        <input type="email" placeholder="Email" wire:model="email" />
        <input type="text" placeholder="Classe" wire:model="classe" />
        <button class="px-4 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer bg-orange text-white hover:shadow" wire:click="create()">Click here</button>

    </div>

    <div>
        <select id="equipe_id" name="equipe_id" wire:model='equipe_id'>

            <option vlaue=0>--Equipe--</option>
            @foreach ($equipes as $equipe)
            <option value="{{$equipe->id}}">
                {{$equipe->nom}}
            </option>
            @endforeach

        </select>

        <button class="px-4 py-2 text-sm font-bold uppercase border rounded-md cursor-pointer bg-orange text-white hover:shadow" wire:click="openSession()">Click here</button>

    </div>

</div>