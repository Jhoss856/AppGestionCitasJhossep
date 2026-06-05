<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Treatment;
use App\Http\Requests\StoreTreatmentsRequest;
use App\Http\Requests\UpdateTreatmentsRequest;
use App\Http\Resources\TreatmentsResource;
use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    // Función para mostrar la lista (Web y API)
    public function index(Request $request)
    {
        $treatments = Treatment::orderBy('id', 'desc')->get();

        if (!$request->wantsJson()) {
            // Retorna la vista si la petición es del navegador
            return view('treatments.index', compact('treatments'));
        }

        // Retorna JSON si es una petición de API
        return TreatmentsResource::collection($treatments);
    }

    // Guardar nuevo tratamiento
    public function store(StoreTreatmentsRequest $request)
    {
        Treatment::create($request->validated());
        return redirect()->to('/treatments')->with('success', 'Tratamiento registrado con éxito.');
    }

    // Cargar formulario de edición
    public function edit($id)
    {
        $treatment = Treatment::findOrFail($id);
        return view('treatments.edit', compact('treatment'));
    }

    // Actualizar registro
    public function update(UpdateTreatmentsRequest $request, $id)
    {
        $treatment = Treatment::findOrFail($id);
        $treatment->update($request->validated());
        return redirect()->to('/treatments')->with('success', 'Tratamiento actualizado.');
    }

    // Eliminar registro
    public function destroy(Request $request, $id)
    {
        Treatment::findOrFail($id)->delete();
        return redirect()->to('/treatments')->with('success', 'Tratamiento eliminado correctamente.');
    }
}