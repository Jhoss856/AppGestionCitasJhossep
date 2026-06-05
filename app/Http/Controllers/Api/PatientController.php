<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Http\Requests\StorePatientsRequest;
use App\Http\Requests\UpdatePatientsRequest; // Arreglado a Plural para que coincida con tu archivo
use App\Http\Resources\PatientsResource;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Listar pacientes
    public function index(Request $request)
    {
        $patients = Patient::all();

        // SI ES WEB: Devolvemos tu vista premium con la tabla
        if (!$request->wantsJson()) {
            return view('patients.index', compact('patients'));
        }

        // SI ES API: Devolvemos el Resource con JSON tradicional
        return PatientsResource::collection($patients);
    }

    // Registrar Paciente
    public function store(StorePatientsRequest $request)
    {
        $patient = Patient::create($request->validated());

        // SI ES WEB: Redirecciona de vuelta a la tabla con el Toast de éxito
        if (!$request->wantsJson()) {
            return redirect()->to('/patients')->with('success', 'Paciente inscrito de forma exitosa');
        }

        // SI ES API: Devuelve la respuesta de la API
        return response()->json([
            'message' => 'Paciente registrado exitosamente',
            'data' => new PatientsResource($patient)
        ], 201);
    }

    // ¡NUEVO! Muestra el formulario de edición en la Web
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    // Actualizar Paciente
    public function update(UpdatePatientsRequest $request, $id) // Corregido el tipo a UpdatePatientsRequest
    {
        $patient = Patient::findOrFail($id);
        $patient->update($request->validated());

        // SI ES WEB: Redirecciona de forma tradicional limpiando la pantalla
        if (!$request->wantsJson()) {
            return redirect()->to('/patients')->with('success', 'Paciente actualizado correctamente');
        }

        // SI ES API: Respuesta JSON habitual
        return response()->json([
            'message' => 'Paciente actualizado correctamente',
            'data' => new PatientsResource($patient)
        ], 200);
    }

    // ¡NUEVO! Eliminar Paciente
    public function destroy(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        // SI ES WEB: Redirecciona a la tabla con mensaje
        if (!$request->wantsJson()) {
            return redirect()->to('/patients')->with('success', 'Registro eliminado correctamente');
        }

        // SI ES API: Respuesta JSON
        return response()->json([
            'message' => 'Paciente eliminado correctamente'
        ], 200);
    }
}