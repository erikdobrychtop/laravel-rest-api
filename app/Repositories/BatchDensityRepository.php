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

    public function create(array $data)
    {
        return BatchDensity::create($data);
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