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
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');

	Route::get('user-management', function () {
		return view('laravel-examples/user-management');
	})->name('user-management');

	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

	Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

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
		return view('dashboard');
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


Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store');
// Routes for Organizations
Route::middleware(['auth'])->group(function () {
	Route::get('/organizations', [OrganizationController::class, 'create'])->name('organizations.create');
	Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit');
	Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update');
	Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy');
});

// Routes for Teams
Route::middleware(['auth', 'can:createTeam,organization'])->group(function () {
	Route::get('/organizations/{organization}/teams/create', [TeamController::class, 'create'])->name('teams.create');
	Route::post('/organizations/{organization}/teams', [TeamController::class, 'store'])->name('teams.store');
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
	Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
	Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
	Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});
