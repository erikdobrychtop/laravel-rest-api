<?php

namespace App\Http\Controllers;

use App\Services\FermenterTemperatureService;
use Illuminate\Http\Request;

class FermenterTemperatureController extends Controller
{
    protected $fermenterTemperatureService;

    public function __construct(FermenterTemperatureService $fermenterTemperatureService)
    {
        $this->fermenterTemperatureService = $fermenterTemperatureService;
    }

    public function index()
    {
        return response()->json($this->fermenterTemperatureService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->fermenterTemperatureService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fermenter_id' => 'required|exists:fermenters,id',
            'temperature' => 'required|numeric',
        ]);

        // Define o horário atual automaticamente
        $data['recorded_at'] = now();

        return response()->json($this->fermenterTemperatureService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'temperature' => 'numeric',
        ]);

        return response()->json($this->fermenterTemperatureService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->fermenterTemperatureService->delete($id);
        return response()->json(['message' => 'Fermenter temperature deleted successfully']);
    }
}