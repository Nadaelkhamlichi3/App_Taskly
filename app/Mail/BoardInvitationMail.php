<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BoardInvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitationUrl;
    public $boardName;
    public $name;
    public $role;
    public $user_name;

    public function __construct($invitationUrl, $boardName, $name, $role, $user_name)
    {
        $this->invitationUrl = $invitationUrl;
        $this->boardName = $boardName;
        $this->name = $name;
        $this->role = $role;
        $this->user_name = $user_name;
    }

    public function build()
    {
        return $this->subject('Invitation à rejoindre le projet ' . $this->boardName)
                    ->markdown('emails.board_invitation')
                    ->with([
                        'invitationUrl' => $this->invitationUrl,
                        'boardName' => $this->boardName,
                        'name' => $this->name,
                        'role' => $this->role,
                        'user_name' => $this->user_name,
                    ]);
    }
}
