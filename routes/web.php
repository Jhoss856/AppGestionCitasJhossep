<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// =========================================================================
// RUTAS OAUTH: GOOGLE (Apuntan directo a tus métodos existentes)
// =========================================================================
Route::get('/login/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/login/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);

// =========================================================================
// RUTAS OAUTH: GITHUB (Apuntan directo a tus métodos existentes)
// =========================================================================
Route::get('/login/github', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])
    ->name('login.github');

Route::get('/login/github/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallBack']);

// El primer parámetro es la URL que ves en el navegador, el segundo es tu controlador real
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');

// Añade esta línea junto a las demás rutas de patients
Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');