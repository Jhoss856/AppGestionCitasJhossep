<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Requests\StoreDoctorsRequest;
use App\Http\Requests\UpdateDoctorsRequest;
use App\Http\Resources\DoctorsResource;
use Illuminate\Http\Request; // <-- Importación necesaria para detectar la web

class DoctorController extends Controller
{
    // INDEX: Carga la vista Blade o responde JSON para la API
    public function index(Request $request)
    {
        $doctors = Doctor::orderBy('last_name', 'asc')->get();

        // SI ES WEB: Devolvemos tu vista con la tabla de médicos
        if (!$request->wantsJson()) {
            return view('doctors.index', compact('doctors'));
        }

        // SI ES API: Devolvemos el Resource JSON tradicional
        return DoctorsResource::collection($doctors);
    }

    // STORE: Registrar Médico
    public function store(StoreDoctorsRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/doctors')->with('success', 'Médico registrado exitosamente.');
        }

        return response()->json([
            'message' => 'Médico registrado exitosamente',
            'data'    => new DoctorsResource($doctor)
        ], 201);
    }

    public function show(Doctor $doctor)
    {
        return new DoctorsResource($doctor);
    }

    // Muestra el formulario de edición en la Web
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('doctors.edit', compact('doctor'));
    }

    // UPDATE: Actualizar Médico
    public function update(UpdateDoctorsRequest $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/doctors')->with('success', 'Médico actualizado correctamente.');
        }

        return response()->json([
            'message' => 'Médico actualizado correctamente',
            'data'    => new DoctorsResource($doctor)
        ], 200);
    }

    // DESTROY: Eliminar Médico
    public function destroy(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->delete();

        if (!$request->wantsJson()) {
            return redirect()->to('/doctors')->with('success', 'Registro retirado del sistema.');
        }

        return response()->json(['message' => 'Deleted successfully']);
    }
}