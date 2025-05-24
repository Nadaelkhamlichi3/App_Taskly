<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Member;
use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Affiche les tâches liées à un projet spécifique
    public function index($project_id)
{
    // 1. Récupération sécurisée du projet avec vérification d'appartenance
    $project = Board::where('id', $project_id)
                  ->where('user_id', Auth::id()) // Sécurité supplémentaire
                  ->firstOrFail();

    // 2. Récupération des tâches avec eager loading
    $tasks = Task::with('assignedMember')
                ->where('project_id', $project_id)
                ->orderBy('created_at', 'desc')
                ->get();

    // 3. Récupération des membres (à filtrer selon besoin)
    $members = Member::where('user_id', Auth::id())->get();

    // 4. Gestion des messages pour cas particuliers
    $message = null;
    if ($tasks->isEmpty()) {
        $message = "Ce projet ne contient aucune tâche pour le moment.";
    }

    return view('dashboard', [
        'project' => $project,
        'tasks' => $tasks,
        'members' => $members,
        'emptyMessage' => $message
    ]);
}

    // Enregistre une nouvelle tâche
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'member_id' => 'required|exists:members,id_member',
            'project_id' => 'required|exists:boards,id_projet',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'member_id' => $request->member_id,
            'project_id' => $request->project_id,
            'status' => 'ToDo', // cohérent avec enum ou logique de statut
        ]);

        return redirect()->back()->with('success', 'Tâche créée avec succès.');
    }


    public function edit($id)
    {
        $task = Task::with(['project', 'assignedMember'])->findOrFail($id);
        $members = Member::all();
        return view('tasks.edit', compact('task', 'members'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
    
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:todo,doing,done',
            'due_date' => 'required|date',
            'member_id' => 'nullable|exists:members,id_member'
        ]);
    
        $task->update($validated);
    
        return redirect()->back()
            ->with('success', 'Task updated successfully');
    }


    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back()->with('success', 'Tâche supprimée avec succès.');
    }

    public function updateStatus(Request $request, $id){
        $task = Task::findOrFail($id);
        $task->status = $request->input('status');
        $task->save();
        return response()->json(['message' => 'Status updated successfully']);
    }
    
    public function showMemberTasks($projectId, $memberId){
        $project = Board::findOrFail($projectId);
        $member = Member::findOrFail($memberId);


        if (!$project->members->contains($member)) {
            abort(403, 'Ce membre ne fait pas partie de ce projet.');
        }

        // Récupère les tâches du membre dans ce projet
        $tasks = Task::where('project_id', $projectId)
            ->where('member_id', $memberId)
            ->get();

        return view('tasks.member_tasks', compact('tasks', 'member', 'project'));
    }
}
