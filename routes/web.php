<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\TaskController;
use App\Http\Controllers\Student\ConfigurationController;

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

Route::namespace('Student')->name('student.')->group(function() {

    Route::get('/verificar-email/{token}', [AuthController::class, 'verifyEmail'])->name('verify-email');
    Route::match(['get', 'post'], '/cadastrar-nova-senha/{token}', [AuthController::class, 'recoverPassword'])->name('recover-password');
    Route::match(['get', 'post'], '/entrar', [AuthController::class, 'login'])->name('login');
    Route::match(['get', 'post'], '/cadastre-se', [AuthController::class, 'register'])->name('register');
    Route::match(['get', 'post'], '/esqueci-minha-senha', [AuthController::class, 'forgotPassword'])->name('forgot-password');

    Route::middleware(['auth.student'])->group(function() {
        Route::get('/sair', [AuthController::class, 'logout'])->name('logout');
        Route::match(['get', 'post'], '/completar-cadastro', [AuthController::class, 'completeRegistration'])->name('complete-registration');

        Route::middleware(['student.incomplete.registration'])->group(function() {
            Route::get('/', [HomeController::class, 'index'])->name('home.index');

            Route::post('/tarefas/actions', [TaskController::class, 'actions'])->name('task.actions');
            Route::get('/tarefas/cadastrar', [TaskController::class, 'form'])->name('task.new');
            Route::get('/tarefas/editar/{task}', [TaskController::class, 'form'])->name('task.edit');
            Route::post('/tarefas/{task?}', [TaskController::class, 'save'])->name('task.save');
            Route::get('/tarefas', [TaskController::class, 'index'])->name('task.index');

            Route::get('/configuracoes', [ConfigurationController::class, 'index'])->name('config.index');
        });
    });
});