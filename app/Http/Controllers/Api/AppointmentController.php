<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Patient; 
use App\Models\Doctor;  
use App\Http\Requests\StoreAppointmentsRequest;
use App\Http\Requests\UpdateAppointmentsRequest;
use App\Http\Resources\AppointmentsResource;
use Illuminate\Http\Request;

// CORREGIDO: Ahora se llama AppointmentController (en singular) igual que el archivo
class AppointmentController extends Controller
{
    // INDEX: Lista las citas cargando sus relaciones
    public function index(Request $request)
    {
        $appointments = Appointment::with(['patient', 'doctor'])
                                    ->orderBy('appointment_date', 'desc')
                                    ->get();

        // SI ES WEB: Enviamos la vista junto con los pacientes y doctores para los formularios
        if (!$request->wantsJson()) {
            $patients = Patient::orderBy('last_name', 'asc')->get();
            $doctors = Doctor::orderBy('last_name', 'asc')->get();
            
            // CORREGIDO: Carpeta en plural 'appointments.index' y variable correcta 'appointments'
            return view('appointments.index', compact('appointments', 'patients', 'doctors'));
        }

        return AppointmentsResource::collection($appointments);
    }

    // STORE: Crear nueva cita
    public function store(StoreAppointmentsRequest $request)
    {
        $appointment = Appointment::create($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/appointments')->with('success', 'Cita médica agendada correctamente.');
        }

        return response()->json([
            'message' => 'Cita creada exitosamente',
            'data' => new AppointmentsResource($appointment)
        ], 201);
    }

    // SHOW: Mostrar una cita específica (API)
    public function show(Appointment $appointment)
    {
        return new AppointmentsResource($appointment->load(['patient', 'doctor']));
    }

    // EDIT: Formulario de edición web
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::orderBy('last_name', 'asc')->get();
        $doctors = Doctor::orderBy('last_name', 'asc')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    // UPDATE: Modificar cita
    public function update(UpdateAppointmentsRequest $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->validated());

        if (!$request->wantsJson()) {
            return redirect()->to('/appointments')->with('success', 'Cita actualizada con éxito.');
        }

        return response()->json([
            'message' => 'Cita actualizada correctamente',
            'data' => new AppointmentsResource($appointment)
        ], 200);
    }

    // DESTROY: Cancelar/Eliminar cita
    public function destroy(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        if (!$request->wantsJson()) {
            return redirect()->to('/appointments')->with('success', 'La cita fue retirada del itinerario.');
        }

        return response()->json(['message' => 'Deleted successfully']);
    }
}