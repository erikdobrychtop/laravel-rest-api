<?php

namespace App\Services;

use App\Models\Batch;
use App\Repositories\BatchDensityRepository;
use Exception;
use Illuminate\Support\Facades\Log;

class BatchDensityService
{
    protected $batchDensityRepository;

    public function __construct(BatchDensityRepository $repository)
    {
        $this->batchDensityRepository = $repository;
    }

    public function getByBatchId($batchId)
    {
        return $this->batchDensityRepository->getByBatchId($batchId);
    }

    public function create(Batch $batchId, array $data)
    {
        try {
            // Tenta criar o registro de densidade
            return $this->batchDensityRepository->create($batchId, $data);
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error creating density record: ', [
                'data' => $data,
                'error_message' => $e->getMessage(),
            ]);

            // Lança a exceção para tratamento em níveis superiores
            throw new \Exception('Failed to create density record. Please try again.', 500);
        }
    }

    public function update(Batch $batchId, $id, array $data)
    {
        return $this->batchDensityRepository->update($batchId, $id, $data);
    }

    public function delete(Batch $batchId, $id)
    {
        try {
            // Chama o método de exclusão do repositório
            $result = $this->batchDensityRepository->delete($batchId, $id);

            if (!$result) {
                // Lança uma exceção se a exclusão não for bem-sucedida
                throw new Exception('Density record not found or does not belong to the specified batch', 404);
            }

            return response()->json(['message' => 'Density record deleted successfully']);
        } catch (Exception $e) {
            // Verifica se é uma exceção esperada (404)
            if ($e->getCode() === 404) {
                return response()->json(['message' => $e->getMessage()], 404);
            }

            // Loga outros erros e retorna um erro genérico
            Log::error('Error deleting density record: ' . $e->getMessage());

            return response()->json(['message' => 'Failed to delete density record'], 500);
        }
    }

}