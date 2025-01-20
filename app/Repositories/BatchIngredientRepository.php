<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\BatchIngredient;

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
        // Verifica se o ingrediente pertence ao lote especificado
        $ingredient = BatchIngredient::where('batch_id', $batchId)->where('id', $id)->first();

        if (!$ingredient) {
            return response()->json(['message' => 'Ingredient not found or does not belong to the specified batch'], 404);
        }

        // Deleta o ingrediente
        $ingredient->delete();

        return response()->json(['message' => 'Ingredient deleted successfully']);
    }
}