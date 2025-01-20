<?php

namespace App\Services;

use App\Repositories\BatchRepository;

class BatchService
{
    protected $batchRepository;

    public function __construct(BatchRepository $batchRepository)
    {
        $this->batchRepository = $batchRepository;
    }

    public function getAll()
    {
        return $this->batchRepository->getAll();
    }

    public function findById($id)
    {
        return $this->batchRepository->findById($id);
    }

    public function create(array $data)
    {
        return $this->batchRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->batchRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->batchRepository->delete($id);
    }
}