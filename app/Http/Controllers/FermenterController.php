<?php

namespace App\Http\Controllers;

use App\Services\FermenterService;
use Illuminate\Http\Request;

class FermenterController extends Controller
{
    protected $fermenterService;

    public function __construct(FermenterService $fermenterService)
    {
        $this->fermenterService = $fermenterService;
    }

    public function index()
    {
        return response()->json($this->fermenterService->getAll());
    }

    public function show($id)
    {
        return response()->json($this->fermenterService->findById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'brewery_id' => 'required|exists:breweries,id',
        ]);

        return response()->json($this->fermenterService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'brewery_id' => 'sometimes|exists:breweries,id',
        ]);

        return response()->json($this->fermenterService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->fermenterService->delete($id);
        return response()->json(['message' => 'Fermenter deleted successfully']);
    }
}