<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Diagnosis;
use App\Models\Patient;
use App\Models\Doctor;
use App\Http\Requests\StoreDiagnosisRequest;
use App\Http\Requests\UpdateDiagnosisRequest;
use App\Http\Resources\DiagnosisResource;
use Illuminate\Http\Request; // <-- Importación crucial para detectar la Web

class DiagnosisController extends Controller
{
    // INDEX: Muestra la tabla en la Web o responde JSON en la API
    public function index(Request $request)
    {
        $diagnoses = Diagnosis::with(['patient', 'doctor'])
                    ->orderBy('date', 'desc')
                    ->get();

        // SI ES WEB: Enviamos la vista junto con los pacientes y médicos para el formulario
        if (!$request->wantsJson()) {
            $patients = Patient::orderBy('last_name', 'asc')->get();
            $doctors = Doctor::orderBy('last_name', 'asc')->get();
            return view('diagnoses.index', compact('diagnoses', 'patients', 'doctors'));
        }

        return DiagnosisResource::collection($diagnoses);
    }

    // STORE: Registrar nuevo diagnóstico
    public function store(StoreDiagnosisRequest $request)
    {
        $diagnosis = Diagnosis::create($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/diagnoses')->with('success', 'Diagnóstico registrado exitosamente.');
        }

        return response()->json([
            'message' => 'Diagnóstico registrado exitosamente',
            'data'    => new DiagnosisResource($diagnosis)
        ], 201);
    }

    public function show(Diagnosis $diagnosis)
    {
        return new DiagnosisResource($diagnosis->load(['patient', 'doctor']));
    }

    // EDIT: Formulario de edición en la Web
    public function edit($id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $patients = Patient::orderBy('last_name', 'asc')->get();
        $doctors = Doctor::orderBy('last_name', 'asc')->get();
        return view('diagnoses.edit', compact('diagnosis', 'patients', 'doctors'));
    }

    // UPDATE: Actualizar registro
    public function update(UpdateDiagnosisRequest $request, $id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->update($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/diagnoses')->with('success', 'Diagnóstico actualizado correctamente.');
        }

        return response()->json([
            'message' => 'Diagnóstico actualizado correctamente',
            'data'    => new DiagnosisResource($diagnosis)
        ], 200);
    }

    // DESTROY: Eliminar registro
    public function destroy(Request $request, $id)
    {
        $diagnosis = Diagnosis::findOrFail($id);
        $diagnosis->delete();

        if (!$request->wantsJson()) {
            return redirect()->to('/diagnoses')->with('success', 'Diagnóstico retirado del sistema.');
        }

        return response()->json(['message' => 'Deleted successfully']);
    }
}