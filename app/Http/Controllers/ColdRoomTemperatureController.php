<?php

namespace App\Http\Controllers;

use App\Services\ColdRoomTemperatureService;
use Illuminate\Http\Request;

class ColdRoomTemperatureController extends Controller
{
    protected $coldRoomTemperatureService;

    public function __construct(ColdRoomTemperatureService $coldRoomTemperatureService)
    {
        $this->coldRoomTemperatureService = $coldRoomTemperatureService;
    }

    public function index()
    {
        return response()->json($this->coldRoomTemperatureService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->coldRoomTemperatureService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'cold_room_id' => 'required|exists:cold_rooms,id',
            'temperature' => 'required|numeric',
        ]);

        // Adiciona o horário atual automaticamente
        $data['recorded_at'] = now();

        return response()->json($this->coldRoomTemperatureService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'temperature' => 'numeric',
        ]);

        return response()->json($this->coldRoomTemperatureService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->coldRoomTemperatureService->delete($id);
        return response()->json(['message' => 'Cold room temperature deleted successfully']);
    }
}