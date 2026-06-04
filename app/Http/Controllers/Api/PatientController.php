<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest;
use App\Http\Resources\PatientsResource;

class PatientController extends Controller
{
    // INDEX: Ordenado alfabéticamente por apellido
    public function index()
    {
        $patients = Patient::orderBy('last_name', 'asc')->get();

        return PatientsResource::collection($patients);
    }

    public function store(StorePatientsRequest $request)
    {
        $patient = Patient::create($request->validated());

        return response()->json([
            'message' => 'Paciente registrado exitosamente',
            'data'    => new PatientsResource($patient)
        ], 201);
    }

    public function show(Patient $patient)
    {
        return new PatientsResource($patient);
    }

    public function update(UpdatePatientsRequest $request, Patient $patient)
    {
        $patient->update($request->validated());

        return response()->json([
            'message' => 'Paciente actualizado correctamente',
            'data'    => new PatientsResource($patient)
        ], 200);
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}