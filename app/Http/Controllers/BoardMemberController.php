<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;
use App\Models\Member;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\BoardInvitation;
use App\Mail\BoardInvitationMail;



class BoardMemberController extends Controller
{
    public function showInviteForm($id)
    {
        //récupère le projet dans la base de données avec l’ID donné.
        $board = Board::findOrFail($id);
        //passe l’objet $board à la vue invite.blade.php.
        return view('boards.invite', compact('board'));
    }

    public function invite(Request $request, $id)
    {
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'role' => 'required|string|max:255',
    ]);

    $board = Board::findOrFail($id);

    // Créer ou récupérer un membre
    $member = Member::firstOrCreate(
        ['email' => $request->email],
        ['name' => $request->name, 'role' => $request->role]
    );

    // Lier le membre au projet
    $board->members()->syncWithoutDetaching([$member->id_member]);

    // Générer un token unique
    $token = Str::uuid();

    // Créer une invitation dans la table 'board_invitations'
    BoardInvitation::create([
        'board_id' => $board->id_projet, // ou $board->id selon ta table
        'email' => $request->email,
        'name' => $request->name,
        'role' => $request->role,
        'token' => $token,
    ]);

    // Générer l'URL d'invitation
    $invitationUrl = route('board.acceptInvitation', ['token' => $token]);

    // Récupérer le nom de l’utilisateur qui envoie l’invitation
    $userName = Auth::user()->name;

    // Envoyer l’e-mail d’invitation
    Mail::to($request->email)->send(
        new BoardInvitationMail($invitationUrl, $board->title_projet, $request->name, $request->role, $userName)
    );

    return redirect()->back()->with('success', 'Member invited successfully!');
}
public function removeMember(Board $project, Member $member)
{
    // Vérification que l'utilisateur est bien le propriétaire du projet
    if ($project->user_id !== Auth::id()) {
        abort(403, 'Action non autorisée.');
    }

    // Supprimer toutes les tâches assignées à ce membre dans ce projet
    Task::where('project_id', $project->id_projet)
        ->where('member_id', $member->id_member)
        ->delete();

    // Détacher le membre du projet
    $project->members()->detach($member->id_member);

    return redirect()->back()
        ->with('success', 'Le membre et ses tâches associées ont été supprimés avec succès.');
}
}

