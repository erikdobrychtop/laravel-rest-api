<?php

namespace App\Services;

use App\Models\Batch;
use App\Repositories\BatchIngredientRepository;

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
        return $this->batchIngredientRepository->delete($batchId, $id);
    }
}