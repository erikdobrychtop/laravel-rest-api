<?php

namespace App\Http\Controllers;

use App\Models\Batch;
use App\Services\BatchIngredientService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BatchIngredientController extends Controller
{
    protected $batchIngredientService;

    public function __construct(BatchIngredientService $service)
    {
        $this->batchIngredientService = $service;
    }

    public function index($batchId)
    {
        try {
            $ingredients = $this->batchIngredientService->getByBatchId($batchId);
            return response()->json($ingredients);
        } catch (\Exception $e) {
            Log::error('Error fetching ingredients: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to fetch ingredients'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $ingredient = $this->batchIngredientService->create($data);
            return response()->json($ingredient, 201);
        } catch (\Exception $e) {
            Log::error('Error storing ingredient: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to store ingredient'], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $ingredient = $this->batchIngredientService->update($id, $data);
            return response()->json($ingredient);
        } catch (\Exception $e) {
            Log::error('Error updating ingredient: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to update ingredient'], 500);
        }
    }

    public function destroy(Batch $batchId, $id)
    {
        try {
            $this->batchIngredientService->delete($batchId, $id);
            return response()->json(['message' => 'Ingredient deleted successfully']);
        } catch (\Exception $e) {
            Log::error('Error deleting ingredient: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to delete ingredient'], 500);
        }
    }
}