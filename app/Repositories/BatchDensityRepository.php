<?php

namespace App\Repositories;

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

    public function delete($id)
    {
        return BatchDensity::destroy($id);
    }
}