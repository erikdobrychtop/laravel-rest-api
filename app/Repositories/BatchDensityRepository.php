<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\BatchDensity;
use Illuminate\Support\Facades\Log;

class BatchDensityRepository
{
    public function getByBatchId($batchId)
    {
        return BatchDensity::where('batch_id', $batchId)->get();
    }
    public function create(Batch $batchId, array $data)
    {
        try {
            // Adiciona o batch_id aos dados
            $data['batch_id'] = $batchId->id;

            // Cria o registro da densidade
            return BatchDensity::create($data);
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error creating density record: ', [
                'batch_id' => $batchId->id,
                'data' => $data,
                'error_message' => $e->getMessage(),
            ]);

            // Lança uma exceção personalizada
            throw new \Exception('Failed to create density record. Please try again.', 500);
        }
    }

    public function update(Batch $batchId, $id, array $data)
    {
        try {
            // Busca a densidade verificando o batch_id e o id
            $density = BatchDensity::where('batch_id', $batchId->id)->where('id', $id)->first();

            if (!$density) {
                // Lança uma exceção se a densidade não for encontrada ou não pertencer ao lote
                throw new \Exception('Density record not found or does not belong to the specified batch', 404);
            }

            // Atualiza a densidade com os dados fornecidos
            $density->update($data);

            return $density;
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error updating density record: ', [
                'batch_id' => $batchId->id,
                'density_id' => $id,
                'error_message' => $e->getMessage(),
            ]);

            // Propaga a exceção para ser tratada em um nível superior
            throw $e;
        }
    }

    public function delete(Batch $batchId, $id)
    {
        try {
            // Verifica se a densidade pertence ao lote especificado
            $density = BatchDensity::where('batch_id', $batchId->id)->where('id', $id)->first();

            // Verifica se o registro não existe ou não pertence ao lote especificado
            if (is_null($density) || $density->batch_id !== $batchId->id) {
                throw new \Exception('Density record not found or does not belong to the specified batch', 404);
            }

            // Deleta o registro de densidade
            $density->delete();

            return response()->json(['message' => 'Density record deleted successfully']);
        } catch (\Exception $e) {
            // Registra o erro no log para análise
            Log::error('Error deleting density record: ' . $e->getMessage());

            return response()->json(['message' => 'Failed to delete density record'], 500);
        }
    }
    
}