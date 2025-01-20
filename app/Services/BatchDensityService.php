<?php

namespace App\Services;

use App\Repositories\BatchDensityRepository;

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

    public function create(array $data)
    {
        return $this->batchDensityRepository->create($data);
    }

    public function delete($id)
    {
        return $this->batchDensityRepository->delete($id);
    }
}