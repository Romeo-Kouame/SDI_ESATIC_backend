@component('mail::message')

# {{ $data['title'] }}

Bonjour {{ $data['nom'] }} !

Le bureau du C2E tient à vous remercier pour votre participation au Technovore Hackathon.

Nous désirons par ce mail féliciter votre équipe {{ $data['equipe'] }} pour votre qualification.

Dans la même veine nous desirons vous inviter à rejoindre le groupe WhatsApp d'informations en cliquant sur le button ci-dessous.

@component('mail::button', ['url' => 'https://chat.whatsapp.com/JK5sFrSt3V0JoBNrHJOhMl?mode=gi_t'])
Rejoindre
@endcomponent

Rendez-vous très bientôt ! 
Cordialement,<br>

Le Bureau du C2E.


@component('mail::button', ['url' => 'https://sdi-hackathon23.c2e.ci/'])
Se connecter
@endcomponent


@endcomponent


