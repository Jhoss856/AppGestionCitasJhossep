<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Models\Diagnosis;
use App\Models\Doctor;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // Listar todos los tratamientos en la tabla web
    public function index(Request $request)
    {
        $treatments = Treatment::with(['diagnosis', 'doctor'])->orderBy('id', 'desc')->get();
        $diagnoses = Diagnosis::orderBy('id', 'desc')->get();
        $doctors = Doctor::orderBy('id', 'desc')->get();

        return view('treatments.index', compact('treatments', 'diagnoses', 'doctors'));
    }

    // Registrar un nuevo tratamiento
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'diagnosis_id' => 'required|exists:diagnoses,id',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|string|max:50',
            'administration_frequency' => 'required|string|max:100',
        ]);

        Treatment::create($request->all());

        return redirect()->route('treatments.index')->with('success', 'Tratamiento registrado con éxito.');
    }

    // Cargar formulario de edición
    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);
        $diagnoses = Diagnosis::orderBy('id', 'desc')->get();
        $doctors = Doctor::orderBy('id', 'desc')->get(); // Garantiza el envío de médicos a la vista
        
        return view('treatments.edit', compact('treatment', 'diagnoses', 'doctors'));
    }

    // Guardar los cambios editados en HeidiSQL
    public function update(Request $request, $id)
    {
        $treatment = Treatment::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'nullable|string',
            'duration' => 'required|string|max:100',
            'diagnosis_id' => 'required|exists:diagnoses,id',
            'doctor_id' => 'required|exists:doctors,id',
            'status' => 'required|string|max:50',
            'administration_frequency' => 'required|string|max:100',
        ]);

        $treatment->update($request->all());

        return redirect()->route('treatments.index')->with('success', 'Tratamiento actualizado correctamente.');
    }

    // Borrar un registro de la tabla
    public function destroy($id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->delete();

        return redirect()->route('treatments.index')->with('success', 'Tratamiento eliminado correctamente.');
    }
}