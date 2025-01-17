<?php

namespace App\Http\Controllers;

use App\Services\ColdRoomService;
use Illuminate\Http\Request;

class ColdRoomController extends Controller
{
    protected $coldRoomService;

    public function __construct(ColdRoomService $coldRoomService)
    {
        $this->coldRoomService = $coldRoomService;
    }

    public function index()
    {
        return response()->json($this->coldRoomService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->coldRoomService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'brewery_id' => 'required|exists:breweries,id',
        ]);

        return response()->json($this->coldRoomService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'string',
            'brewery_id' => 'exists:breweries,id',
        ]);

        return response()->json($this->coldRoomService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->coldRoomService->delete($id);
        return response()->json(['message' => 'Cold room deleted successfully']);
    }
}
