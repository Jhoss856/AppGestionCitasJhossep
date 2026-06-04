<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use App\Http\Requests\StoreMedicationsRequest;
use App\Http\Requests\UpdateMedicationsRequest;
use App\Http\Resources\MedicationsResource;

class MedicationController extends Controller
{
    // INDEX: Ordenado alfabéticamente por el nombre del medicamento
    public function index()
    {
        // Si más adelante quieres adjuntar la info del tratamiento, cambias esto por Medication::with('treatment')...
        $medications = Medication::orderBy('name', 'asc')->get();

        return MedicationsResource::collection($medications);
    }

    public function store(StoreMedicationsRequest $request)
    {
        $medication = Medication::create($request->validated());

        return response()->json([
            'message' => 'Medicamento guardado exitosamente',
            'data'    => new MedicationsResource($medication)
        ], 201);
    }

    public function show(Medication $medication)
    {
        return new MedicationsResource($medication);
    }

    public function update(UpdateMedicationsRequest $request, Medication $medication)
    {
        $medication->update($request->validated());

        return response()->json([
            'message' => 'Medicamento actualizado correctamente',
            'data'    => new MedicationsResource($medication)
        ], 200);
    }

    public function destroy(Medication $medication)
    {
        $medication->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}