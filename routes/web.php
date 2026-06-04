<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Api\AppointmentsController;
use App\Http\Controllers\Api\DiagnosisController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\TreatmentController;

// Registro de rutas API limpias
Route::apiResource('appointments', AppointmentsController::class);
Route::apiResource('diagnoses', DiagnosisController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('medications', MedicationController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('treatments', TreatmentController::class);