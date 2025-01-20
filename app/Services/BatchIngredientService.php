<?php

namespace App\Services;

use App\Models\Batch;
use App\Repositories\BatchIngredientRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class BatchIngredientService
{
    protected $batchIngredientRepository;

    public function __construct(BatchIngredientRepository $repository)
    {
        $this->batchIngredientRepository = $repository;
    }

    public function getByBatchId($batchId)
    {
        return $this->batchIngredientRepository->getByBatchId($batchId);
    }

    public function create(array $data)
    {
        return $this->batchIngredientRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->batchIngredientRepository->update($id, $data);
    }

    public function delete(Batch $batchId, $id)
    {
        try {
            // Chama o método de exclusão do repositório
            $result = $this->batchIngredientRepository->delete($batchId, $id);

            if (!$result) {
                // Lança uma exceção se a exclusão não for bem-sucedida
                throw new Exception('Ingredient not found or does not belong to the specified batch', 404);
            }

            return response()->json(['message' => 'Ingredient deleted successfully']);
        } catch (Exception $e) {
            // Verifica se é uma exceção esperada (404)
            if ($e->getCode() === 404) {
                return response()->json(['message' => $e->getMessage()], 404);
            }

            // Loga outros erros e retorna um erro genérico
            Log::error('Error deleting ingredient: ' . $e->getMessage());

            return response()->json(['message' => 'Failed to delete ingredient'], 500);
        }
    }

}