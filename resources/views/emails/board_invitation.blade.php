@component('mail::message')
# Bonjour {{ $name }},

Vous avez été invité à rejoindre le projet *{{ $boardName }}* en tant que *{{ $role }}*.

Cliquez sur le bouton ci-dessous pour accepter l'invitation :

@component('mail::button', ['url' => $invitationUrl])
Rejoindre le projet
@endcomponent

Si vous ne reconnaissez pas cette invitation, vous pouvez ignorer ce message.

Merci,  
L’équipe *Taskly*

@endcomponent
