<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Importaciones apuntando a la nueva carpeta Api
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\DiagnosisController;
use App\Http\Controllers\Api\DoctorController;
use App\Http\Controllers\Api\MedicationController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\TreatmentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Tus recursos API conectados
Route::apiResource('appointments', AppointmentController::class);
Route::apiResource('diagnosis', DiagnosisController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('medications', MedicationController::class);
Route::apiResource('patients', PatientController::class);
Route::apiResource('treatments', TreatmentController::class);