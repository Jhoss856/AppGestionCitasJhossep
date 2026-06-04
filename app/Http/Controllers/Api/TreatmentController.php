<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentsRequest;
use App\Http\Requests\UpdateTreatmentsRequest;
use App\Http\Resources\TreatmentsResource;

class TreatmentController extends Controller
{
    // INDEX: Ordenado por el ID más reciente
    public function index()
    {
        $treatments = Treatment::orderBy('id', 'desc')->get();

        return TreatmentsResource::collection($treatments);
    }

    public function store(StoreTreatmentsRequest $request)
    {
        $treatment = Treatment::create($request->validated());

        return response()->json([
            'message' => 'Tratamiento registrado exitosamente',
            'data'    => new TreatmentsResource($treatment)
        ], 201);
    }

    public function show(Treatment $treatment)
    {
        // Replicamos la carga de medicamentos que tenías en tu antiguo controlador
        return new TreatmentsResource($treatment->load('medications'));
    }

    public function update(UpdateTreatmentsRequest $request, Treatment $treatment)
    {
        $treatment->update($request->validated());

        return response()->json([
            'message' => 'Tratamiento actualizado correctamente',
            'data'    => new TreatmentsResource($treatment)
        ], 200);
    }

    public function destroy(Treatment $treatment)
    {
        $treatment->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}