<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Member;
use App\Models\BoardInvitation;

class AuthController extends Controller{

    public function showHome(){
        return view('welcome'); // => retourne la page d acceuil
    }

    public function showLoginForm(){
        return view('auth.loginpage'); // => retourne la vue loginpage.blade.php
    }

    public function  showFirstProject(){
        return view('create_board');
    }

    public function showSignupForm(){
        return view('auth.signuppage'); // => retourne la vue signuppage.blade.php
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Cet email n\'est pas enregistré.',
            ]);
        }

        // Vérifier le mot de passe
        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Mot de passe incorrect.',
            ]);
        }

        // Connexion de l'utilisateur
        Auth::login($user);
        
        return redirect()->route('dashboard.user', ['id' => $user->id]);
    }

    public function signup(Request $request){
        // Validation des données d'inscription
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8', 
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hashage du mot de passe
        ]);

        // Connexion automatique de l'utilisateur après inscription
        Auth::login($user);

        // Redirige vers la création de projet
        return redirect()->route('boards.create');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegister(Request $request)
    {
        // Vérifier si un token est passé dans l'URL
        $token = $request->query('token');

        // Vérifier si le token est valide
        $invitation = BoardInvitation::where('token', $token)->first();
        if (!$invitation) {
            return redirect('/')->with('error', 'Invitation invalide.');
        }

        return view('auth.register', compact('token'));
    }

    public function register(Request $request)
{
    // Validation
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ]);

    // Création de l'utilisateur
    $user = User::create([
        'username' => $validated['username'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
    ]);

    Auth::login($user);

    if ($request->filled('token')) {
        $invitation = \App\Models\BoardInvitation::where('token', $request->token)->first();

        if ($invitation) {
            $board = $invitation->project;

            if ($board) {
                $alreadyMember = $board->members()->where('members.email', $request->email)->exists();

                if (!$alreadyMember) {
                    $board->members()->attach($user->id, ['role' => $invitation->role]);
                }

                $invitation->delete();

                return redirect()->route('dashboard.project', ['project_id' => $board->id_projet]);
            }
        }
    }
}
}