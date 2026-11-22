<?php

use App\Http\Controllers\UtilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\DashboardController;

Route::get('/', [UtilController::class, 'loadWelcome'])->name('welcome');


Route::get('/hello/{message}', function ($message) {
    return '<h1>Hello '.$message.'</h1>';
});

//rota de homepage
Route::get('/home', [UtilController::class, 'loadHomepage'])->name('home');


//rotas de users
Route::get('/users', [UserController::class, 'allUsers'])->name('users.all');
Route::get('/add-users', [UserController::class, 'addUsers']) ->name('users.add');


//rota de apagar users
Route::get('/delete-users/{id}', [UserController::class, 'deleteUsers'])->name('users.delete');


//rota para ver /editar users
Route::get('/edit-users/{id}', [UserController::class, 'editUsers'] )->name('users.edit')->middleware('auth');


//rota de registar users
Route::post('/store-users', [UserController::class, 'storeUser'])->name('users.store');


//rota de actualizar users
Route::put('/update-user', [UserController::class, 'updateUser'])->name('users.update');


// rota de todas as tarefas
Route::get('/all-tasks', [TaskController::class, 'allTasks'])->name('tasks.all');


// rota das tasks
Route::get('/edit-tasks/{id}', [TaskController::class, 'editTasks']) ->name('tasks.edit');

Route::get('/delete-tasks/{id}', [TaskController::class, 'deleteTasks']) ->name('tasks.delete');


// rota para adicionar tarefas
Route::get('/add-tasks', [TaskController::class, 'addTasks'])->name('tasks.add');

// rota para guardar tarefas
Route::post('/store-tasks', [TaskController::class, 'storeTask'])->name('tasks.store');


// TAREFA INTERMÉDIA LARAVEL

// rota de todas as prendas
Route::get('/all-gifts', [GiftController::class, 'allGifts'])->name('gifts.all');


// rota para adicionar prendas
Route::get('/add-gifts', [GiftController::class, 'addGifts'])->name('gifts.add');

// rota para guardar prendas
Route::post('/store-gifts', [GiftController::class, 'storeGift'])->name('gifts.store');


// rota para ver / editar prendas
Route::get('/edit-gifts/{id}', [GiftController::class, 'editGifts'])->name('gifts.edit');

// rota de actualizar prendas
Route::put('/update-gifts', [GiftController::class, 'updateGift'])->name('gifts.update');


// rota de apagar prendas
Route::get('/delete-gifts/{id}', [GiftController::class, 'deleteGifts'])->name('gifts.delete');


// EXERCÍCIO MIDDLEWARE

// rota da home do dashboard (só para users autenticados)
Route::get('/dashboard', [DashboardController::class, 'loadDashboard'])->name('dashboard')->middleware('auth');


//rota fallback
Route::fallback(function(){
    return view('utils.fallback');
});


