<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use App\Http\Resources\AppointmentsResource;

class AppointmentsController extends Controller
{
    // INDEX: Ordenado cronológicamente por la fecha de cita más reciente
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
                                    ->orderBy('appointment_date', 'desc')
                                    ->get();

        return AppointmentsResource::collection($appointments);
    }

    public function store(StoreAppointmentsRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        return response()->json([
            'message' => 'Cita creada exitosamente',
            'data' => new AppointmentsResource($appointment)
        ], 201);
    }

    public function show(Appointment $appointment)
    {
        return new AppointmentsResource($appointment->load(['patient', 'doctor']));
    }

    public function update(UpdateAppointmentsRequest $request, Appointment $appointment)
    {
        $appointment->update($request->validated());

        return response()->json([
            'message' => 'Cita actualizada correctamente',
            'data' => new AppointmentsResource($appointment)
        ], 200);
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}