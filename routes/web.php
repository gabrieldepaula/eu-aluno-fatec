<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student\AuthController;
use App\Http\Controllers\Student\HomeController;
use App\Http\Controllers\Student\TaskController;

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

            Route::get('/tarefas/editar/{id}', [TaskController::class, 'save'])->name('task.edit');
            Route::get('/tarefas/cadastrar', [TaskController::class, 'save'])->name('task.new');
            Route::get('/tarefas', [TaskController::class, 'index'])->name('task.index');
        });
    });
});