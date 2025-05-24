<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Board;
use App\Models\Task;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Récupérer tous les projets de l'utilisateur avec leurs tâches et membres
        $projects = Board::with(['tasks.assignedMember', 'members'])
                        ->where('user_id', $userId)
                        ->get();

        // Si aucun projet, afficher la vue avec un message
        if ($projects->isEmpty()) {
            return view('dashboard', [
                'projects' => collect(),
                'allProjects' => collect()
            ]);
        }

        $currentProject = $projects->first();

        return view('dashboard', [
            'projects' => $projects->take(1), // Afficher seulement le premier projet
            'allProjects' => $projects,// Pour la liste dans le modal
            'currentProject' => $currentProject
        ]);
    }

    public function showProject($id)
    {
        $userId = Auth::id();

        // Vérifier que le projet appartient bien à l'utilisateur
        $project = Board::with(['tasks.assignedMember', 'members'])
                       ->where('id_projet', $id)
                       ->where('user_id', $userId)
                       ->firstOrFail();

        // Récupérer tous les projets pour la liste dans le modal
        $allProjects = Board::where('user_id', $userId)->get();

        return view('dashboard', [
             'project' => $project,
            'projects' => collect([$project]), // Afficher le projet sélectionné
            'allProjects' => $allProjects
        ]);
    }

    public function projectDashboard($project_id){
        $user = Auth::user();

        // Le "projet" est en fait un board
        $project = Board::with('members')->findOrFail($project_id);

        // Tous les projets/boards de l'utilisateur
        $boards = Board::where('user_id', $user->id)->get();

        // Les tâches de ce projet
        $tasks = Task::where('project_id', $project->id_projet)->get();

        // Les membres de ce projet
        $members = $project->members;


        $member = Member::where('email', $user->email)->first();

        return view('dashboardInvite', [
            'project' => $project,
            'boards' => $boards,
            'tasks' => $tasks,
            'members' => $members,
            'member' => $member,
            'currentProjectId' => $project_id,
       ]);
    }
}
