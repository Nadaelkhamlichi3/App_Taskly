<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Board; // ou Project selon votre modèle
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        

        $currentProject = $request->input('id') ?? session('current_project_id');

        $query = $request->input('query');
        
        if (empty($query)) {
            return back()->with('warning', 'Veuillez entrer un terme de recherche');
        }
        
        if (!$currentProject) {
            return back()->with('error', 'Aucun projet sélectionné');
        }
        
        // Recherche des tâches dans le projet actuel
        $tasks = Task::where('project_id', $currentProject)
                    ->where(function($q) use ($query) {
                        $q->where('title', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%");
                    })
                    ->get();
        
        // Recherche des membres dans le projet actuel
        $project = Board::with('members')->find($currentProject);
        
        if (!$project) {
            return back()->with('error', 'Projet non trouvé');
        }
        
        $members = $project->members()
                    ->where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('email', 'LIKE', "%{$query}%");
                    })
                    ->get();
        
        return view('search.results', [
            'tasks' => $tasks,
            'members' => $members,
            'query' => $query,
            'project' => $project
        ]);
    }
}