<?php

namespace App\Repositories;

use App\Models\Batch;
use App\Models\BatchDensity;

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
        // Verifica se a densidade pertence ao lote especificado
        $density = BatchDensity::where('batch_id', $batchId)->where('id', $id)->first();

        if (!$density) {
            return response()->json(['message' => 'Density record not found or does not belong to the specified batch'], 404);
        }

        // Deleta o registro de densidade
        $density->delete();

        return response()->json(['message' => 'Density record deleted successfully']);
    }
    
}