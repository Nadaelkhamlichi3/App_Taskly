<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BoardMemberController;
use App\Http\Controllers\ContactUsManager;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\BoardInvitationController;
use App\Http\Controllers\SearchController;

use App\Models\Member;
use App\Models\Board;
use App\Models\Task;

use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'showHome'])->name('welcome');

// Authentification
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('signup.submit');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signupInvi', [AuthController::class, 'showRegister'])->name('register');
Route::post('/signupInvi', [AuthController::class, 'register'])->name('register.submit');

Route::post('/contact-us', [ContactUsManager::class, 'contactPost'])->name('contact.submit');

// Route spéciale pour les invitations
Route::get('/projects/accept-invitation/{token}', [BoardInvitationController::class, 'acceptInvitation'])->name('board.acceptInvitation');

// Routes protégées
Route::middleware(['auth'])->group(function () {

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.user');
    Route::get('/dashboard/{id}', [DashboardController::class, 'showProject'])->name('boards.show');

    //DashBoard pour Le membre invite
    Route::get('/dashboard/project/{project_id}', [DashboardController::class, 'projectDashboard'])->name('dashboard.project');
    Route::get('/projects/{project}/{member}', [TaskController::class, 'showMemberTasks'])->name('tasks.member');
    
    // Board routes
    Route::get('/boards/create', [BoardController::class, 'create'])->name('boards.create');
    Route::post('/boards', [BoardController::class, 'store'])->name('boards.store');
    Route::get('/boards/{board}/invite', [BoardMemberController::class, 'showInviteForm'])->name('boards.invite');
    Route::post('/boards/{board}/invite', [BoardMemberController::class, 'invite'])->name('boards.invite.member');

    // Task routes
    Route::get('/projects/{project}/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/{id}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

    // Member routes
    Route::delete('/projects/{project}/members/{member}', [BoardMemberController::class, 'removeMember'])
        ->name('projects.members.remove');
    Route::get('/profil/{id}', [MemberController::class, 'showprofil'])->name('profil');
    Route::get('/settings', [MemberController::class, 'settings'])->name('member.settings');
    Route::post('/settings/update', [MemberController::class, 'update'])->name('member.settings.update');

    // Error route
    Route::get('/error', function () {
        return view('error'); 
    })->name('error.page');
});
?>
