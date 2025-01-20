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

    public function update(Batch $batchId, $id, array $data)
    {
        try {
            // Busca o ingrediente verificando o batch_id e o id
            $ingredient = BatchIngredient::where('batch_id', $batchId->id)->where('id', $id)->first();

            if (!$ingredient) {
                // Lança uma exceção se o ingrediente não for encontrado ou não pertencer ao lote
                throw new \Exception('Ingredient not found or does not belong to the specified batch', 404);
            }

            // Atualiza o ingrediente com os dados fornecidos
            $ingredient->update($data);

            return $ingredient;
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error updating ingredient: ', [
                'batch_id' => $batchId->id,
                'ingredient_id' => $id,
                'error_message' => $e->getMessage(),
            ]);

            // Propaga a exceção para ser tratada em um nível superior
            throw $e;
        }
    }

    public function delete(Batch $batchId, $id)
    {
        try {
            // Verifica se o ingrediente pertence ao lote especificado
            $ingredient = BatchIngredient::where('batch_id', $batchId->id)->where('id', $id)->first();

            // Verifica se o registro não existe ou não pertence ao lote especificado
            if (is_null($ingredient) || $ingredient->batch_id !== $batchId->id) {
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