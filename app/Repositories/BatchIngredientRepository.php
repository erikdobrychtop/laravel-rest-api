<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\BatchIngredient;
use Illuminate\Support\Facades\Log;

class BatchIngredientRepository
{
    public function getByBatchId($batchId)
    {
        return BatchIngredient::where('batch_id', $batchId)->get();
    }

    public function create(array $data)
    {
        return BatchIngredient::create($data);
    }

    public function update($id, array $data)
    {
        $ingredient = BatchIngredient::find($id);
        if ($ingredient) {
            $ingredient->update($data);
        }
        return $ingredient;
    }

    public function delete(Batch $batchId, $id)
    {
        try {
            // Verifica se o ingrediente pertence ao lote especificado
            $ingredient = BatchIngredient::where('batch_id', $batchId->id)->where('id', $id)->first();

            if (!$ingredient) {
                throw new \Exception('Ingredient not found or does not belong to the specified batch', 404);
            }

            // Deleta o ingrediente
            $ingredient->delete();

            return response()->json(['message' => 'Ingredient deleted successfully']);
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error deleting ingredient: ' . $e->getMessage());

            return response()->json(['message' => 'Failed to delete ingredient'], 500);
        }
    }
}