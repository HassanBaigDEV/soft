<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use App\Models\Team;
use App\Models\Organization;

Route::group(['middleware' => 'auth'], function () {

	Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
	Route::get('/', [UserController::class, 'dashboard'])->name('dashboard');


	Route::get('profile', function () {
		$user = auth()->user();
		return view('profile', compact('user'));
	})->name('profile');

	Route::get('user-management', function () {
		$users = User::all();
		return view('laravel-examples/user-management', compact('users'));
	})->name('user-management');

	Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

	Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
	Route::get('/login', function () {
		$projects = Project::all();
		return view('dashboard', compact('projects'));
	})->name('sign-up');
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create']);
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

//routes for projects
Route::get('/login', function () {
	return view('session/login-session');
})->name('login');

// Routes for Organizations
Route::middleware(['auth'])->group(function () {
	Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
	// Route::delete('/organization/delete-member/{organizationId}/{userId}', [OrganizationController::class, 'deleteMember'])->name('organizations.delete-member');
	// Route::post('organizations/{organization}}', [OrganizationController::class, 'addMember'])->name('organizations.add-member');
	// Route::post('/organization/{organizationId}', [OrganizationController::class, 'leave'])->name('organizations.leave');
	// Remove a member from an organization

	Route::post('/organization/{organizationId}/add-member', [OrganizationController::class, 'addMember'])->name('organizations.add-member');
	Route::delete('/organization/{organizationId}/remove-member/{memberId}', [OrganizationController::class, 'removeMember'])->name('organizations.remove-member');

	Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create');
	Route::post('/organizations/join', [OrganizationController::class, 'join'])->name('organizations.join');
	Route::get('/organizations', [OrganizationController::class, 'view'])->name('organizations.view');
	Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
	Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
	Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
});

// Routes for Teams
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/organizations/teams', [TeamController::class, 'store'])->name('teams.store');
Route::middleware(['auth', 'can:createTeam,organization'])->group(function () {
});

Route::middleware(['auth',])->group(function () {
	Route::get('/project/create', [ProjectController::class, 'create'])->name('projects.create');
	Route::post('/project', [ProjectController::class, 'store'])->name('projects.store');
	Route::get('/teams', [TeamController::class, 'view'])->name('teams.view');
	Route::get('/teams/{team}/edit', [TeamController::class, 'edit'])->name('teams.edit');
	Route::put('/teams/{team}', [TeamController::class, 'update'])->name('teams.update');
	Route::delete('/teams/{team}', [TeamController::class, 'destroy'])->name('teams.destroy');
});

// Routes for Projects
Route::middleware(['auth', 'can:manageTasks,project'])->group(function () {
	// Route::get('/teams/{team}/projects/create', [ProjectController::class, 'create'])->name('projects.create');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/projects', [ProjectController::class, 'view'])->name('projects.view');
	Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
	Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
	Route::delete('/projects/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy');
	Route::get('/projects/{project}/tasks', [TaskController::class, 'view'])->name('tasks.index');
});

// Routes for Tasks
Route::get('/projects/{project}/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/projects/{project}/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::middleware(['auth', 'can:updateTask,task'])->group(function () {
});

// Route::delete('/projects/{project}/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::middleware(['auth'])->group(function () {
	Route::get('/tasks', [TaskController::class, 'show'])->name('tasks.show');
	Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
	Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
	Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});

// routes/web.php

Route::get('/users/search', [UserController::class, 'search'])->name('users.search');
