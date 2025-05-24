<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\BoardInvitation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BoardInvitationController extends Controller
{
   public function acceptInvitation($token)
   {
        $invitation=BoardInvitation::where('token',$token)->firstOrFail();

        $invitedEmail = $invitation->email;
        $user = User::where('email',$invitedEmail)->first();

        if(!$user){
            return redirect()->route('register',['email' => $invitedEmail,'token' => $token]);
        }

        
        $board = $invitation->project;

        if (!$board) {
            return redirect()->route('error.page')->with('error', 'Le projet associé à cette invitation est introuvable.');
        }

        $alreadyMember = $board->members()->where('members.email', $invitedEmail)->exists();

        if (!$alreadyMember) {
            $board->members()->attach($user->id, ['role' => $invitation->role]);
        }

        $invitation->delete();

        Auth::login($user);
        
        return redirect()->route('dashboard.project', ['project_id' => $invitation->board_id])
            ->with('success', 'Invitation acceptée avec succès!');
    }


    public function show($board_id)
    {
        $project = Board::findOrFail($board_id);
        return view('projects.guest_view', compact('project'));
    }

}