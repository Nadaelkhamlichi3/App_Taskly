<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function create(){
        return view('boards.create');
    }

    public function store(Request $request) {
        $board = Board::create([
            'title_projet' => $request->title_projet,
            'description_projet' => $request->description_projet,
            'budget' => $request->budget,
            'delai' => $request->delai,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('boards.invite', ['board' => $board->id_projet]);
    }

    public function show($id)
    {
        $board = Board::with(['members', 'tasks'])->findOrFail($id);
        return view('boards.show', compact('board'));
    }

    public function edit($id)
    {
        $board = Board::findOrFail($id);
        return view('boards.edit', compact('board'));
    }

    public function update(Request $request, $id)
    {
        $board = Board::findOrFail($id);

        $board->update($request->only([
            'title_projet',
            'description_projet',
            'budget',
            'delai',
        ]));

        return redirect()->route('boards.show', $board->id_projet);
    }

    public function destroy($id)
    {
        $board = Board::findOrFail($id);
        $board->delete();

        return redirect()->route('boards.index');
    }
    public function getProjectTasks($projectId)
    {
        $project = Board::with(['tasks' => function($query) {
            $query->with(['assignedMember', 'comments'])
                ->orderByRaw("FIELD(status, 'todo', 'doing', 'done')")
                ->orderBy('due_date');
        }])->findOrFail($projectId);

        return response()->json([
            'success' => true,
            'html' => view('tasks.modal-content', [
                'project' => $project,
                'tasks' => $project->tasks->groupBy('status')
            ])->render()
        ]);
    }

}
