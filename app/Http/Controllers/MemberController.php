<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Board;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class MemberController extends Controller
{
    public function index()
    {
        $members = Member::all();
        return view('members.index', compact('members'));
    }

    public function invite(Board $board){
        return view('invite_members', compact('board'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:members,email',
            'role' => 'required|string',
            'project_id' => 'required|exists:projects,id',
        ]);

        $member = Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        $board = Board::find($request->board_id);
        $board->members()->attach($member->id);

        return redirect()->back()->with('success', 'Member invited successfully!');
    }

    public function show($id)
    {
        $member = Member::with('boards')->findOrFail($id);
        return view('members.show', compact('member'));
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index');
    }

    public function showprofil()
    {
        $user = Auth::user();
        return view('member.profile', compact('user'));
    }


    public function update(Request $request){
        $user = Auth::user();

        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user->username = $validatedData['username'];
        $user->email = $validatedData['email'];

        if (!empty($validatedData['password'])) {
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        return redirect()->route('member.settings')->with('success', 'Paramètres mis à jour avec succès');
    }
    
    public function settings()
    {
        $user = Auth::user();
        return view('member.settings', compact('user'));
    }
}
