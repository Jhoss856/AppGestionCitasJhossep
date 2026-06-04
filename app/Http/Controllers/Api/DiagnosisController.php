<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Http\Resources\DiagnosisResource;

class DiagnosisController extends Controller
{
    // INDEX: Ordenado cronológicamente por la fecha de diagnóstico más reciente
    public function index()
    {
        $diagnoses = Diagnosis::with(['patient', 'doctor'])
                    ->orderBy('date', 'desc')
                    ->get();

        return DiagnosisResource::collection($diagnoses);
    }

    public function store(StoreDiagnosisRequest $request)
    {
        $diagnosis = Diagnosis::create($request->validated());

        return response()->json([
            'message' => 'Diagnóstico registrado exitosamente',
            'data'    => new DiagnosisResource($diagnosis)
        ], 201);
    }

    public function show(Diagnosis $diagnosis)
    {
        return new DiagnosisResource($diagnosis->load(['patient', 'doctor']));
    }

    public function update(UpdateDiagnosisRequest $request, Diagnosis $diagnosis)
    {
        $diagnosis->update($request->validated());

        return response()->json([
            'message' => 'Diagnóstico actualizado correctamente',
            'data'    => new DiagnosisResource($diagnosis)
        ], 200);
    }

    public function destroy(Diagnosis $diagnosis)
    {
        $diagnosis->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}