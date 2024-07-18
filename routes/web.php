<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});




Route::get('/', function () {
  return view('welcome');
});
Route::group(['middleware' => 'guest'], function () {
  Route::get('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
Route::group(['middleware' => 'auth:webb'], function () {
Route::get('/home', [HomeController::class, 'index']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});



Route::group(['middleware' => 'auth:webb'], function () {
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

// Show the form for creating a new project
Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');

// Store a newly created project in the database
Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

// Show the form for editing a specific project
Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');

// Update a specific project in the database
Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');

// Delete a specific project from the database
Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
});


//route for tasks 

Route::group(['middleware' => 'auth:webb'], function () {
  Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
  
  // Show the form for creating a new project
  Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
  
  // Store a newly created project in the database
  Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
  
  // Show the form for editing a specific project
  Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
  
  // Update a specific project in the database
  Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
  
  // Delete a specific project from the database
  Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
  });