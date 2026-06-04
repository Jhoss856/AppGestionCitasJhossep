<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Http\Requests\StoreDoctorsRequest;
use App\Http\Requests\UpdateDoctorsRequest;
use App\Http\Resources\DoctorsResource;

class DoctorController extends Controller
{
    // INDEX: Ordenado alfabéticamente por apellido paterno/materno
    public function index()
    {
        $doctors = Doctor::orderBy('last_name', 'asc')->get();

        return DoctorsResource::collection($doctors);
    }

    public function store(StoreDoctorsRequest $request)
    {
        $doctor = Doctor::create($request->validated());

        return response()->json([
            'message' => 'Médico registrado exitosamente',
            'data'    => new DoctorsResource($doctor)
        ], 201);
    }

    public function show(Doctor $doctor)
    {
        return new DoctorsResource($doctor);
    }

    public function update(UpdateDoctorsRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());

        return response()->json([
            'message' => 'Médico actualizado correctamente',
            'data'    => new DoctorsResource($doctor)
        ], 200);
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}