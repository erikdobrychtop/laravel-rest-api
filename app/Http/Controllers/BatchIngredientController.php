<?php

namespace App\Http\Controllers;

use App\Services\BatchIngredientService;
use Illuminate\Http\Request;

class BatchIngredientController extends Controller
{
    protected $batchIngredientService;

    public function __construct(BatchIngredientService $service)
    {
        $this->batchIngredientService = $service;
    }

    public function index($batchId)
    {
        return response()->json($this->batchIngredientService->getByBatchId($batchId));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        return response()->json($this->batchIngredientService->create($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        return response()->json($this->batchIngredientService->update($id, $data));
    }

    public function destroy($id)
    {
        $this->batchIngredientService->delete($id);
        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}