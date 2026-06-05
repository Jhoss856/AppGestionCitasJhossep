<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DiagnosisController;
use App\Http\Controllers\Api\TreatmentController; 

Route::get('/', function () {
    return view('welcome');

}); 

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// =========================================================================
// RUTAS OAUTH: GOOGLE
// =========================================================================
Route::get('/login/google', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGoogle'])
    ->name('login.google');

Route::get('/login/google/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGoogleCallBack']);

// =========================================================================
// RUTAS OAUTH: GITHUB
// =========================================================================
Route::get('/login/github', [\App\Http\Controllers\Auth\LoginController::class, 'redirectToGithub'])
    ->name('login.github');

Route::get('/login/github/callback', [\App\Http\Controllers\Auth\LoginController::class, 'handleGithubCallBack']);

// =========================================================================
// GESTIÓN DE PACIENTES
// =========================================================================
Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::delete('/patients/{id}', [PatientController::class, 'destroy'])->name('patients.destroy');
Route::get('/patients/{id}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::put('/patients/{id}', [PatientController::class, 'update'])->name('patients.update');

// =========================================================================
// GESTIÓN DE MÉDICOS
// =========================================================================
Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::post('/doctors', [DoctorController::class, 'store'])->name('doctors.store');
Route::get('/doctors/{id}/edit', [DoctorController::class, 'edit'])->name('doctors.edit');
Route::put('/doctors/{id}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/doctors/{id}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

// =========================================================================
// GESTIÓN DE CITAS MÉDICAS
// =========================================================================
Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
Route::get('/appointments/{id}/edit', [AppointmentController::class, 'edit'])->name('appointments.edit');
Route::put('/appointments/{id}', [AppointmentController::class, 'update'])->name('appointments.update');
Route::delete('/appointments/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');

// =========================================================================
// GESTIÓN DE DIAGNÓSTICOS
// =========================================================================
Route::get('/diagnoses', [DiagnosisController::class, 'index'])->name('diagnoses.index');
Route::post('/diagnoses', [DiagnosisController::class, 'store'])->name('diagnoses.store');
Route::get('/diagnoses/{id}/edit', [DiagnosisController::class, 'edit'])->name('diagnoses.edit');
Route::put('/diagnoses/{id}', [DiagnosisController::class, 'update'])->name('diagnoses.update');
Route::delete('/diagnoses/{id}', [DiagnosisController::class, 'destroy'])->name('diagnoses.destroy');

// =========================================================================
// GESTIÓN DE TRATAMIENTOS (Solución al error del nombre de la ruta)
// =========================================================================
Route::get('/treatments', [TreatmentController::class, 'index'])->name('treatments.index');
Route::post('/treatments', [TreatmentController::class, 'store'])->name('treatments.store');
Route::get('/treatments/{id}/edit', [TreatmentController::class, 'edit'])->name('treatments.edit');
Route::put('/treatments/{id}', [TreatmentController::class, 'update'])->name('treatments.update');
Route::delete('/treatments/{id}', [TreatmentController::class, 'destroy'])->name('treatments.destroy');